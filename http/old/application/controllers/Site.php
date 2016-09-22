<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('settings_model');

        $this->lang->load('frontend');
    }

	public function index()
	{
		$this->load->model('exercises_model');
        $this->load->model('programs_model');

		$settings = $this->settings_model->getValues(array('home_title', 'home_header', 'home_video', 'home_text', 'home_end_text'));

		$data['header']   = $settings->home_header;
		$data['text']     = $settings->home_text;
		$data['video']    = $settings->home_video;
		$data['end_text'] = $settings->home_end_text;

		if(isset($this->user->id)) {
			$id = (int) $this->user->id;
	        $data['last_programs']     = $this->programs_model->getProgramsLast($id, 10, 0, array(), false, true);
	        $data['last_exercises']    = $this->exercises_model->getExercisesLast($id, 10, 0, array(), false, true);

	        $data['users_programs']    = $this->user_model->getTotalByUser($id, 'programs');
        	$data['users_exercises']   = $this->user_model->getTotalByUser($id);
		}

		if($this->user) {
			$settings = $this->settings_model->getValues(array('main_add_prog', 'main_open_prog', 'main_add_app', 'main_open_app'));
			$data['add_prog']   = $settings->main_add_prog;
			$data['open_prog']  = $settings->main_open_prog;
			$data['add_app']    = $settings->main_add_app;
			$data['open_app']   = $settings->main_open_app;
		}

		$this->template($data);
	}

    public function feedback() {
    	$this->load->model('user_model');
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->load->library('logging');
	    $logger = $this->logging->get_logger('feedback');

	    $data['title'] = lang('feedback_title');

	    $this->form_validation->set_rules('mail', lang('email'), 'valid_email|required|trim');
	    $this->form_validation->set_rules('phone', lang('phone'), 'required|trim');
	    $this->form_validation->set_rules('subject', lang('subject'), 'required|trim');
	    $this->form_validation->set_rules('message', lang('message'), 'required|trim');

	    $mail       = $this->input->post('mail');
	    $phone      = $this->input->post('phone');
	    $subject    = $this->input->post('subject');
	    $message    = $this->input->post('message');

	    if ($this->form_validation->run() === TRUE) {
	    	$this->load->library('email');

	    	$settings = $this->settings_model->getValues(array('site_name', 'bot_mail', 'feedback_text'));

			$text = str_replace(
	    				array(
							'{SUBJECT}',
							'{EMAIL}',
							'{PHONE}',
							'{MESSAGE}',
							'{DATE}'
	    				),
	    				array(
	    					$subject,
	    					$mail,
	    					$phone,
	    					$message,
	    					date('Y-m-d H:i:s')
	    				),
	    				$settings->feedback_text
	    			);

				$this->email->from($settings->bot_mail, $settings->site_name);
				$this->email->to($mail);
				$this->email->subject($subject);
				$this->email->message($text);

				if($this->email->send()) {
					$mail     = '';
					$phone    = '';
				    $subject  = '';
				    $message  = '';
					$this->session->set_flashdata('success', lang('feedback_sccess'));

					$logger->info(lang('feedback')."\n".$text);

		    	} else {
		    		$this->session->set_flashdata('error', lang('mail_send_error'));

		    		$logger->info(lang('feedback')."\n".$text);
		    	}
		    	redirect(base_url('feedback'));
	    }

	    if(empty($mail) && isset($this->user)) {
	    	$data['mail'] = $this->user->email;
	    } else {
	    	$data['mail'] = $mail;
	    }

	    if(empty($phone) && isset($this->user)) {
	    	$user = $this->user_model->getUserData($this->user->email);
	    	$data['phone'] = $user->phone;
	    } else {
	    	$data['phone'] = $phone;
	    }

	    $data['subject'] = $subject;
	    $data['message'] = $message;

	    $this->template($data);
    }

	public function error()
	{
		$this->output->set_status_header('404'); 
		$settings = $this->settings_model->getValues(array('home_title', 'home_header', 'home_video', 'home_text', 'home_end_text'));

		$data['header']   = lang('404_title');
		$data['text']     = lang('404_text');

		$this->template_error($data);
	}
}
