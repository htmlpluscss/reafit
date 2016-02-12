<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('settings_model');

        $this->lang->load('frontend');
    }


    public function login() {
    	$this->ifLogin();

    	$this->load->helper('cookie');
	    $this->load->helper('form');
	    $this->load->library('form_validation');


	    $data['title'] = lang('login_title');

	    $this->form_validation->set_rules('mail', lang('email'), 'valid_email|required|trim');
	    $this->form_validation->set_rules('pass', lang('password'), 'required|trim');

	    $mail = $this->input->post('mail');
	    $pass = $this->input->post('pass');
	    $remember = (int) $this->input->post('remember');

	    if ($this->form_validation->run() === TRUE) {
	    	$login = $this->user_model->login($mail, $pass);

	        if($login) {
	        	$this->session->set_userdata('logged', $login);
	        	if($remember) {
	        		$autologin = md5($login->email.'-'.date ('Y-m-d H:i:s') . ' ' . rand(5, 10));
	        		$this->user_model->setAutoLogin($login->email, $autologin);
	        		set_cookie('autologin', $autologin, $this->config->item('autologin'),  $this->config->item('domain'), '/', '', FALSE, TRUE);
	        	}
	        	if($login->is_admin) {
	        		redirect(base_url('admin'));
	        	} else {
	        		redirect(base_url());
	        	}
	        } else {
	        	$this->session->set_flashdata('error', lang('error_login'));
	        	redirect(base_url('login'));
	        }
	    }

	    $data['mail'] = $mail;
	    if($remember) {
	    	$data['remember'] = true;
	    } else {
	    	$data['remember'] = false;
	    }

	    $this->template($data);

    }

    public function logout() {
    	$this->load->helper('cookie');

        $this->session->unset_userdata('logged');
        $this->session->sess_destroy();

        delete_cookie('autologin',  $this->config->item('domain'));

        redirect(base_url());
    }

    public function registration() {
    	$this->load->helper('string');
    	$this->load->library('email');

	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $settings = $this->settings_model->getValues(array('site_name', 'bot_mail', 'register_text', 'regions'));

	    $data['title'] = lang('register_title');
	    $settings->regions = str_replace("\r\n", "\n", $settings->regions);
	    $data['regions'] = explode("\n", $settings->regions);

	    $this->form_validation->set_rules('mail', lang('email'), 'valid_email|required|trim|is_unique[users.email]');
	    $this->form_validation->set_rules('pass', lang('password'), 'required|trim');

	    $mail         = $this->input->post('mail');
	    $pass         = $this->input->post('pass');
	    $surname      = $this->input->post('surname');
	    $name         = $this->input->post('name');
	    $middle_name  = $this->input->post('middle_name');
	    $region       = $this->input->post('region');
	    $phone        = $this->input->post('phone');
	    $type         = $this->input->post('type');

	    if($region == 'none') {
	    	$region = '';
	    }

	    if($type == 'none') {
	    	$type = '';
	    }

	    if ($this->form_validation->run() === TRUE) {

	    	$user = array(
	    			'email'       => $mail,
	    			'hash'        => $pass,
	    			'surname'     => $surname,
	    			'name'        => $name,
	    			'middle_name' => $middle_name,
	    			'region'      => ($region == 'none') ? '' : $region,
	    			'phone'       => $phone,
	    			'type'        => $type,
	    			'registration' => date ('Y-m-d H:i:s'),
	    			'confirm'     => md5($this->input->post('mail') . ' '.date ('Y-m-d H:i:s') . ' ' . rand(5, 10)),
	    			'url'         => md5($mail.'-'.date ('Y-m-d H:i:s') . ' ' . rand(25, 50))
	    		);

	    	if($this->user_model->addUser($user)) {
	    		$text = str_replace(
	    					array(
	    						'{SURNAME}',
	    						'{NAME}',
		    					'{MIDDLE_NAME}',
		    					'{REGION}',
		    					'{PHONE}',
		    					'{STATUS}',
		    					'{EMAIL}',
		    					'{LINK}',
		    					'{PASSWORD}'
	    					),
	    					array(
	    						$surname,
	    						$name,
	    						$middle_name,
	    						$region,
	    						$phone,
	    						$type,
	    						$mail,
	    						$this->config->item('host_url').'registration/'.$user['confirm'],
	    						$pass
	    					),
	    					$settings->register_text
	    				);

				$this->email->from($settings->bot_mail, $settings->site_name);
				$this->email->to($mail);
				$this->email->subject(lang('register_subject'));
				$this->email->message($text);
				$this->email->send();

				$this->session->set_flashdata('success', lang('confirm_register'));
	    	} else {
	    		$this->session->set_flashdata('error', lang('error_execution'));
	    	}
	    	redirect(base_url());
	    }

	    $data['mail']        = $mail;
		$data['surname']     = $surname;
		$data['name']        = $name;
		$data['middle_name'] = $middle_name;
		$data['region']      = $region;
		$data['phone']       = $phone;
		$data['type']        = $type;

	    $this->template($data);
    }

    public function confirm($hash = null) {
    	if(empty($hash)) {
    		redirect(base_url('registration'));
    	}

	    if($this->user_model->confirmRegistration($hash)) {
			$this->session->set_flashdata('success', lang('confirm_success'));
			redirect(base_url('login'));
	    } else {
	    	$this->session->set_flashdata('error', lang('error_confirm'));
	    	redirect(base_url());
	    }
    }

    public function recovery() {
    	$this->load->helper('string');
    	$this->load->library('email');

	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $data['title'] = lang('recovery_title');

	    $this->form_validation->set_rules('mail', lang('email'), 'valid_email|required|trim|callback_check_mail');

	    $mail = $this->input->post('mail');

	    if ($this->form_validation->run() === TRUE) {
	    	$password = random_string();
	    	$settings = $this->settings_model->getValues(array('site_name', 'bot_mail', 'recovery_text'));

	    	if($this->user_model->changePassword($mail, $password)) {
	    		$user = $this->user_model->getUserData($mail);

	    		$text = str_replace(
	    					array(
	    						'{SURNAME}',
	    						'{NAME}',
		    					'{MIDDLE_NAME}',
		    					'{REGION}',
		    					'{PHONE}',
		    					'{STATUS}',
		    					'{DATE}',
		    					'{PASSWORD}',
		    					'{EMAIL}'
	    					),
	    					array(
	    						$user->surname,
	    						$user->name,
	    						$user->middle_name,
	    						$user->region,
	    						$user->phone,
	    						$user->type,
	    						date('Y-m-d H:i:s', strtotime($user->registration)),
	    						$password,
	    						$mail
	    					),
	    					$settings->recovery_text
	    				);

				$this->email->from($settings->bot_mail, $settings->site_name);
				$this->email->to($mail);
				$this->email->subject(lang('recovery'));
				$this->email->message($text);
				$this->email->send();

				$this->session->set_flashdata('success', lang('recovery_send'));
	    	} else {
	    		$this->session->set_flashdata('error', lang('error_execution'));
	    	}
	    	redirect(base_url());
	    }

	    $data['mail'] = $mail;

	    $this->template($data);
    }

    public function profile() {
    	$this->onlyLoged();
    	$data = array();

	    $data['title'] = lang('profile_title');

    	$user_data = $this->user_model->getUserData($this->user->email, true);
    	$regions = $this->settings_model->getValue('regions');
	    $regions = str_replace("\r\n", "\n", $regions);
	    $data['regions'] = explode("\n", $regions);

    	foreach ($user_data as $key => $value) {
    		if($key == 'hash') {
    			$data['pass'] = 'password';
    		}
    		$data[$key] = $value;
    	}

	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('mail', lang('email'), 'valid_email|required|trim|callback_check_mail_edit');
	    $this->form_validation->set_rules('pass', lang('password'), 'trim');

	    $mail         = $this->input->post('mail');
	   	$pass         = $this->input->post('pass');
	    $surname      = $this->input->post('surname');
	    $name         = $this->input->post('name');
	    $middle_name  = $this->input->post('middle_name');
	    $region       = $this->input->post('region');
	    $phone        = $this->input->post('phone');
	    $type         = $this->input->post('type');

	    if($region == 'none') {
	    	$region = '';
	    }

	    if($type == 'none') {
	    	$type = '';
	    }

	    if ($this->form_validation->run() === TRUE) {
	    	$user = array();

			if($mail != $user_data->email) {
		    	$user['email'] = $mail;
		    	$_text_mail = $mail;
		    } else {
		    	$_text_mail = lang('the_same');
		    }

			if($surname != $user_data->surname) {
		    	$user['surname'] = $surname;
		    	$_text_surname = $surname;
		    } else {
		    	$_text_surname = lang('the_same');
		    }

			if($name != $user_data->name) {
		    	$user['name'] = $name;
		    	$_text_name = $name;
		    } else {
		    	$_text_name = lang('the_same');
		    }

			if($middle_name != $user_data->middle_name) {
		    	$user['middle_name'] = $middle_name;
		    	$_text_middle_name = $middle_name;
		    } else {
		    	$_text_middle_name = lang('the_same');
		    }

			if(!empty($pass) && $pass != 'password') {
		    	$user['hash'] = $pass;
		    }

			if($region != $user_data->region) {
		    	$user['region'] = $region;
		    	$_text_region = $region;
		    } else {
		    	$_text_region = lang('the_same');
		    }

			if($phone != $user_data->phone) {
		    	$user['phone'] = $phone;
		    	$_text_phone = $phone;
		    } else {
		    	$_text_phone = lang('the_same');
		    }

			if($type != $user_data->type && $type != 'none') {
		    	$user['type'] = $type;
		    	$_text_type = $type;
		    } else {
		    	$_text_type = lang('the_same');
		    }

		    $confirm = md5($user_data->email . ' '.date ('Y-m-d H:i:s') . ' ' . rand(7, 15));

	    	if($this->user_model->preEditUser(json_encode($user), $user_data->email, $confirm)) {
				$this->load->library('email');
	    		$settings = $this->settings_model->getValues(array('site_name', 'bot_mail', 'changes_text'));

	    		$text = str_replace(
	    					array(
	    						'{SURNAME}',
	    						'{NAME}',
		    					'{MIDDLE_NAME}',
		    					'{REGION}',
		    					'{PHONE}',
		    					'{STATUS}',
		    					'{DATE}',
		    					'{EMAIL}',
		    					'{NEW_EMAIL}',
	    						'{NEW_SURNAME}',
	    						'{NEW_NAME}',
		    					'{NEW_MIDDLE_NAME}',
		    					'{NEW_REGION}',
		    					'{NEW_PHONE}',
		    					'{NEW_STATUS}',
		    					'{LINK}'
	    					),
	    					array(
	    						$user_data->surname,
	    						$user_data->name,
	    						$user_data->middle_name,
	    						$user_data->region,
	    						$user_data->phone,
	    						$user_data->type,
	    						date('Y-m-d H:i:s'),
	    						$user_data->email,
	    						$_text_mail,
								$_text_surname,
								$_text_name,
								$_text_middle_name,
								$_text_region,
								$_text_phone,
								$_text_type,
								$this->config->item('host_url').'profile/'.$confirm,
	    					),
	    					$settings->changes_text
	    				);

				$this->email->from($settings->bot_mail, $settings->site_name);
				$this->email->to($user_data->email);
				$this->email->subject(lang('changes_confirm'));
				$this->email->message($text);
				$this->email->send();


				$this->session->set_flashdata('success', lang('edit_send_success'));
	    	} elseif(empty($user)) {
	    		$this->session->set_flashdata('error', lang('edit_no_changes'));
	    	} else {
	    		$this->session->set_flashdata('error', lang('error_execution'));
	    	}
	    	redirect(base_url('profile'));
	    }

	    $data['mail']        = $user_data->email;
		$data['surname']     = $user_data->surname;
		$data['name']        = $user_data->name;
		$data['pass']        = 'password';
		$data['middle_name'] = $user_data->middle_name;
		$data['region']      = $user_data->region;
		$data['phone']       = $user_data->phone;
		$data['type']        = $user_data->type;

	    $this->template($data);
    }

    public function profileEdit($hash = null) {
    	$logout = false;
    	if(empty($hash)) {
    		redirect(base_url('login'));
    	}

    	$changes_data = $this->user_model->getProfileChanges($hash);

	    if($changes_data) {
	    	if(!empty($changes_data->changes)) {
	    		$changes =  json_decode($changes_data->changes, true);
	    		$changes = (array) $changes;
	    		$data = array();
	    		if(!empty($changes)) {
	    			foreach ($changes as $key => $value) {
	    				if($key == 'email') {
	    					$unic = $this->check_mail_edit($value, $changes_data->email, $changes_data->id, false);
							if($unic) {
			    				$data['email'] = $value;
						        $logout        = true;
			    			} else {
						        $this->session->set_flashdata('error', lang('mail_in_use'));
			    			}
	    				} elseif($key == 'hash') {
	    					$hash = hash('sha512', $value);
							if($hash != $changes_data->hash) {
			    				$data['hash'] = $hash;
			    				$logout       = true;
			    			}
	    				} else {
	    					$data[$key] = $value;
	    				}

	    			}

	    			$data['confirm'] = null;
	    			$data['changes'] = null;

		    		if($this->user_model->editUser($changes_data->email, $data)) {
		    			if($logout) {
					        $this->session->unset_userdata('logged');
		    				$this->session->set_flashdata('success', lang('changes_saved_relogin'));
		    				redirect(base_url('login'));
		    			} else {
		    				$this->session->set_flashdata('success', lang('changes_saved'));
		    				if($this->user && !empty($this->user)) {
		    					redirect(base_url('profile'));
		    				} else {
		    					redirect(base_url('login'));
		    				}
		    			}
		    		} else {
			    		$this->session->set_flashdata('success', lang('no_changes'));
			    		redirect(base_url());
		    		}

	    		} else {
			    	$this->session->set_flashdata('error', lang('no_changes'));
			    	redirect(base_url());
	    		}
	    	} else {
		    	$this->session->set_flashdata('error', lang('no_changes'));
		    	redirect(base_url());
	    	}
	    } else {
		    $this->session->set_flashdata('error', lang('no_changes'));
		    redirect(base_url());
	    }

    }

    public function check_mail($mail) {
        $exist = $this->user_model->checkMail($mail);

        if (!$exist) {
            return TRUE;
        }

        $this->form_validation->set_message('check_mail', lang('mail_not_exist'));
        return FALSE;
    }


    public function check_mail_edit($mail, $old_mail = null, $id = null, $form = true) {
    	if(empty($old_mail)) {
    		$old_mail = $this->user->email;
    	}

    	if($old_mail != $mail) {
    		if($id) {
    			$exist = $this->user_model->checkMail($mail, $id);
    		} else {
    			$exist = $this->user_model->checkMail($mail);
    		}

	        if ($exist) {
	            return TRUE;
	        } else {
	        	if($form) {
	        		$this->form_validation->set_message('check_mail_edit', lang('mail_in_use'));
	        	}
		        return FALSE;
	        }

    	} else {
    		return TRUE;
    	}
    }
}