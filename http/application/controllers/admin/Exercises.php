<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercises extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('settings_model');
        $this->load->model('tags_model');
        $this->load->model('exercises_model');

        $this->lang->load('backend');

        $this->onlyAdmin();
    }

	public function index($page = 0) {

		$this->load->library('pagination');

		$data['title'] = lang('exercise_list_title');

        $search = $this->input->get('search');
        $search = trim($search);

        $data['search'] = $search;

        if(!empty($search)) {
            $search_array = array(
                    'name'        => $search,
                    'name_desc'   => $search,
                    'description' => $search
                );
        } else {
            $search_array = array();
        }

		$total = $this->exercises_model->getExercisesListAdmin($this->user->id, null, 0, $search_array, true);
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

		$data['pagination'] = $this->pagination->render($total, $per_page, base_url('admin/exercises'), 3);

		$data['items']  = $this->exercises_model->getExercisesListAdmin($this->user->id, $per_page, $page, $search_array);
		$data['action'] = base_url('admin/exercises');

        $this->addStyle('admin.css');
		$this->template($data, 'backend');
	}

    public function users($page = 0) {

        $this->load->library('pagination');

        $data['title'] = lang('user_exercises_title');

        $search = $this->input->get('search');
        $search = trim($search);

        $data['search'] = $search;

        if(!empty($search)) {
            $search_array = array(
                    'name'             => $search,
                    'name_desc'        => $search,
                    'description'      => $search,
                    'surname'          => $search,
                    'name'             => $search,
                    'middle_name'      => $search,
                );
        } else {
            $search_array = array();
        }

        $total = $this->exercises_model->getExercisesListAdmin(false, null, 0, $search_array, true);
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

        $data['pagination'] = $this->pagination->render($total, $per_page, base_url('admin/exercises'), 4);

        $data['items']  = $this->exercises_model->getExercisesListAdmin(false, $per_page, $page, $search_array, false, true);
        $data['action'] = base_url('admin/exercises/users');

        $this->addStyle('admin.css');
        $this->template($data, 'backend');
    }

    public function add() {
    	$data =  array();
	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $data['title']  = lang('exercise_add_title');
    	$data['header'] = lang('exercise_add_header');

    	$this->form_validation->set_rules('name', lang('name'), 'required|trim');
    	$this->form_validation->set_rules('order', lang('order'), 'integer|trim');
    	$this->form_validation->set_rules('image_1', lang('exercise_image_1'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
    	$this->form_validation->set_rules('image_2', lang('exercise_image_2'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
    	$this->form_validation->set_rules('image_3', lang('exercise_image_3'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
        $this->form_validation->set_rules('redirect', lang('redirect'), 'trim');

    	$name          = $this->input->post('name');
    	$name_desc     = $this->input->post('name_desc');
    	$order         = (int) $this->input->post('order');
    	$video         = $this->input->post('video');
    	$description   = $this->input->post('description');
    	$tags_data     = $this->input->post('tags');
    	$related       = $this->input->post('related');
    	$progress      = $this->input->post('progress');

    	if ($this->form_validation->run() === TRUE) {
            $redirect     = $this->input->post('redirect');
    		$change_order = false;
    		$hash = md5($this->user->id . ' ' . date ('Y-m-d H:i:s') . ' ' . rand(7, 15));

	    	if(isset($_FILES['image_1']) && !empty($_FILES['image_1']['name'])) {
	    		$file_1 = $this->upload('image_1');
	    		if($file_1) {
	    			$file_1 = $file_1['file_name'];
	    		} else {
	    			$file_1 = null;
	    		}
	    	} else {
	    		$file_1 = null;
	    	}

	    	if(isset($_FILES['image_2']) && !empty($_FILES['image_2']['name'])) {
	    		$file_2 = $this->upload('image_2');
	    		if($file_2) {
	    			$file_2 = $file_2['file_name'];
	    		} else {
	    			$file_2 = null;
	    		}
	    	} else {
	    		$file_2 = null;
	    	}

	    	if(isset($_FILES['image_3']) && !empty($_FILES['image_3']['name'])) {
	    		$file_3 = $this->upload('image_3');
	    		if($file_3) {
	    			$file_3 = $file_3['file_name'];
	    		} else {
	    			$file_3 = null;
	    		}
	    	} else {
	    		$file_3 = null;
	    	}

	    	if(empty($order)) {
	    		$order = $this->exercises_model->getLastNum($this->user->id) + 1;
	    	} else {
	    		$change_order = true;
	    	}

    		$insert = array(
    				'name'        => $name,
    				'name_desc'   => $name_desc,
    				'order'       => $order,
    				'video'       => $video,
    				'description' => preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $description),
    				'user_id'     => $this->user->id,
    				'hash'        => $hash
    			);

    		if($file_1) {
    			$insert['image_1'] = $file_1;
    		}

    		if($file_2) {
    			$insert['image_2'] = $file_2;
    		}

    		if($file_3) {
    			$insert['image_3'] = $file_3;
    		}


    		$result = $this->exercises_model->saveExercise($insert);

    		if($result) {
                if(empty($redirect)) {
                    $redirect = base_url('admin/exercises/'.$hash);
                }

    			if(!empty($tags_data)) {
    				$this->exercises_model->setFilters($result, $tags_data);
    			}

    			if(!empty($related)) {
    				$this->exercises_model->setRelations($result, $related);
    			}

    			if(!empty($progress)) {
    				$this->exercises_model->setRelations($result, $progress, 'progress');
    			}

    			if($change_order) {
    				$this->exercises_model->changeOrder($order, $result, $this->user->id);
    			}
    			$this->session->set_flashdata('success', lang('saved'));
    			redirect($redirect);
    		} else {
    			$this->session->set_flashdata('error', lang('error_execution'));
				redirect(base_url('admin/exercises/add'));
    		}

    	}

    	$data['name']              = (isset($name)) ? $name : '';
    	$data['name_desc']         = (isset($name_desc)) ? $name_desc : '';
    	$data['order']             = (isset($order) && !empty($order)) ? $order : '';
    	$data['video']             = (isset($video)) ? $video : '';
    	$data['description_text']  = (isset($description)) ? $description : '';
    	$data['tags_data']         = (isset($tags_data)) ? $tags_data : array();
    	$data['related']           = (isset($related)) ?  $this->exercises_model->getExercises($related) : array();
    	$data['progress']          = (isset($progress)) ?  $this->exercises_model->getExercises($progress) : array();
    	$data['image_1']           = (isset($image_1)) ? site_url('images/'.$file_1) : null;
    	$data['image_2']           = (isset($image_2)) ?site_url('images/'.$file_2) : null;
    	$data['image_3']           = (isset($image_3)) ? $data['image_3'] = site_url('images/'.$file_3) : null;

    	$data['tags']              = $this->tags_model->getTagsAll();
    	$data['exercises']         = $this->findExercises(TRUE);
    	$data['total_exercises']   = count($data['exercises']);

        $data['list_url'] = base_url('admin/exercises');

    	$this->addStyle('app.css');
    	$this->addStyle('editor/editor.css');
    	$this->addScript('jquery.ui.touch-punch.min.js');
    	$this->addScript('jquery-ui.min.js');
    	$this->addScript('app.js');
    	$this->addScript('editor/trumbowyg.js');
    	$this->addScript('editor/langs/ru.js');
	    $this->template($data, 'backend', null, array('_nav', '_filter', '_popups'));
    }

    public function edit($hash) {
    	$data =  array();

    	$old_data = $this->exercises_model->getExercises($hash);
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
    	if(empty($old_data->image_1) || (isset($_FILES['image_1']) && !empty($_FILES['image_1']['name']))){
    		$this->form_validation->set_rules('image_1', lang('exercise_image_1'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
    	}
		if(empty($old_data->image_2) || (isset($_FILES['image_2']) && !empty($_FILES['image_2']['name']))){
    		$this->form_validation->set_rules('image_2', lang('exercise_image_2'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
    	}
    	if(empty($old_data->image_3) || (isset($_FILES['image_3']) && !empty($_FILES['image_3']['name']))){
    		$this->form_validation->set_rules('image_3', lang('exercise_image_3'), 'file_allowed_type[gif,jpg,png]|file_size_max[1000]');
    	}
        $this->form_validation->set_rules('redirect', lang('redirect'), 'trim');

    	if ($this->form_validation->run() === TRUE) {
	    	$name          = $this->input->post('name');
	    	$name_desc     = $this->input->post('name_desc');
	    	$order         = (int) $this->input->post('order');
	    	$video         = $this->input->post('video');
	    	$description   = $this->input->post('description');
	    	$tags_data     = $this->input->post('tags');
	    	$related       = $this->input->post('related');
	    	$progress      = $this->input->post('progress');
            $redirect      = $this->input->post('redirect');

    		$change_order = false;
    		$hash = $old_data->hash;

	    	if(isset($_FILES['image_1']) && !empty($_FILES['image_1']['name'])) {
	    		$file_1 = $this->upload('image_1');
	    		if($file_1) {
	    			$file_1 = $file_1['file_name'];
	    		} else {
	    			$file_1 = null;
	    		}
	    	} else {
	    		$file_1 = null;
	    	}

	    	if(isset($_FILES['image_2']) && !empty($_FILES['image_2']['name'])) {
	    		$file_2 = $this->upload('image_2');
	    		if($file_2) {
	    			$file_2 = $file_2['file_name'];
	    		} else {
	    			$file_2 = null;
	    		}
	    	} else {
	    		$file_2 = null;
	    	}

	    	if(isset($_FILES['image_3']) && !empty($_FILES['image_3']['name'])) {
	    		$file_3 = $this->upload('image_3');
	    		if($file_3) {
	    			$file_3 = $file_3['file_name'];
	    		} else {
	    			$file_3 = null;
	    		}
	    	} else {
	    		$file_3 = null;
	    	}

    		$insert = array(
    				'name'        => $name,
    				'name_desc'   => $name_desc,
    				'video'       => $video,
    				'description' => preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $description),
    				'hash'        => $hash
    			);

    		if($order != $old_data->order) {
    			$insert['order'] = $order;
    			$change_order = true;
    		}

    		if($file_1) {
    			$insert['image_1'] = $file_1;
    		}

    		if($file_2) {
    			$insert['image_2'] = $file_2;
    		}

    		if($file_3) {
    			$insert['image_3'] = $file_3;
    		}

    		$result = $this->exercises_model->saveExercise($insert, $old_data->id);

    		if($result) {
                if(empty($redirect)) {
                    $redirect = base_url('admin/exercises/'.$hash);
                }

    			$this->exercises_model->setFilters($result, $tags_data);

    			$this->exercises_model->setRelations($result, $related);

    			$this->exercises_model->setRelations($result, $progress, 'progress');

    			if($change_order) {
    				$this->exercises_model->changeOrder($order, $result, $this->user->id);
    			}
    			$this->session->set_flashdata('success', lang('saved'));
    			redirect($redirect);
    		} else {
    			$this->session->set_flashdata('error', lang('error_execution'));
				redirect(base_url('admin/exercises/'.$hash));
    		}

    	}

    	$data['name']             = $old_data->name;
    	$data['name_desc']        = $old_data->name_desc;
    	$data['order']            = $old_data->order;
    	$data['video']            = $old_data->video;
    	$data['description_text'] = $old_data->description;
    	$data['tags_data']        = $old_data->tags;
    	$data['related']          = $old_data->related;
    	$data['progress']         = $old_data->progress;
    	$data['image_1']          = (!empty($old_data->image_1)) ? site_url('images/'.$old_data->image_1) : '';
    	$data['image_2']          = (!empty($old_data->image_2)) ? site_url('images/'.$old_data->image_2) : '';
    	$data['image_3']          = (!empty($old_data->image_3)) ? site_url('images/'.$old_data->image_3) : '';

    	$data['tags']            = $this->tags_model->getTagsAll();
    	$data['exercises']       = $this->findExercises(TRUE, null, null, $old_data->id);
    	$data['total_exercises'] = count($data['exercises']);

        if($this->user->id == $exercise_user) {
            $data['list_url'] = base_url('admin/exercises');
        } else {
            $data['list_url'] = base_url('admin/exercises/users');
        }

    	$this->addStyle('app.css');
    	$this->addStyle('editor/editor.css');
    	$this->addScript('jquery.ui.touch-punch.min.js');
    	$this->addScript('jquery-ui.min.js');
    	$this->addScript('app.js');
    	$this->addScript('editor/trumbowyg.js');
    	$this->addScript('editor/langs/ru.js');
	    $this->template($data, 'backend', null, array('_nav', '_filter', '_popups'));
    }

    public function delete($hash) {
    	if(!$hash) {
    		$this->session->set_flashdata('error', lang('error_execution'));
			redirect(base_url('admin/exercises'));
    	}

    	$this->onlyLoged();

    	$exercise = $this->exercises_model->getExerciseByHash($hash, true);

        $redirect = $this->input->get('return');

        if(empty($redirect)) {
            $redirect = base_url('admin/exercises');
        } else {
            $redirect = base_url($redirect);
        }

    	if(!$exercise) {
    		$this->session->set_flashdata('error', lang('error_execution'));
			redirect($redirect);
    	}

    	if($this->user->id != $exercise->user_id && !$this->user->is_admin) {
    		$this->session->set_flashdata('error', lang('error_not_have_right'));
    		redirect($redirect);
    	} else {
    		$result = $this->exercises_model->setDeleted($exercise->id, $this->user);
    		if($result) {
    			$this->session->set_flashdata('success', lang('exercise_deleted'));
    			redirect($redirect);
    		} else {
    			$this->session->set_flashdata('error', lang('error_execution'));
				redirect($redirect);
    		}
    	}
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
	        	return $data;
	        }
	    } else {
	    	return false;
	    }
    }

    public function changeOrder($hash) {
        if(!$hash && !isset($this->user->id)) {
            $this->ajaxResponse(array(), lang('error_execution'));
            return false;
        }

        $order = (int) $this->input->post('order');
        $id    = (int) $this->exercises_model->getExerciseByHash($hash);

        if(!empty($order) && !empty($id)) {
            $result = $this->exercises_model->changeOrder($order, $id, (int) $this->user->id, false, true);
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

}