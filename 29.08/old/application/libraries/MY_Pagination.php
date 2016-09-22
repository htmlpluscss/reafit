<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Overriding CodeIgniter library
 */
class MY_Pagination extends CI_Pagination {

	public function __construct($params = array())
	{
		parent::__construct($params);
	}

	public function render($total_rows, $per_page = 10, $base_url = NULL, $segment = null) {
		$config['base_url'] = $base_url ? $base_url : current_url();
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		if($segment) {
			$config['uri_segment']  = $segment;
		}
		$config['full_tag_open']    = '<ul>';
		$config['full_tag_close']   = '</ul>';
		$config['num_tag_open']     = '<li class="pagin__item">';
		$config['num_tag_close']    = '</li>';
		$config['cur_tag_open']     = '<li class="pagin__active">';
		$config['cur_tag_close']    = '</li>';
		$config['next_tag_open']    = '<li class="pagin__item">';
		$config['next_tagl_close']  = '</li>';
		$config['prev_tag_open']    = '<li class="pagin__item">';
		$config['prev_tagl_close']  = '</li>';
		$config['first_tag_open']   = '<li class="pagin__item">';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open']    = '<li class="pagin__item">';
		$config['last_tagl_close']  = '</li>';
		$config['first_link']       = '&lsaquo;&lsaquo;';
		$config['last_link']        = '&rsaquo;&rsaquo;';
		$config['next_link']        = '&rsaquo;';
		$config['prev_link']        = '&lsaquo;';

		$this->CI =& get_instance();
		$suffix = array();
		$search = $this->CI->input->get('search');
		$items = $this->CI->input->get('items');
		$order = $this->CI->input->get('order');
		$sort = $this->CI->input->get('sort');

		if(!empty($search)) {
			$suffix[] = 'search='.$search;
		}

		if(!empty($items)) {
			$suffix[] = 'items='.$items;
		}

		if(!empty($order)) {
			$suffix[] = 'order='.$order;
		}

		if(!empty($sort)) {
			$suffix[] = 'sort='.$sort;
		}

		if(!empty($suffix)) {
			$config['suffix'] = '?'.implode('&', $suffix);
		} else {
			$config['suffix'] = '';
		}

		$config['first_url']        = $config['base_url'] . $config['suffix'];

		$this->initialize($config);
		return $this->create_links();
	}
}