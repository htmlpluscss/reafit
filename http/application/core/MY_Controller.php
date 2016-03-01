<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $user;

    public $popup;

    public $settings;

    public $messages;

    public $layout;
    public $views = array();
    public $scripts = array();
    public $styles = array();

    public $per_page = array();

    private $script_path;
    private $style_path;


    public function __construct() {
        parent::__construct();
        $this->script_path = base_url().'assets/js/';
        $this->style_path = base_url().'assets/css/';

        $this->load->model('settings_model');
        $this->messages = $this->session->flashdata();
        $this->popup = null;

        $this->settings = $this->settings_model->getValues(array('site_name', 'forum_url', 'image_width', 'image_height', 'per_page', 'tinypng_key'));

        $this->autoLogin();

        $this->per_page = array(5, 10, 30, 100, 500, 1000, 'all');
    }


    public function template($data = array(), $layout = 'frontend', $inc_views = null, $inc_views_private = null ) {
        $this->layout = $layout;

        $this->views = array('_head', '_header', $this->router->class.'/'.$this->router->method, '_footer');

        array_unique($this->scripts);
        array_filter($this->scripts);

        if(!empty($this->scripts)) {
            $data['scripts'] = $this->scripts;
        }

        array_unique($this->styles);
        array_filter($this->styles);

        if(!empty($this->styles)) {
            $data['styles'] = $this->styles;
        }

        if(!empty($this->messages)) {
            foreach ($this->messages as $key => $value) {
                $data[$key] = $value;
            }
        }

        $meta = $this->getMeta();
        if($meta) {
            $data['title'] = (!empty($meta->title)) ? $meta->title : '';
            $data['description'] = $meta->description;
            $data['keywords'] = $meta->keywords;
        } else {
            $data['title'] = (isset($data['title'])) ? $data['title'] : $this->settings->site_name;
            $data['description'] = '';
            $data['keywords'] = '';
        }

        if(!empty($inc_views)) {
            if(is_array($inc_views)) {
                foreach ($inc_views as $key => $value) {
                    $data[$value] = $this->load->view($this->layout.'/'.$value, $data, TRUE);
                }
            } else {
                $data[$inc_views] = $this->load->view($this->layout.'/'.$inc_views, $data, TRUE);
            }
        }

        if(!empty($inc_views_private)) {
            if(is_array($inc_views_private)) {
                foreach ($inc_views_private as $key => $value) {
                    $data[$value] = $this->load->view($this->layout.'/'.$this->router->class.'/'.$value, $data, TRUE);
                }
            } else {
                $data[$inc_views_private] = $this->load->view($this->layout.'/'.$this->router->class.'/'.$inc_views_private, $data, TRUE);
            }
        }

        if(!empty($this->views)) {
            foreach ($this->views as $key => $view) {
                if(!empty($this->layout)) {
                    $this->load->view($this->layout.'/'.$view, $data);
                } else {
                    $this->load->view($view, $data);
                }
            }
        }

    }

    public function template_error($data = array(), $layout = 'frontend', $inc_views = null, $inc_views_private = null ) {
        $this->layout = $layout;

        $this->views = array('_head', '_header', 'site/error', '_footer');

        array_unique($this->scripts);
        array_filter($this->scripts);

        if(!empty($this->scripts)) {
            $data['scripts'] = $this->scripts;
        }

        array_unique($this->styles);
        array_filter($this->styles);

        if(!empty($this->styles)) {
            $data['styles'] = $this->styles;
        }

        if(!empty($this->messages)) {
            foreach ($this->messages as $key => $value) {
                $data[$key] = $value;
            }
        }

        $meta = $this->getMeta();
        if($meta) {
            $data['title'] = (!empty($meta->title)) ? $meta->title : '';
            $data['description'] = $meta->description;
            $data['keywords'] = $meta->keywords;
        } else {
            $data['title'] = (isset($data['title'])) ? $data['title'] : $this->settings->site_name;
            $data['description'] = '';
            $data['keywords'] = '';
        }

        if(!empty($inc_views)) {
            if(is_array($inc_views)) {
                foreach ($inc_views as $key => $value) {
                    $data[$value] = $this->load->view($this->layout.'/'.$value, $data, TRUE);
                }
            } else {
                $data[$inc_views] = $this->load->view($this->layout.'/'.$inc_views, $data, TRUE);
            }
        }

        if(!empty($inc_views_private)) {
            if(is_array($inc_views_private)) {
                foreach ($inc_views_private as $key => $value) {
                    $data[$value] = $this->load->view($this->layout.'/site/'.$value, $data, TRUE);
                }
            } else {
                $data[$inc_views_private] = $this->load->view($this->layout.'/site/'.$inc_views_private, $data, TRUE);
            }
        }

        if(!empty($this->views)) {
            foreach ($this->views as $key => $view) {
                if(!empty($this->layout)) {
                    $this->load->view($this->layout.'/'.$view, $data);
                } else {
                    $this->load->view($view, $data);
                }
            }
        }
    }

    public function ajaxResponse($data = array(), $error = false, $layout = 'frontend') {
        $result = array();

        $this->layout = $layout;

        $this->views = $this->router->class.'/'.$this->router->method;

        header('Content-Type: application/json');
        if($error) {
            header("HTTP/1.1 400 Bad Request");
            $result['error'] = 1;
            $result['data'] = $error;
        } else {
            header("HTTP/1.1 200 OK");
            $result['success'] = 1;
            if(is_array($data)) {
                $result['data'] = $this->load->view($data, TRUE);
            } else {
                $result['data'] = $data;
            }
        }

        $this->load->view($this->layout.'/_ajax', array('result'=>json_encode($result)));

        return true;
    }

    public function showPopUp($popup, $data = array(), $layout = 'frontend', $inc_views = null, $inc_views_private = null ) {

        $this->views = array('_head', '_header', $this->router->class.'/'.$this->router->method, '_footer');

        if(!empty($inc_views)) {
            if(is_array($inc_views)) {
                foreach ($inc_views as $key => $value) {
                    $data[$value] = $this->load->view($layout.'/'.$value, $data, TRUE);
                }
            } else {
                $data[$inc_views] = $this->load->view($layout.'/'.$inc_views, $data, TRUE);
            }
        }

        if(!empty($inc_views_private)) {
            if(is_array($inc_views_private)) {
                foreach ($inc_views_private as $key => $value) {
                    $data[$value] = $this->load->view($layout.'/'.$this->router->class.'/'.$value, $data, TRUE);
                }
            } else {
                $data[$inc_views_private] = $this->load->view($layout.'/'.$this->router->class.'/'.$inc_views_private, $data, TRUE);
            }
        }

        $popup = $this->load->view($layout.'/_popup_'.$popup, $data, TRUE);

        $this->session->set_flashdata('popup', $popup);

    }

    public function addScript($script)
    {
        if(!is_array($script)) {
            if(!empty($script)) {
                $this->scripts[] = $this->script_path . $script;
            }
        } else {
            if(!empty($script)) {
                foreach ($script as $key => $_script) {
                    $this->scripts[] = $this->script_path . $_script;
                }
            }
        }
    }

    public function addStyle($style)
    {
        if(!is_array($style)) {
            if(!empty($style)) {
                $this->styles[] = $this->style_path . $style;
            }
        } else {
            array_filter($style);
            if(!empty($style)) {
                foreach ($style as $key => $_style) {
                    $this->styles[] = $this->style_path . $_style;
                }
            }
        }
    }

    public function ifLogin() {
        if($this->user) {
            redirect(base_url());
        }
    }

    public function onlyLoged() {
        if(!$this->user || empty($this->user)) {
            $this->session->set_flashdata('error', lang('error_login_required'));
            redirect(base_url('login'));
        } else {
            return true;
        }
    }

    public function onlyAdmin() {
        if(!$this->user || empty($this->user)) {
            $this->session->set_flashdata('error', lang('error_login_required'));
            redirect(base_url('login'));
        } elseif(!isset($this->user->is_admin) || empty($this->user->is_admin)) {
            $this->session->set_flashdata('error', lang('error_admin_required'));
            redirect(base_url());
        } else {
            return true;
        }
    }

    private function getMeta() {
        $this->load->model('meta_model');

        $keys = array('programs/printProgram/', 'programs/viewProgram/');

        $key_array = array(
                $this->router->fetch_class(),
                $this->router->fetch_method(),
                $this->router->fetch_directory()
            );

        array_filter($key_array);

        $key = implode('/', $key_array);

        if(in_array($key, $keys)) {
            $suffix = '';
            if($key == 'programs/printProgram/' || $key == 'programs/viewProgram/') {
                $suffix = $this->uri->segment(2);
            }
            $hash = preg_match('#^[0-9a-f]{32}$#', $suffix);
            if($hash) {
                $key = $key.$suffix;
            }
        }

        $data = $this->meta_model->getMeta($key);

        if($data) {
            return $data;
        } else {
            return FALSE;
        }
    }

    private function autoLogin() {
        $this->load->helper('cookie');
        $this->load->model('user_model');

        $autologin = get_cookie('autologin');
        $this->user = $this->session->userdata('logged');

        if (empty($this->user) && !empty($autologin)) {
            $login = $this->user_model->autoLogin($autologin);

            if($login) {
                $this->session->set_userdata('logged', $login);
                $this->user = $login;
            } else {
                delete_cookie('autologin',  $this->config->item('domain'));
            }
        }
    }

    public function canEdit($page_user, $redirect = null) {
        if(!$this->user->is_admin) {
            if($page_user != $this->user->id) {
                $this->session->set_flashdata('error', lang('error_not_have_right'));
                redirect($redirect);
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
}