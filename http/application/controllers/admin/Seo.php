<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('meta_model');
        $this->load->model('programs_model');

        $this->lang->load('backend');

        $this->onlyAdmin();
    }

	public function index($page = 0) {
        $this->load->library('pagination');

        $data['title'] = lang('meta_list_title');

        $search = $this->input->get('search');
        $search = trim($search);

        $data['search'] = $search;

        if(!empty($search)) {
            $search_array = array(
                    'title'       => $search,
                    'description' => $search,
                    'keywords'    => $search,
                );
        } else {
            $search_array = array();
        }

        $total = $this->meta_model->getMetaList(null, 0, $search_array, true);
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

        $data['items']  = $this->meta_model->getMetaList($per_page, $page, $search_array, false, true);
        $data['action'] = base_url('admin/seo');

        $this->addStyle('admin.css');
        $this->template($data, 'backend');
	}

	public function add() {
		$data = array();
		$this->load->helper('form');
	    $this->load->library('form_validation');

		$data['title']  = lang('add_meta_title');
		$data['header'] = lang('add_meta_header');

		$this->form_validation->set_rules('page', lang('page'), 'trim|is_unique[meta.key]|callback_select_check');
		$this->form_validation->set_rules('title', lang('mata_title'), 'required|trim');
		$this->form_validation->set_rules('description', lang('mata_description'), 'required|trim');
		$this->form_validation->set_rules('keywords', lang('mata_keywords'), 'trim');

		$page        = $this->input->post('page');
		$title       = $this->input->post('title');
		$description = $this->input->post('description');
		$keywords    = $this->input->post('keywords');

		$data['types'] = array(
				'site/index/'            => lang('site/index/'),
				'site/feedback/'         => lang('site/feedback/'),
				'user/login/'            => lang('user/login/'),
				'user/recovery/'         => lang('user/recovery/'),
				'user/registration/'     => lang('user/registration/'),
				'user/confirm/'          => lang('user/confirm/'),
			);

		$programs = $this->meta_model->getPrograms();

		if(!empty($programs)){
			foreach ($programs as $key => $program) {
				$data['types']['programs/viewProgram/'.$program->hash] = lang('programs/viewProgram/').' '. $program->name.' ('.$program->user_surname.' '.$program->user_name.' '.$program->user_middle_name.')';
				$data['types']['programs/printProgram/'.$program->hash] = lang('programs/printProgram/').' '. $program->name.' ('.$program->user_surname.' '.$program->user_name.' '.$program->user_middle_name.')';
			}
		}
		if ($this->form_validation->run() === TRUE) {
			$method = str_replace(array('programs/printProgram/','programs/viewProgram/'), '', $page);
			$hash = md5($page + rand(5,10));

			$insert_data = array(
					'key'         => ($page != 'none') ? $page : '',
					'method'      => $method,
					'title'       => $title,
					'description' => $description,
					'keywords'    => $keywords,
					'hash'        => $hash
				);

			if($this->meta_model->saveMeta($insert_data)) {
				$this->session->set_flashdata('success', lang('meta_saved'));
    			redirect(base_url('admin/seo'));
			} else {
				$this->session->set_flashdata('error', lang('meta_save_error'));
				redirect(base_url('admin/seo/'.$hash));
			}
		}

		$data['_title']       = (!empty($title)) ? $title : '';
		$data['_description'] = (!empty($description)) ? $description : '';
		$data['_keywords']    = (!empty($keywords)) ? $keywords : '';
		$data['_type']        = (!empty($page) && $page != 'none') ? $page : '';

		$this->addStyle('admin.css');
		$this->template($data, 'backend');
	}

	public function edit($hash) {
		$data = array();

    	$old_data = $this->meta_model->getMetaByHash($hash, true);
    	if(!$old_data) {
    		show_404();
    	}

		$this->load->helper('form');
	    $this->load->library('form_validation');

		$data['title']  = lang('edit_meta_title');
		$data['header'] = lang('edit_meta_header');

		$this->form_validation->set_rules('page', lang('page'), 'trim|is_unique[meta.key]|callback_select_check');
		$this->form_validation->set_rules('title', lang('mata_title'), 'required|trim');
		$this->form_validation->set_rules('description', lang('mata_description'), 'required|trim');
		$this->form_validation->set_rules('keywords', lang('mata_keywords'), 'trim');

		$page        = $this->input->post('page');
		$title       = $this->input->post('title');
		$description = $this->input->post('description');
		$keywords    = $this->input->post('keywords');

		$data['types'] = array(
				'site/index/'            => lang('site/index/'),
				'site/feedback/'         => lang('site/feedback/'),
				'user/login/'            => lang('user/login/'),
				'user/recovery/'         => lang('user/recovery/'),
				'user/registration/'     => lang('user/registration/'),
				'user/confirm/'          => lang('user/confirm/'),
			);

		$programs = $this->meta_model->getPrograms();

		if(!empty($programs)){
			foreach ($programs as $key => $program) {
				$data['types']['programs/viewProgram/'.$program->hash] = lang('programs/viewProgram/').' '. $program->name.' ('.$program->user_surname.' '.$program->user_name.' '.$program->user_middle_name.')';
				$data['types']['programs/printProgram/'.$program->hash] = lang('programs/printProgram/').' '. $program->name.' ('.$program->user_surname.' '.$program->user_name.' '.$program->user_middle_name.')';
			}
		}

		if ($this->form_validation->run() === TRUE) {
			$method = str_replace(array('programs/printProgram/','programs/viewProgram/'), '', $page);
			$hash = md5($page + rand(5,10));

			$update_data = array(
					'key'         => ($page != 'none') ? $page : '',
					'method'      => $method,
					'title'       => $title,
					'description' => $description,
					'keywords'    => $keywords,
					'hash'        => $hash
				);

			$result = $this->meta_model->saveMeta($update_data, $old_data->id);

			if($result) {
				$this->session->set_flashdata('success', lang('meta_saved'));
    			redirect(base_url('admin/seo'));
			} else {
				$this->session->set_flashdata('error', lang('meta_save_error'));
				redirect(base_url('admin/seo/'.$old_data->hash));
			}
		}

		$data['hash']         = $old_data->hash;
		$data['_title']       = (!empty($title)) ? $title : $old_data->title;
		$data['_description'] = (!empty($description)) ? $description : $old_data->description;
		$data['_keywords']    = (!empty($keywords)) ? $keywords : $old_data->keywords;
		$data['_type']        = (!empty($page) && $page != 'none') ? $page : $old_data->key;

		$this->addStyle('admin.css');
		$this->template($data, 'backend');
	}

	public function select_check($str){
        if ($str == 'none') {
           	$this->form_validation->set_message('select_check', lang('select_required'));
           	return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete($hash) {
    	if(!$hash) {
    		$this->session->set_flashdata('error', lang('error_execution'));
			redirect(base_url('admin/seo'));
    	}

    	$this->onlyLoged();

    	$meta = $this->meta_model->getMetaByHash($hash);

    	if(!$meta) {
    		$this->session->set_flashdata('error', lang('error_execution'));
			redirect(base_url('admin/seo'));
    	}

    	if(!$this->user->is_admin) {
    		$this->session->set_flashdata('error', lang('error_not_have_right'));
    		redirect(base_url('admin/seo'));
    	} else {
    		$result = $this->meta_model->deleteMeta($meta);
    		if($result) {
    			$this->session->set_flashdata('success', lang('meta_deleted'));
    			redirect(base_url('admin/seo'));
    		} else {
    			$this->session->set_flashdata('error', lang('error_execution'));
				redirect(base_url('admin/seo'));
    		}
    	}
    }
}