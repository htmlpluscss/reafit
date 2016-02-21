<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('settings_model');
        $this->load->model('programs_model');
        $this->load->model('tags_model');

        $this->lang->load('frontend');
    }

	public function index($page = 0) {
		$this->onlyLoged();
		if($this->user->is_admin) {
			redirect(base_url('admin/programs'));
		}

		$this->load->library('pagination');

		$data['title'] = lang('program_list_title');

		$total = $this->programs_model->getProgramsListTotal($this->user->id);
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

		$data['pagination'] = $this->pagination->render($total, $per_page, base_url('programs'), 2);

		$data['items']  = $this->programs_model->getProgramsList($this->user, $per_page, $page);
		$data['action'] = base_url('programs');

		$this->template($data);
	}

    public function add() {
        $data =  array();
        if($this->user->is_admin) {
            redirect(base_url('admin/programs/add'));
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title']  = lang('program_add_title');
        $data['header'] = lang('program_add_header');

        $this->form_validation->set_rules('name', lang('name'), 'required|trim');
        $this->form_validation->set_rules('order', lang('order'), 'integer|trim');
        $this->form_validation->set_rules('image', lang('program_image'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');

        $name          = $this->input->post('name');
        $mail          = $this->input->post('mail');
        $description   = $this->input->post('description');
        $exercises       = $this->input->post('exercises');

        if ($this->form_validation->run() === TRUE) {
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

            $total = $this->programs_model->getProgramsListTotal($this->user->id);

            $insert = array(
                    'name'        => $name,
                    'description' => $description,
                    'user_id'     => $this->user->id,
                    'mail'        => $mail,
                    'hash'        => $hash,
                    'created'     => date('Y-m-d H:i:s'),
                    'order'       => (int) $total + 1
                );

            if($image) {
                $insert['image'] = $image;
            }

            $result = $this->programs_model->saveProgram($insert);

            if($result) {

                if(!empty($exercises)) {
                    $this->programs_model->setTabs($result, $this->user->id, $exercises);
                }

                $this->session->set_flashdata('success', lang('saved'));
                redirect(base_url('programs/'.$hash));
            } else {
                $this->session->set_flashdata('error', lang('error_execution'));
                redirect(base_url('programs/add'));
            }
        }

        $data['name']              = (isset($name)) ? $name : '';
        $data['mail']              = (isset($mail)) ? $mail : '';
        $data['description_text']  = (isset($description)) ? $description : '';
        $data['image']             = (isset($image)) ? site_url('images/'.$image) : null;

        $_exercises = array();
        if(!empty($exercises)) {
            foreach ($exercises as $key => $exercise) {
                if(isset($exercise['exercises']) && !empty($exercise['exercises'])) {
                    foreach ($exercise['exercises'] as $key => $value) {
                        $_exercises[] = $this->exercises_model->getExercises($value);
                    }
                }
            }
        }

        $data['program_exercises'] = ($_exercises) ?  $_exercises : array();

        $data['tags']              = $this->tags_model->getTagsAll();
        $data['exercises']         = $this->findExercises(TRUE);
        $data['programs']          = $this->findPrograms(true);
        $data['total_exercises']   = count($data['exercises']);

        $data['items']             = $this->programs_model->getProgramsList($this->user);

        $data['list_url']          = base_url('programs');

        $this->addStyle('app.css');
        $this->addScript('jquery.ui.touch-punch.min.js');
        $this->addScript('jquery-ui.min.js');
        $this->addScript('app.js');
        $this->template($data, 'frontend', null, array('_nav', '_filter', '_popups'));
    }

    public function edit($hash) {
        $data =  array();

        if($this->user->is_admin) {
            redirect(base_url('admin/programs/'.$hash));
        }

        $old_data = $this->programs_model->getPrograms($hash);
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
        if(empty($old_data->image) || (isset($_FILES['image']) && !empty($_FILES['image']['name']))){
            $this->form_validation->set_rules('image', lang('image'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
        }

        if ($this->form_validation->run() === TRUE) {
            $exercises     = $this->input->post('exercises');
            $name          = $this->input->post('name');
            $mail          = $this->input->post('mail');
            $description   = $this->input->post('description');
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
                    'edited'      => date ('Y-m-d H:i:s'),
                    'name'        => $name,
                    'mail'        => $mail,
                    'description' => $description
                );

            if($file_1) {
                $insert['image'] = $file_1;
            }

            $result = $this->programs_model->saveProgram($insert, $old_data->id);

            if($result) {

                if(!empty($exercises)) {
                    $this->programs_model->setTabs($result, $this->user->id, $exercises);
                }

                $this->session->set_flashdata('success', lang('saved'));
                redirect(base_url('programs/'.$hash));
            } else {
                $this->session->set_flashdata('error', lang('error_execution'));
                redirect(base_url('programs/'.$hash));
            }

        }

        $data['name']              = $old_data->name;
        $data['mail']              = $old_data->mail;
        $data['description_text']  = $old_data->description;
        $data['tabs']              = $old_data->tabs;
        $data['image']             = (!empty($old_data->image)) ? site_url('images/'.$old_data->image) : '';

        $data['tags']              = $this->tags_model->getTagsAll();
        $data['hash']              = $old_data->hash;

        $data['items']             = $this->programs_model->getProgramsList($this->user);

        $data['tabs']              = ($old_data->tabs) ?  $old_data->tabs : array();
        $data['exercises']         = $this->findExercises(TRUE);

        $data['programs']          = $this->findPrograms(true, null, null, $old_data->id);
        $data['total_exercises']   = count($data['exercises']);

        $data['list_url'] = base_url('programs');

        $this->addStyle('app.css');
        $this->addScript('jquery.ui.touch-punch.min.js');
        $this->addScript('jquery-ui.min.js');
        $this->addScript('app.js');
        $this->template($data, 'frontend', null, array('_nav', '_filter', '_popups'));
    }

    public function programToMail($hash) {
        if(!$hash && !isset($this->user->id)) {
            $this->ajaxResponse(array(), lang('error_execution'));
            return false;
        }

        $mail = $this->input->post('mail');

        $program = $this->programs_model->getProgramByHash($hash, true);

        if(!$program && empty($mail)) {
            $this->ajaxResponse(array(), lang('error_execution'));
            return false;
        }

        if($this->user->id != $program->user_id) {
            $this->ajaxResponse(array(), lang('error_not_have_right'));
            return false;
        } else {
            $this->load->library('email');

            $settings = $this->settings_model->getValues(array('site_name', 'bot_mail', 'program_mail_text', 'program_mail_subject'));

            $subject = str_replace(
                        array(
                            '{SITE_NAME}',
                            '{PROGRAM_NAME}',
                            '{DATE}',
                        ),
                        array(
                            $settings->site_name,
                            $program->name,
                            date('Y-m-d H:i:s')
                        ),
                        $settings->program_mail_subject
                    );

            $text = str_replace(
                        array(
                            '{SITE_NAME}',
                            '{PROGRAM_NAME}',
                            '{PROGRAM_DESC}',
                            '{PROGRAM_MAIL}',
                            '{PRINT_LINK}',
                            '{VIEW_LINK}',
                            '{DATE}',
                        ),
                        array(
                            $settings->site_name,
                            $program->name,
                            $program->description,
                            $program->mail,
                            $this->config->item('host_url').'print/'.$program->hash,
                            $this->config->item('host_url').$program->hash,
                            date('Y-m-d H:i:s')
                        ),
                        $settings->program_mail_text
                    );

            $this->email->from($settings->bot_mail, $settings->site_name);
            $this->email->to($mail);
            $this->email->subject($subject);
            $this->email->message($text);

            if($this->email->send()) {
                $this->ajaxResponse(lang('program_send_to_mail'));
                return true;
            } else {
                $this->ajaxResponse(array(), lang('error_execution'));
                return false;
            }
        }
    }

    public function viewProgram($hash) {
        $data =  array();

        $old_data = $this->programs_model->getPrograms($hash);
        if(!$old_data) {
            show_404();
        }
        $data['title']             = $old_data->name;

        $data['name']              = $old_data->name;
        $data['header']            = $old_data->name;
        $data['mail']              = $old_data->mail;
        $data['description_text']  = $old_data->description;
        $data['tabs']              = $old_data->tabs;
        $data['hash']              = $old_data->hash;

        $data['print_url']         = base_url('print/'.$old_data->hash);

        $this->addStyle('app.css');
        $this->addScript('jquery.ui.touch-punch.min.js');
        $this->addScript('jquery-ui.min.js');
        $this->addScript('app.js');
        $this->template($data, 'frontend', null, array('_nav', '_popups'));
    }

    public function printProgram($hash) {
        $data =  array();

        $old_data = $this->programs_model->getPrograms($hash);
        if(!$old_data) {
            show_404();
        }
        $data['title']             = $old_data->name;

        $data['name']              = $old_data->name;
        $data['header']            = $old_data->name;
        $data['mail']              = $old_data->mail;
        $data['description_text']  = $old_data->description;
        $data['tabs']              = $old_data->tabs;
        $data['hash']              = $old_data->hash;

        $data['print_url']         = base_url('print/'.$old_data->hash);

        $this->addStyle('app.css');
        $this->addStyle('print.css');
        $this->addScript('jquery.ui.touch-punch.min.js');
        $this->addScript('jquery-ui.min.js');
        $this->addScript('app.js');
        $this->template($data, 'frontend', null, array('_nav', '_popups'));
    }

    /*public function saveProgramData($hash) {
        if(!$hash && !isset($this->user->id)) {
            $this->ajaxResponse(array(), lang('error_execution'));
            return false;
        }

        $tab        = $this->input->post('tab');
        $exercise   = $this->input->post('exercise');
        $ralation   = (int) $this->input->post('ralation');
        $quantity   = (int) $this->input->post('quantity');
        $approaches = (int) $this->input->post('approaches');
        $weight     = $this->input->post('weight');
        $weight     = (!empty($weight)) ? (float) $weight : '';
        $comment    = $this->input->post('comment');

        $program = $this->programs_model->getProgramByHash($hash, true);

        if(!$program) {
            $this->ajaxResponse(array(), lang('error_execution'));
            return false;
        }

        $tab      = $this->programs_model->getTabByHash($tab, false);
        $exercise = $this->exercises_model->getExerciseByHash($exercise, false);

        $data = array(
                'quantity'   => $quantity,
                'approaches' => $approaches,
                'weight'     => $weight,
                'comment'    => $comment
            );

        $where = array(
                'id'          => (int) $ralation,
                'tab_id'      => (int) $tab,
                'exercise_id' => (int) $exercise,
                'program_id'  => (int) $program->id
            );

        if($this->user->id != $program->user_id) {
            $this->ajaxResponse(array(), lang('error_not_have_right'));
            return false;
        } else {
            $result = $this->programs_model->setExerciseData($where, $data);
            if($result) {
                $this->ajaxResponse(lang('exercise_data_saved'));
                return true;
            } else {
                $this->ajaxResponse(array(), lang('error_execution'));
                return false;
            }
        }
    }*/

    public function delete($hash) {
    	if(!$hash) {
    		$this->session->set_flashdata('error', lang('error_execution'));
			redirect(base_url('programs'));
    	}

    	$this->onlyLoged();

    	$program = $this->programs_model->getProgramByHash($hash, true);

    	if(!$program) {
    		$this->session->set_flashdata('error', lang('error_execution'));
			redirect(base_url('programs'));
    	}

    	if($this->user->id != $program->user_id && !$this->user->is_admin) {
    		$this->session->set_flashdata('error', lang('error_not_have_right'));
    		redirect(base_url('programs'));
    	} else {
    		$result = $this->programs_model->setDeleted($program->id, $this->user);
    		if($result) {
    			$this->session->set_flashdata('success', lang('program_deleted'));
    			redirect(base_url('programs'));
    		} else {
    			$this->session->set_flashdata('error', lang('error_execution'));
				redirect(base_url('programs'));
    		}
    	}
    }

    public function favorite($hash) {
    	if(!$hash && !isset($this->user->id)) {
    		$this->ajaxResponse(array(), lang('error_execution'));
    		return false;
    	}

    	$action = (int) $this->input->post('type');

    	if(!empty($action)) {
    		$result = $this->programs_model->addFavorite($this->user->id, $hash);
    		if($result) {
    			$this->ajaxResponse(lang('execute_success'));
    			return true;
    		} else {
    			$this->ajaxResponse(array(), lang('error_execution'));
    			return false;
    		}
    	} else {
    		$result = $this->programs_model->removeFavorite($this->user->id, $hash);
    		if($result) {
    			$this->ajaxResponse(lang('execute_success'));
    			return true;
    		} else {
    			$this->ajaxResponse(array(), lang('error_execution'));
    			return false;
    		}
    	}
    }


    private function findExercises($all = false, $param = null, $tags = null, $exclude = null) {

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

        $results = $this->exercises_model->findExercises($users, (int) $this->user->id, $params, $tags, $exclude);

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