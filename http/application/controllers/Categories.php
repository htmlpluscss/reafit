<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('settings_model');
        $this->load->model('categories_model');
        $this->load->model('tags_model');

        $this->lang->load('frontend');
    }

	public function index($page = 0) {
		$this->onlyLoged();
		if($this->user->is_admin) {
			redirect(base_url('admin/programs'));
		}

		$this->load->library('pagination');

		$data['title'] = lang('program_list_title');

        $search = $this->input->get('search');
        $search = trim($search);

        $data['search'] = $search;

        if(!empty($search)) {
            $search_array = array(
                    'name'        => $search,
                    'description' => $search
                );
        } else {
            $search_array = array();
        }

        $sort_array = $this->getSort();

        if(!empty($sort_array)) {
            $sort = $this->input->get('sort');
            $data['sort'] = trim($sort);

            $order = $this->input->get('order');
            $data['order'] = trim($order);
        }

		$total = $this->categories_model->getCategoriesListTotal($this->user->id, $search_array);
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

		$data['pagination'] = $this->pagination->render($total, $per_page, base_url('categories'), 2);

        $items = $this->categories_model->getCategoriesList($this->user, $per_page, $page, $search_array, $sort_array);

        if(!empty($items)) {
            foreach ($items as $key => $item) {
                $items[$key]->programs = $this->getProgramsCount($item->name);
                $items[$key]->exercises = $this->getExercisesCount($item->name);
            }
        }

		$data['items']  = $items;
		$data['action'] = base_url('categories');

		$this->template($data);
	}

    public function add() {
        $data =  array();
        $this->onlyLoged();
        if($this->user->is_admin) {
            redirect(base_url('admin/settings'));
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', lang('name'), 'required|trim');
        $this->form_validation->set_rules('description', lang('description'), 'trim');

        $name          = $this->input->post('name');
        $description   = $this->input->post('description');

        if ($this->form_validation->run() === TRUE) {

            $insert = array(
                    'name'        => $name,
                    'description' => $description,
                    'user_id'     => $this->user->id,
                    'created'     => date('Y-m-d H:i:s'),
                );

            $result = $this->categories_model->saveCategory($insert);

            if($result) {
                $this->session->set_flashdata('success', lang('saved'));
            } else {
                $this->session->set_flashdata('error', lang('error_execution'));
            }
        }

        redirect(base_url('categories'));
    }

    public function edit($id) {
        $data =  array();
        $this->onlyLoged();
        if($this->user->is_admin) {
            redirect(base_url('admin/settings'));
        }

        $old_data = $this->categories_model->getCategoryByID($id);
        if(!$old_data) {
            show_404();
        }

        if($old_data->user_id != $this->user->id) {
            $this->session->set_flashdata('error', lang('error_not_have_right_p'));
            redirect(base_url('categories'));
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $exercise_user = $old_data->user_id;

        $this->form_validation->set_rules('name', lang('name'), 'required|trim');
        $this->form_validation->set_rules('description', lang('description'), 'trim');

        if ($this->form_validation->run() === TRUE) {
            $name          = $this->input->post('name');
            $description   = $this->input->post('description');

            $insert = array(
                    'edited'      => date ('Y-m-d H:i:s'),
                    'name'        => $name,
                    'description' => $description
                );

            $result = $this->categories_model->saveCategory($insert, $old_data->id);

            if($result) {
                $this->session->set_flashdata('success', lang('saved'));
            } else {
                $this->session->set_flashdata('error', lang('error_execution'));
            }

            redirect(base_url('categories'));
        }

        $data['name']              = $old_data->name;
        $data['description']       = $old_data->description;

        $this->ajaxResponse($data, false, 'frontend', true);
        return true;
    }

    public function delete($id) {
    	if(!$id) {
    		$this->session->set_flashdata('error', lang('error_execution'));
			redirect(base_url('categories'));
    	}

    	$this->onlyLoged();

    	$category = $this->categories_model->getCategoryByID($id);

    	if(!$category) {
    		$this->session->set_flashdata('error', lang('error_execution'));
			redirect(base_url('categories'));
    	}

    	if($this->user->id != $category->user_id && !$this->user->is_admin) {
    		$this->session->set_flashdata('error', lang('error_not_have_right'));
    	} else {
    		$result = $this->categories_model->deleteCategory($category->id, $this->user);
    		if($result) {
    			$this->session->set_flashdata('success', lang('category_deleted'));
    		} else {
    			$this->session->set_flashdata('error', lang('error_execution'));
    		}
    	}
        redirect(base_url('categories'));
    }

    private function getSort() {
        $sort = $this->input->get('sort');
        $sort = trim($sort);

        $order = $this->input->get('order');
        $order = trim($order);

        $sorts  = array('asc', 'desc');
        $orders = array('name', 'created', 'edited');

        $result = array();
        if(!empty($order) && !empty($sort)) {
            if(in_array($order, $orders) && in_array($sort, $sorts)) {
                $result[$order] = mb_strtoupper($sort);
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    private function getProgramsCount($ctegory) {
        if(!isset($this->user->id)) {
            return false;
        }

        $result = $this->categories_model->getProgramsByCategoryTotal($this->user->id, $ctegory);

        return $result;
    }

    private function getExercisesCount($ctegory) {
        if(!isset($this->user->id)) {
            return false;
        }

        $result = $this->categories_model->getExercisesByCategoryTotal($this->user->id, $ctegory);

        return $result;
    }
}