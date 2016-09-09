<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');

        $this->lang->load('backend');

        $this->onlyAdmin(false);
    }

	public function index($page = 0) {
		$this->load->library('pagination');

		$data['title'] = lang('users_list_title');

        $search = $this->input->get('search');
        $search = trim($search);

        $data['search'] = $search;

        if(!empty($search)) {
            $search_array = array(
            		'name'        => $search,
            		'surname'     => $search,
            		'middle_name' => $search,
            		'region'      => $search,
            		'phone'       => $search,
            		'type'        => $search,
                );
        } else {
            $search_array = array();
        }

		$total = $this->user_model->getUserList(null, 0, $search_array, true);
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

		$data['pagination'] = $this->pagination->render($total, $per_page, base_url('admin/users'), 3);

		$data['items']  = $this->user_model->getUserList($per_page, $page, $search_array);
		$data['action'] = base_url('admin/users');

		$this->addStyle('admin.css');
		$this->template($data, 'backend');
	}


	public function detail($url = null) {
		if(!$url) {
			$this->session->set_flashdata('error', lang('error_execution'));
			redirect(base_url('admin/users'));
		}

		$user = $this->user_model->getUserByUrl($url, true);

		if($user) {
			$data['title']  = $user->surname.' '.$user->name.' '.$user->middle_name;;
			$data['header'] = $data['title'];
			$data['user']   = $user;
	        $this->addStyle('admin.css');
	        $this->template($data, 'backend');
		} else {
			show_404();
		}
	}
}