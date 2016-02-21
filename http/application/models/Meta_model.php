<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Meta_model extends CI_Model {

    private $table;
    private $programs_table;
    private $users_table;

    public function __construct() {
        parent::__construct();

        $this->table = 'meta';
        $this->programs_table = 'programs';
        $this->users_table = 'users';

    }

    public function getMeta($key) {
        if(!empty($key)) {
            $this->db->select(array('title', 'description', 'keywords'));
            $this->db->where('key', $key);
            $query = $this->db->get($this->table, 0, 1);
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

    public function getMetaByHash($hash, $full = false, $deleted = false) {
        if($hash) {
            if($full) {
                $this->db->select('*');
            } else {
                $this->db->select('id');
            }
            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $type = preg_match('#^[0-9a-f]{32}$#', $hash);
            if($type) {
                $this->db->where('hash', $hash);
            } else {
                $this->db->where('id', $hash);
            }

            $query = $this->db->get($this->table);
            $result = $query->row();
            if($result) {
                if($full) {
                    return $result;
                } else {
                    return (int) $result->id;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getMetaList($per_page = null, $page = 0, $params = array(), $count = false, $author = false, $deleted = false) {
        $this->db->select('e.*');
        $this->db->select('p.name');

        $this->db->join($this->programs_table.' AS p', 'method = p.hash', 'left');

        if($author) {
            $this->db->select('u.surname AS user_surname');
            $this->db->select('u.name AS user_name');
            $this->db->select('u.middle_name AS user_middle_name');
            $this->db->select('u.url AS user_url');
            $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');
        }

        if(!empty($params)) {
            $first = true;
            $user_search = array('surname', 'name', 'middle_name');
            $keys = array('description', 'title', 'keywords');
            $this->db->group_start();
            foreach ($params as $key => $param) {
                if(in_array($key, $keys)) {
                    if($first) {
                        $this->db->like('e.'.$key, mb_strtolower($param));
                        $first = false;
                    } else {
                        $this->db->or_like('e.'.$key, mb_strtolower($param));
                    }
                }
                if($author) {
                    if(in_array($key, $user_search)) {
                        if($first) {
                            $this->db->like('u.'.$key, mb_strtolower($param));
                            $first = false;
                        } else {
                            $this->db->or_like('u.'.$key, mb_strtolower($param));
                        }
                    }
                }
            }
            $this->db->group_end();
        }

        $this->db->group_by('e.id');
        $this->db->order_by('id', 'DESC');

        if($count) {
            $this->db->from($this->table.' AS e');
            return $this->db->count_all_results();
        } else {
            if($per_page) {
                $results = $this->db->get($this->table.' AS e', $per_page, $page)->result();
            } else {
                $results = $this->db->get($this->table.' AS e')->result();
            }

            if($results) {
                return $results;
            } else {
                return false;
            }
        }
    }

    public function saveMeta($data, $id = null) {
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

    public function deleteMeta($id) {
        if($id) {
            $this->db->where('id', $id);
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


    public function getPrograms($count = false, $deleted = false) {
        $this->db->select('e.*');
        if(!$deleted) {
            $this->db->where('e.deleted', 0);
        }

        $this->db->select('u.surname AS user_surname');
        $this->db->select('u.name AS user_name');
        $this->db->select('u.middle_name AS user_middle_name');
        $this->db->select('u.url AS user_url');
        $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');

        $this->db->group_by('e.id');
        $this->db->order_by('e.id', 'DESC');

        if($count) {
            $this->db->from($this->programs_table.' AS e');
            return $this->db->count_all_results();
        } else {
            $results = $this->db->get($this->programs_table.' AS e')->result();

            if($results) {
                return $results;
            } else {
                return false;
            }
        }
    }
}
