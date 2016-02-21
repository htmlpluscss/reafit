<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    private $table;

    public function __construct() {
        parent::__construct();

        $this->table = 'settings';
    }

    public function getAllSettings() {
        $this->db->select('*');
        $this->db->where('show', 1);
        $this->db->order_by('order', 'ASC');
        $query = $this->db->get($this->table);
        return $result = $query->result();
    }

    public function getValue($key) {
        if(!empty($key)) {
            $this->db->select('value');
            $this->db->where('key', $key);
            $query = $this->db->get($this->table, 0, 1);
            $result = $query->row();
            if($result) {
                return $result->value;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getValues($keys = array()) {
        if(!empty($keys)) {
            if(is_array($keys)) {
                $result = new StdClass;
                $this->db->select('key');
                $this->db->select('value');
                $this->db->or_where_in('key', $keys);
                $query = $this->db->get($this->table);
                $results = $query->result();
                foreach ($results as $key => $setting) {
                    $result->{$setting->key} = $setting->value;

                }
                return $result;
            } else {
                $result = $this->getValue($key);
                return $result;
            }
        } else {
            return false;
        }
    }

    public function updateAllSettings($data) {
        if($data) {
            $this->db->update_batch($this->table, $data, 'key');
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
