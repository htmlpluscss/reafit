<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->lang->load('backend');

        $this->onlyAdmin(false);
    }

	public function index() {
		$data = array();
		$this->load->helper('form');
	    $this->load->library('form_validation');

		$data['title'] = lang('settings_title');

		$all_settings = $this->settings_model->getAllSettings();

		foreach ($all_settings as $key => $setting) {
			$this->form_validation->set_rules($setting->key, lang($setting->key), $setting->validation);
		}

		if ($this->form_validation->run() === TRUE) {
			$update_data = array();
			foreach ($all_settings as $key => $setting) {
				$update_data[] = array(
						'key'   => $setting->key,
						'value' => $this->input->post($setting->key)
					);
			}

			$result = $this->settings_model->updateAllSettings($update_data);

			if($result) {
				$this->session->set_flashdata('success', lang('settings_saved'));
    			redirect(base_url('admin/settings'));
			} else {
				$this->session->set_flashdata('error', lang('settings_save_error'));
				redirect(base_url('admin/settings'));
			}
		}

		$data['settings'] = $all_settings;

		$this->addStyle('admin.css');
		$this->template($data, 'backend');
	}


}