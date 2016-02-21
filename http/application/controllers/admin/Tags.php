<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('tags_model');

        $this->lang->load('backend');

        $this->onlyAdmin();
    }

	public function index() {
		$data = array();

		$this->load->helper('form');
	    $this->load->library('form_validation');

		$data['title'] = lang('search_tags_title');

		$all_tags = $this->tags_model->getTagsAll();
		$goups = $this->input->post('tag');

		if(!empty($goups)) {
			$old_tags = array();

			foreach ($all_tags as $key => $old_tag) {
				$old_tags[$old_tag->group_id][] = (int) $old_tag->id;
			}

			$insert = array();
			$delete = array();
			$update = array();

			foreach ($goups as $key => $tags) {
				foreach ($tags as $_key => $tag) {
					if(is_array($tag)) {
						if(isset($tag['new']) &&!empty($tag['new'])) {
							$insert[] = array(
								'group_id' => $key,
								'tag'      => $tag['new'],
								'order'    => $_key + 1
							);
							unset($goups[$key][$_key]);
						}
					}
				}
				foreach ($old_tags[$key] as $_key => $_old_tag) {
					if(!in_array($_old_tag, $goups[$key])) {
						$delete[] = array(
								'id' => (int) $_old_tag
							);
					} else {
						$order = array_search($_old_tag, $goups[$key]);
						$update[] = array(
								'id'    => (int) $_old_tag,
								'order' => $order + 1
							);
					}
				}
			}

			if(!empty($insert)) {
				$this->tags_model->addTags($insert);
			}

			if(!empty($update)) {
				$this->tags_model->updateTags($update);
			}

			if(!empty($delete)) {
				$this->tags_model->deleteTags($delete);
			}

		}

		$data['tags']  = $this->tags_model->getTagsByGroups();

		$this->addStyle('admin.css');
		$this->template($data, 'backend');
	}


}