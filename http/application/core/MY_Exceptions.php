<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    /**
     * 404 Error Handler
     *
     * @uses    CI_Exceptions::show_error()
     *
     * @param   string  $page       Page URI
     * @param   bool    $log_error  Whether to log the error
     * @return  void
     */
    public function show_404($page = '', $log_error = TRUE)
    {
        if (is_cli())
        {
            $heading = 'Not Found';
            $message = 'The controller/method pair you requested was not found.';
        }
        else
        {
            $heading = lang('404_title');
            $message = lang('404_text');
        }

        // By default we log this, but allow a dev to skip it
        if ($log_error)
        {
            log_message('error', $heading.': '.$page);
        }


        $CI = &get_instance();

        $CI->output->set_status_header('404'); 
        $settings = $CI->settings_model->getValues(array('home_title', 'home_header', 'home_video', 'home_text', 'home_end_text'));

        $data['title']   = lang('404_title');
        $data['header']   = lang('404_title');
        $data['text']     = lang('404_text');

        $CI->load->helper('URL');

        $views = array('_head', '_header', 'site/error', '_footer');
        foreach ($views as $key => $view) {
            echo $CI->load->view('frontend/'.$view, $data, TRUE);
        }

        exit(4); // EXIT_UNKNOWN_FILE
    }

}