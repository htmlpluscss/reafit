<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('settings_model');
        $this->load->model('tags_model');
        $this->load->model('exercises_model');
        $this->load->model('programs_model');

        $this->lang->load('backend');

        $this->onlyAdmin();
    }

    public function index($page = 0) {

        $this->load->library('pagination');

        $data['title'] = lang('programs_list_title');

        $search = $this->input->get('search');
        $search = trim($search);

        $category = $this->input->get('category');
        $category = trim($category);

        $data['search'] = $search;
        $data['category'] = ($category == 'none' || empty($category)) ? null : $category;

        $_category_list = explode("\n", str_replace("\r\n", "\n", $this->settings->categories));

        $category_list = array();

        foreach ($_category_list as $key => $value) {
            $category_list[$value] = $value;
        }

        $data['category_list'] = $category_list;

        if(!empty($search)) {
            $search_array = array(
                    'name'        => $search,
                    'description' => $search,
                    'hash'        => $search,
                );
        } else {
            $search_array = array();
        }

        $total = $this->programs_model->getProgramsListAdmin($this->user->id, null, 0, $search_array, true, false, false, false, $category);
        $per_page = $this->input->get('items');

        $data['per_page_list'] = $this->per_page;

        if($per_page == 'all') {
            $per_page = null;
            $data['per_page'] = 'all';
        } elseif(empty($per_page) || !in_array($per_page, $this->per_page)) {
            $per_page = $this->config->item('per_page');
            $data['per_page'] = $this->config->item('per_page');
        } else {
            $data['per_page'] = (int) $per_page;
            $per_page = (int) $per_page;
        }

        $data['pagination'] = $this->pagination->render($total, $per_page, base_url('admin/programs'), 3);

        $data['items']  = $this->programs_model->getProgramsListAdmin($this->user->id, $per_page, $page, $search_array, false, false, false, false, $category);
        $data['action'] = base_url('admin/programs');

        $this->addStyle('admin.css');
        $this->template($data, 'backend');
    }

    public function users($page = 0) {

        $this->load->library('pagination');

        $data['title'] = lang('user_programs_title');

        $search = $this->input->get('search');
        $search = trim($search);

        $data['search'] = $search;

        if(!empty($search)) {
            $search_array = array(
                    'name'             => $search,
                    'description'      => $search,
                    'surname'          => $search,
                    'name'             => $search,
                    'middle_name'      => $search,
                    'hash'             => $search,
                    'email'            => $search
                );
        } else {
            $search_array = array();
        }

        $total = $this->programs_model->getProgramsListAdmin(false, null, 0, $search_array, true);
        $per_page = $this->input->get('items');

        $data['per_page_list'] = $this->per_page;

        if($per_page == 'all') {
            $per_page = null;
            $data['per_page'] = 'all';
        } elseif(empty($per_page) || !in_array($per_page, $this->per_page)) {
            $per_page = $this->config->item('per_page');
            $data['per_page'] = $this->config->item('per_page');
        } else {
            $data['per_page'] = (int) $per_page;
            $per_page = (int) $per_page;
        }

        $data['pagination'] = $this->pagination->render($total, $per_page, base_url('admin/programs'), 4);

        $data['items']  = $this->programs_model->getProgramsListAdmin(false, $per_page, $page, $search_array, false, true);
        $data['action'] = base_url('admin/programs/users');

        $this->addStyle('admin.css');
        $this->template($data, 'backend');
    }

    public function add() {
        $data =  array();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title']  = lang('program_add_title');
        $data['header'] = lang('program_add_header');

        $this->form_validation->set_rules('name', lang('name'), 'required|trim');
        $this->form_validation->set_rules('category', lang('category'), 'required|trim|not_none');
        $this->form_validation->set_rules('order', lang('order'), 'integer|trim');
        $this->form_validation->set_rules('image', lang('program_image'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
        $this->form_validation->set_rules('redirect', lang('redirect'), 'trim');

        $name          = $this->input->post('name');
        $category      = $this->input->post('category');
        $order         = (int) $this->input->post('order');
        $description   = $this->input->post('description');
        $exercises       = $this->input->post('exercises');

        if ($this->form_validation->run() === TRUE) {
            $redirect     = $this->input->post('redirect');
            $change_order = false;
            $hash = md5($this->user->id . ' ' . date ('Y-m-d H:i:s') . ' ' . rand(7, 15));

            if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $image = $this->upload('image');
                if($image) {
                    $image = $image['file_name'];
                } else {
                    $image = null;
                }
            } else {
                $image = null;
            }

            if(empty($order)) {
                $order = $this->programs_model->getLastNum($this->user->id) + 1;
            } else {
                $change_order = true;
            }

            $insert = array(
                    'name'        => $name,
                    'order'       => $order,
                    'description' => preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $description),
                    'user_id'     => $this->user->id,
                    'hash'        => $hash,
                    'created'     => date('Y-m-d H:i:s'),
                    'category'    => $category
                );

            if($image) {
                $insert['image'] = $image;
            }

            $result = $this->programs_model->saveProgram($insert);

            if($result) {
                if(empty($redirect)) {
                    $redirect = base_url('admin/programs/'.$hash);
                }

                if(!empty($exercises)) {
                    $this->programs_model->setTabs($result, $this->user->id, $exercises);
                }

                $this->session->set_flashdata('success', lang('saved'));
                redirect($redirect);
            } else {
                $this->session->set_flashdata('error', lang('error_execution'));
                redirect(base_url('admin/programs/add'));
            }
        }

        $data['name']              = (isset($name)) ? $name : '';
        $data['category']          = (isset($category)) ? $category : '';
        $data['order']             = (isset($order) && !empty($order)) ? $order : '';
        $data['description_text']  = (isset($description)) ? $description : '';
        $data['image']             = (isset($image)) ? site_url('images/'.$image) : null;
        $data['program_exercises'] = (isset($exercises) && isset($exercises[1]['exercises']) && !empty($exercises[1]['exercises'])) ?  $this->exercises_model->getExercises($exercises[1]['exercises']) : array();

        $data['tags']              = $this->tags_model->getTagsAll();
        $data['exercises']         = $this->findExercises(TRUE, null, null, null, true);
        $data['total_exercises']   = count($this->findExercises(TRUE, null, null, null));

        $data['list_url']          = base_url('admin/programs');

        $this->addStyle('app.css');
        $this->addStyle('editor/editor.css');
        $this->addStyle('admin.css');
        $this->addScript('jquery.ui.touch-punch.min.js');
        $this->addScript('jquery-ui.min.js');
        $this->addScript('app.js');
        $this->addScript('editor/trumbowyg.js');
        $this->addScript('editor/langs/ru.js');
        $this->template($data, 'backend', null, array('_nav', '_filter', '_popups'));
    }

    public function edit($hash) {
        $data =  array();

        $old_data = $this->programs_model->getPrograms($hash, false, true);
        if(!$old_data) {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title']  = $old_data->name;
        $data['header'] = $old_data->name;
        $data['hash']   = $old_data->hash;

        $exercise_user = $old_data->user_id;

        $this->form_validation->set_rules('name', lang('name'), 'required|trim');
        $this->form_validation->set_rules('order', lang('order'), 'integer|trim');
        $this->form_validation->set_rules('category', lang('category'), 'required|trim|not_none');
        if(empty($old_data->image) || (isset($_FILES['image']) && !empty($_FILES['image']['name']))){
            $this->form_validation->set_rules('image', lang('image'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
        }
        $this->form_validation->set_rules('redirect', lang('redirect'), 'trim');

        if ($this->form_validation->run() === TRUE) {
            $name          = $this->input->post('name');
            $category      = $this->input->post('category');
            $order         = (int) $this->input->post('order');
            $description   = $this->input->post('description');
            $exercises     = $this->input->post('exercises');
            $redirect      = $this->input->post('redirect');

            $change_order = false;
            $hash = $old_data->hash;

            if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $file_1 = $this->upload('image');
                if($file_1) {
                    $file_1 = $file_1['file_name'];
                } else {
                    $file_1 = null;
                }
            } else {
                $file_1 = null;
            }

            $insert = array(
                    'name'        => $name,
                    'category'    => $category,
                    'description' => preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $description),
                    'edited'      => date ('Y-m-d H:i:s'),
                    'hash'        => $hash
                );

            if($order != $old_data->order) {
                $insert['order'] = $order;
                $change_order = true;
            }

            if($file_1) {
                $insert['image'] = $file_1;
            }

            $result = $this->programs_model->saveProgram($insert, $old_data->id);

            if($result) {
                if(empty($redirect)) {
                    $redirect = base_url('admin/programs/'.$hash);
                }

                if(!empty($exercises)) {
                    $this->programs_model->setTabs($result, $this->user->id, $exercises);
                }

                if($change_order) {
                    $this->programs_model->changeOrder($order, $result, $this->user->id);
                }

                $this->session->set_flashdata('success', lang('saved'));
                redirect($redirect);
            } else {
                $this->session->set_flashdata('error', lang('error_execution'));
                redirect(base_url('admin/programs/'.$hash));
            }

        }

        $data['name']             = $old_data->name;
        $data['category']         = $old_data->category;
        $data['order']            = $old_data->order;
        $data['description_text'] = $old_data->description;
        $data['tabs']             = $old_data->tabs;
        $data['image']            = (!empty($old_data->image)) ? site_url('images/'.$old_data->image) : '';

        $data['tags']            = $this->tags_model->getTagsAll();
        $data['exercises']       = $this->findExercises(TRUE, null, null, $old_data->id, true);
        $data['total_exercises'] = count($this->findExercises(TRUE, null, null, $old_data->id));

        if($this->user->id == $exercise_user) {
            $data['list_url'] = base_url('admin/programs');
        } else {
            $data['list_url'] = base_url('admin/programs/users');
        }

        $this->addStyle('app.css');
        $this->addStyle('editor/editor.css');
        $this->addStyle('admin.css');
        $this->addScript('jquery.ui.touch-punch.min.js');
        $this->addScript('jquery-ui.min.js');
        $this->addScript('app.js');
        $this->addScript('editor/trumbowyg.js');
        $this->addScript('editor/langs/ru.js');
        $this->template($data, 'backend', null, array('_nav', '_filter', '_popups'));
    }

    private function upload($file) {
        if($file) {
            $config['upload_path']             = './images/';
            $config['allowed_types']           = 'gif|jpg|png';
            $config['max_size']                = 1000;
            $config['max_filename_increment']  = 100;
            $config['encrypt_name']            = true;
            $config['file_ext_tolower']        = true;

            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload($file)) {
                $error = $this->session->set_flashdata('error', $this->upload->display_errors());
                return false;
            } else {
                $data = $this->upload->data();
                $setting_height = (int) $this->settings->image_height;
                $setting_width = (int) $this->settings->image_width;

                if($data['image_width'] > $setting_width && $data['image_height'] > $setting_height && $data['is_image']) {
                    $imge_config['image_library']  = 'gd2';
                    $imge_config['source_image']   = $data['full_path'];
                    $imge_config['maintain_ratio'] = TRUE;
                    $imge_config['width']          = (int) $this->settings->image_width;
                    $imge_config['height']         = (int) $this->settings->image_height;
                    $this->load->library('image_lib', $imge_config);

                    if (!$this->image_lib->resize()) {
                        $error = $this->session->set_flashdata('error', $this->image_lib->display_errors());
                    }
                    $this->image_lib->clear();
                }

                if(!empty($this->settings->tinypng_key)) {
                    $this->load->library('tinypng');
                    $this->tinypng->initialize($this->settings->tinypng_key);
                    $this->tinypng->shrink($data['full_path']);
                    $result =  $this->tinypng->getResultJson();

                    if(isset($result->output->url)) {
                        $compressed = file_get_contents($result->output->url);
                        if($compressed) {
                            file_put_contents($data['full_path'], $compressed);
                        }
                    }
                }

                return $data;
            }
        } else {
            return false;
        }
    }

    public function delete($hash) {
        if(!$hash) {
            $this->session->set_flashdata('error', lang('error_execution'));
            redirect(base_url('admin/programs'));
        }

        $this->onlyLoged();

        $program = $this->programs_model->getProgramByHash($hash, true);

        $redirect = $this->input->get('return');


        if(empty($redirect)) {
            $redirect = base_url('admin/programs');
        } else {
            $redirect = base_url($redirect);
        }

        if(!$program) {
            $this->session->set_flashdata('error', lang('error_execution'));
            redirect($redirect);
        }

        if($this->user->id != $program->user_id && !$this->user->is_admin) {
            $this->session->set_flashdata('error', lang('error_not_have_right'));
            redirect($redirect);
        } else {
            $result = $this->programs_model->setDeleted($program->id, $this->user);
            if($result) {
                $this->session->set_flashdata('success', lang('program_deleted'));
                redirect($redirect);
            } else {
                $this->session->set_flashdata('error', lang('error_execution'));
                redirect($redirect);
            }
        }
    }

    public function changeOrder($hash) {
        if(!$hash && !isset($this->user->id)) {
            $this->ajaxResponse(array(), lang('error_execution'));
            return false;
        }

        $order = (int) $this->input->post('order');
        $id    = (int) $this->programs_model->getProgramByHash($hash);

        if(!empty($order) && !empty($id)) {
            $result = $this->programs_model->changeOrder($order, $id, (int) $this->user->id, false, true);
            if($result) {
                $this->ajaxResponse(lang('execute_success'));
                return true;
            } else {
                $this->ajaxResponse(array(), lang('error_execution'));
                return false;
            }
        } else {
            $this->ajaxResponse(array(), lang('error_execution'));
            return false;
        }
    }


    private function findExercises($all = false, $param = null, $tags = null, $exclude = null, $deleted = false) {

        if($all) {
            $users = $this->user_model->getAdminId();
            if(!$this->user->is_admin) {
                $users[] = $this->user->id;
            }
        } else {
            $users = array($this->user->id);
        }

        if($param && is_string($param)) {
            $params = array(
                'name'        => trim($param),
                'name_desc'   => trim($param),
                'description' => trim($param)
            );
        } else {
            $params = null;
        }

        if(!$tags || !is_array($tags)) {
            $tags = null;
        }

        if(!$exclude || is_array($exclude)) {
            $exclude = null;
        }

        $results = $this->exercises_model->findExercises($users, (int) $this->user->id, $params, $tags, $exclude, $deleted);

        if($results) {
            return $results;
        } else {
            return false;
        }
    }

    private function findPrograms($all = false, $param = null, $tags = null, $exclude = null) {

        if($all) {
            $users = $this->user_model->getAdminId();
            if(!$this->user->is_admin) {
                $users[] = $this->user->id;
            }
        } else {
            $users = array($this->user->id);
        }

        if($param && is_string($param)) {
            $params = array(
                'name'        => trim($param),
                'description' => trim($param)
            );
        } else {
            $params = null;
        }

        if(!$tags || !is_array($tags)) {
            $tags = null;
        }

        if(!$exclude || is_array($exclude)) {
            $exclude = null;
        }

        $results = $this->programs_model->findPrograms($users, (int) $this->user->id, $params, $tags, $exclude);

        if($results) {
            return $results;
        } else {
            return false;
        }
    }


}