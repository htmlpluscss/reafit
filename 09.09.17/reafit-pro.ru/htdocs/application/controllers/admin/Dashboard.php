<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('exercises_model');
        $this->load->model('programs_model');

        $this->lang->load('backend');

        $this->onlyAdmin();
    }

	public function index() {
		$data = array();

        $admins = $this->user_model->getAdminId();

        $data['users']             = $this->user_model->getTotalUsers($admins);
        $data['users_programs']    = $this->user_model->getTotalByUserNot($admins, 'programs');
        $data['users_exercises']   = $this->user_model->getTotalByUserNot($admins);

        $data['last_reg_users']    = $this->user_model->getLastUsers(10, 0);
        $data['last_active_users'] = $this->user_model->getLastUsers(10, 0, $order = array('last_login'=>'DESC'));

        $data['last_programs']     = $this->programs_model->getProgramsLast($admins, 10, 0, array(), false, true);
        $data['last_exercises']    = $this->exercises_model->getExercisesLast($admins, 10, 0, array(), false, true);

        $data['admin_programs']    = $this->user_model->getTotalByUser($admins, 'programs');
        $data['admin_exercises']   = $this->user_model->getTotalByUser($admins);

		$this->addStyle('admin.css');
		$this->template($data, 'backend');
	}


}