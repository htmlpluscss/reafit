<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tags_model extends CI_Model {

    private $group_table;
    private $table;

    public function __construct() {
        parent::__construct();

        $this->table = 'tags';
        $this->group_table = 'tags_groups';
    }

    public function getTagsGroups($id = null) {
        if($id) {
            $this->db->select('id AS tags');
            $this->db->where('id', $id);
            $query = $this->db->get($this->group_table, 0, 1);
            $result = $query->row();
            if($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            $query = $this->db->get($this->group_table);
            $result = $query->result();
            if($result) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public function getTagsAll($group = null) {
        $result = array();

        $this->db->select('t.id AS id');
        $this->db->select('t.tag AS tag');
        $this->db->select('g.id AS group_id');
        $this->db->select('g.name AS group');
        $this->db->select('g.colum AS colum');
        $this->db->select('t.parent_id AS subtags');
        $this->db->from($this->group_table . ' AS g');
        $this->db->join($this->table.' t', 't.group_id=g.id', 'left');
        $this->db->where('t.parent_id', null);
        if($group) {
            $this->db->where('g.id', $group);
        }
        $this->db->order_by('g.colum, g.id, t.order','ASC');
        $query = $this->db->get();

        if($query->num_rows() != 0) {
            $_result = $query->result();
            foreach ($_result as $key => $tag) {
                $parents = array();
                $parents = $this->getTag(null, $tag->id);
                $result[$key] = $tag;
                $result[$key]->subtags = $parents;
            }
            return $result;
        } else {
            return false;
        }
    }

    public function getTagsByGroups() {
        $groups = $this->getTagsGroups();
        if(!empty($groups)) {
            foreach ($groups as $key => $group) {
                $groups[$key]->tags = $this->getTagsAll($group->id);
            }
            return $groups;
        } else {
            return false;
        }
    }

    public function getTag($id = null, $parent_id = null) {
        if($id && empty($parent_id)) {
            $this->db->where('id', $id);
            $query = $this->db->get($this->table, 0, 1);
            $result = $query->row();
            if($result) {
                return $result;
            } else {
                return false;
            }
        } elseif($parent_id && empty($id)) {
            $this->db->where('parent_id', $parent_id);
            $query = $this->db->get($this->table);
            $result = $query->result();
            if($result) {
                return $result;
            } else {
                return false;
            }
        } elseif(!empty($parent_id) && !empty($id)) {
            $this->db->where('id', $id);
            $this->db->where('parent_id', $parent_id);
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

    public function addTags($data) {
        if($data) {
            $this->db->insert_batch($this->table, $data);
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateTags($data) {
        if($data) {
            $this->db->update_batch($this->table, $data, 'id');
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteTags($data) {
        if($data) {
            foreach ($data as $key => $value) {
                $this->db->delete($this->table, $value);
            }
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
