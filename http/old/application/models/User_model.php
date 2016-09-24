<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table;
    private $exercises_table;
    private $programs_table;

    public function __construct() {
        parent::__construct();

        $this->table = 'users';
        $this->exercises_table = 'exercises';
        $this->programs_table = 'programs';
    }

    public function login($email = NULL, $password = NULL) {
        if(!empty($email) && !empty($password)) {
            $hash = hash('sha512', $password);
            $this->db->select(array('id', 'email', 'name', 'surname', 'is_admin', 'params'));
            $this->db->where('email', $email);
            $this->db->where('hash', $hash);
            $this->db->where('status', 1);
            $query = $this->db->get($this->table, 0, 1);
            $result = $query->row();
            if($result) {
                $this->loginTime($result);
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function autoLogin($hash = NULL) {
        if(!empty($hash)) {
            $this->db->select(array('id', 'email', 'name', 'surname', 'is_admin', 'params'));
            $this->db->where('autologin', $hash);
            $this->db->where('status', 1);
            $query = $this->db->get($this->table, 0, 1);
            $result = $query->row();
            if($result) {
                $this->loginTime($result);
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setAutoLogin($mail, $hash) {
        if($mail) {
            $data = array(
                        'autologin' => $hash,
                    );
            $this->db->where('email', $mail);
            $this->db->where('status', 1);
            if($this->db->update($this->table, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function unsetAutoLogin($mail) {
        if($mail) {
            $data = array(
                        'autologin' => null,
                    );
            $this->db->where('email', $mail);
            $this->db->where('status', 1);
            if($this->db->update($this->table, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function loginTime($user = null) {
        if($user) {
            $data = array(
                        'last_login' => date('Y-m-d H:i:s'),
                    );
            $this->db->where('email', $user->email);
            if($this->db->update($this->table, $data)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function getUserData($mail, $edit = false) {
        if($mail) {

            $this->db->select('email');
            $this->db->select('surname');
            $this->db->select('name');
            $this->db->select('middle_name');
            $this->db->select('region');
            $this->db->select('phone');
            $this->db->select('type');
            $this->db->select('registration');
            $this->db->select('confirm');
            $this->db->select('params');

            if($edit) {
                $this->db->select('hash');
            }

            $this->db->where('email', $mail);
            $this->db->where('status', 1);
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

    public function addUser($data) {
        if($data) {
            $data['hash'] = hash('sha512', $data['hash']);
            if($this->db->insert($this->table, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function preEditUser($new_data, $mail, $confirm) {
        if($mail && $new_data && $confirm) {
            $data = array(
                        'confirm' => $confirm,
                        'changes' => $new_data
                    );
            $this->db->where('email', $mail);
            $this->db->where('status', 1);
            if($this->db->update($this->table, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function changePassword($mail, $password = '') {
        if($mail) {
            $data = array(
                        'hash' => hash('sha512', $password),
                    );
            $this->db->where('email', $mail);
            $this->db->where('status', 1);
            if($this->db->update($this->table, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function confirmRegistration($hash) {
        if($hash) {
            $data = array(
                        'status' => 1,
                        'confirm' => ''
                    );
            $this->db->where('confirm', $hash);
            $this->db->where('status', 0);
            $this->db->update($this->table, $data);
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editUser($mail, $data) {
        if($mail && $data) {
            $this->db->where('email', $mail);
            $this->db->where('status', 1);
            $this->db->update($this->table, $data);
            if($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editUserMail($mail, $new_mail) {
        if($mail && $new_mail) {
            $this->db->set('email', $new_mail);
            $this->db->where('email', $mail);
            if($this->db->update($this->table)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function emptyUserChanges($mail) {
        if($mail) {
            $data = array(
                    'confirm' => '',
                    'changes' => ''
                );
            $this->db->where('email', $mail);
            $this->db->where('status', 1);
            if($this->db->update($this->table, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getProfileChanges($hash) {
        if($hash) {
            $this->db->where('confirm', $hash);
            $this->db->where('status', 1);
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

    public function checkMail($mail, $id = null) {
        if(!empty($mail)) {
            $this->db->select('email');
            $this->db->where('email', $mail);
            if($id) {
                $this->db->where('id !=', $id);
            }
            $this->db->from($this->table);
            $result = $this->db->count_all_results();
            if($result === 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getAdminId() {
        $this->db->select('id');
        $this->db->where('is_admin', 1);
        $this->db->or_where('is_admin', 2);
        $query = $this->db->get($this->table);
        $result = $query->result();
        if($result) {
            $_result = array();
            foreach ($result as $key => $user) {
               $_result[] = $user->id;
            }
            return $_result;
        } else {
            return false;
        }
    }

    public function getAdmins() {
        $this->db->select('email');
        $this->db->where('is_admin', 1);
        $this->db->or_where('is_admin', 2);
        $query = $this->db->get($this->table);
        $result = $query->result();
        if($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getUserList($per_page = null, $page = 0, $params = array(), $count = false) {
        $this->db->select('*');
        $this->db->select('id AS programs');
        $this->db->select('id AS exercises');

        $users = $this->getAdminId();
        if(!empty($users)) {
            $this->db->where_not_in('id', $users);
        }

        $this->db->order_by('id', 'DESC');
        if(!empty($params)) {
            $first = true;
            $keys = array('name', 'surname', 'middle_name', 'region', 'phone', 'type');
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

        $this->db->group_by('id');

        if($count) {
            $this->db->from($this->table.' AS e');
            return $this->db->count_all_results();
        } else {
            if($per_page) {
                $results = $this->db->get($this->table, $per_page, $page)->result();
            } else {
                $results = $this->db->get($this->table)->result();
            }

            if($results) {
                foreach ($results as $key => $result) {
                    $results[$key]->programs  = $this->getTotalByUser($result->id, 'programs');
                    $results[$key]->exercises = $this->getTotalByUser($result->id);
                }
                return $results;
            } else {
                return false;
            }
        }
    }

    public function getTotalUsers($id = false) {
        if($id) {
            $this->db->from($this->table);
            if(is_array($id)) {
                $this->db->where_not_in('id', $id);
            } else {
                $this->db->where('id !=', (int) $id);
            }
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

    public function getTotalByUser($id, $type = 'exercises', $deleted = false) {
        if($id) {
            $this->db->from($this->{$type.'_table'});
            if(is_array($id)) {
                $this->db->where_in('user_id', $id);
            } else {
                $this->db->where('user_id', (int) $id);
            }
            if(!$deleted) {
                $this->db->where('deleted', 0);
            }
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

    public function getTotalByUserNot($id, $type = 'exercises', $deleted = false) {
        if($id) {
            $this->db->from($this->{$type.'_table'});
            if(is_array($id)) {
                $this->db->where_not_in('user_id', $id);
            } else {
                $this->db->where('user_id !=', (int) $id);
            }
            if(!$deleted) {
                $this->db->where('deleted', 0);
            }
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

    public function getUserByUrl($url, $full = false) {
        if($url) {
            if($full) {
                $this->db->select('*');
                $this->db->select('id AS programs');
                $this->db->select('id AS exercises');
            } else {
                $this->db->select('id');
            }
            $this->db->where('url', $url);
            $query = $this->db->get($this->table);
            $result = $query->row();
            if($result) {
                if($full) {
                    $result->programs  = $this->getTotalByUser($result->id, 'programs');
                    $result->exercises = $this->getTotalByUser($result->id);
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

    public function getLastUsers($per_page = null, $page = 0, $order = array(), $count = false) {
        $this->db->select('*');
        $this->db->select('id AS programs');
        $this->db->select('id AS exercises');

        $users = $this->getAdminId();
        if(!empty($users)) {
            $this->db->where_not_in('id', $users);
        }

        if(!empty($order)) {
            foreach ($order as $key => $value) {
                $this->db->order_by($key, $value);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $this->db->group_by('id');

        if($count) {
            $this->db->from($this->table.' AS e');
            return $this->db->count_all_results();
        } else {
            if($per_page) {
                $results = $this->db->get($this->table, $per_page, $page)->result();
            } else {
                $results = $this->db->get($this->table)->result();
            }

            return $results;
        }
    }

}