<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

    private $table;
    private $users_table;
    private $exercises_table;
    private $programs_table;

    public function __construct() {
        parent::__construct();

        $this->table = 'categories';
        $this->users_table = 'users';
        $this->exercises_table = 'exercises';
        $this->programs_table = 'programs';
    }

    public function getCategoryByUser($user_id, $deleted = false) {
        if($user_id) {
            $this->db->select('*');
            $this->db->where('user_id', (int) $user_id);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $query = $this->db->get($this->table);
            $result = $query->result();
            if($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getCategoryByID($id, $deleted = false) {
        if($id) {
            $this->db->select('*');
            $this->db->where('id', (int) $id);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $query = $this->db->get($this->table);
            $result = $query->row();
            if($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getCategoryByTitle($title, $user_id, $deleted = false) {
        if($title && $user_id) {
            $this->db->select('*');
            $this->db->where('name', $title);
            $this->db->where('user_id', (int) $user_id);
            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $query = $this->db->get($this->table);
            $result = $query->row();
            if($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function saveCategory($data, $id = null) {
        if($data) {
            if(!$id) {
                $result = $this->db->insert($this->table, $data);
                if($result) {
                    return $this->db->insert_id();
                } else {
                    return false;
                }
            } else {
                $this->db->where('id', $id);
                $result = $this->db->update($this->table, $data);
                if($result) {
                    return $id;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function findCategories($user, $params = array(), $exclude = false, $deleted = false) {
        if($user) {
            $this->db->select('*');
            $this->db->from($this->table);
            if(!$deleted) {
                $this->db->where('deleted', 0);
            }
            $this->db->where('user_id', (int) $user);

            $this->db->order_by('id', 'DESC');
            if(!empty($params)) {
                $first = true;
                $keys = array('name', 'description');
                foreach ($params as $key => $param) {
                    if(in_array($key, $keys)) {
                        if($first) {
                            $this->db->like($key, mb_strtolower($param));
                            $first = false;
                        } else {
                            $this->db->or_like($key, mb_strtolower($param));
                        }
                    }
                }
            }

            if(!empty($exclude)) {
                $this->db->where('id !=', $exclude);
            }

            $results = $this->db->get()->result();
            if($results) {
                return $results;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getCategoriesListTotal($user_id, $title = null, $params = array(), $deleted = false) {
        if($user_id) {
            $this->db->where('user_id', $user_id);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            if(!empty($params)) {
                $first = true;
                $keys = array('name', 'description');
                $this->db->group_start();
                foreach ($params as $key => $param) {
                    if(in_array($key, $keys)) {
                        if($first) {
                            $this->db->like($key, mb_strtolower($param));
                            $first = false;
                        } else {
                            $this->db->or_like($key, mb_strtolower($param));
                        }
                    }
                }
                $this->db->group_end();
            }
            $this->db->from($this->table);
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

    public function getCategoriesList($user, $per_page = null, $page = 0, $params = array(), $order = array(), $count = false, $deleted = false) {
        if($user->id) {
            $this->db->select('*');

            if(!empty($user->id)) {
                $this->db->where('user_id', $user->id);
            }

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            if(!empty($params)) {
                $first = true;
                $keys = array('name', 'description');
                $this->db->group_start();
                foreach ($params as $key => $param) {
                    if(in_array($key, $keys)) {
                        if($first) {
                            $this->db->like($key, mb_strtolower($param));
                            $first = false;
                        } else {
                            $this->db->or_like($key, mb_strtolower($param));
                        }
                    }
                }
                $this->db->group_end();
            }

            if(empty($order)) {
                $this->db->order_by('id', 'DESC');
            } else {
                foreach ($order as $key => $value) {
                    $this->db->order_by($key, $value);
                }
            }

            if($count) {
                $this->db->from($this->table);
                return $this->db->count_all_results();
            } else {
                if($per_page) {
                    $results = $this->db->get($this->table, $per_page, $page)->result();
                } else {
                    $results = $this->db->get($this->table)->result();
                }

                if($results) {
                    return $results;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function setDeleted($id, $user) {
        if($id && $user) {
            $user_id = (int) $user->id;
            $this->db->set('deleted', 1);
            $this->db->where('id', $id);
            $this->db->where('user_id', $user_id);
            $this->db->update($this->table);
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteCategory($id, $user) {
        if($id && $user) {
            $user_id = (int) $user->id;
            $this->db->where('id', $id);
            $this->db->where('user_id', $user_id);
            $this->db->delete($this->table);
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getProgramsByCategoryTotal($user_id, $title = null, $deleted = false) {
        if($user_id) {
            $this->db->where('user_id', $user_id);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            if(!empty($title)) {
                $this->db->where('category', $title);
            }

            $this->db->from($this->programs_table);
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

    public function getExercisesByCategoryTotal($user_id, $title = null, $deleted = false) {
        if($user_id) {
            $this->db->where('user_id', $user_id);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            if(!empty($title)) {
                $this->db->where('category', $title);
            }

            $this->db->from($this->exercises_table);
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

}