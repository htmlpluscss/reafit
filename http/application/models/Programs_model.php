<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Programs_model extends CI_Model {

    private $table;
    private $tabs_table;
    private $exercise_table;
    private $exercise_links_table;
    private $favorite_table;
    private $users_table;
    private $tag_table;
    private $tags_links_table;

    public function __construct() {
        parent::__construct();

        $this->table = 'programs';
        $this->tabs_table = 'programs_tabs';
        $this->exercise_table = 'exercises';
        $this->exercise_links_table = 'programs_exercises';
        $this->favorite_table = 'users_favorites_programs';
        $this->users_table = 'users';
        $this->tag_table = 'tags';
        $this->tags_links_table = 'exercises_tags';

        $this->load->model('exercises_model');
    }

    public function getProgramByHash($hash, $full = false, $deleted = false) {
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

    public function getTabByHash($hash, $full = false) {
        if($hash) {
            if($full) {
                $this->db->select('*');
            } else {
                $this->db->select('id');
            }

            $type = preg_match('#^[0-9a-f]{32}$#', $hash);
            if($type) {
                $this->db->where('hash', $hash);
            } else {
                $this->db->where('id', $hash);
            }

            $query = $this->db->get($this->tabs_table);
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

    public function getPrograms($id, $deleted = false, $deleted_exercises = false) {
        if($id) {
            if(is_array($id)) {
                $this->db->select('a.*');
                $this->db->select('a.id AS tabs');
                $this->db->select('u.is_admin AS is_admin');
                if(!$deleted) {
                    $this->db->where('a.deleted', 0);
                }
                $type = preg_match('#^[0-9a-f]{32}$#', $id[0]);
                if($type) {
                    $this->db->where_in('a.hash', $id);
                } else {
                    $this->db->where_in('a.id', $id);
                }
                $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');
                $query = $this->db->get($this->table.' AS a');
                $results = $query->result();
                if($results) {
                    foreach ($results as $key => $program) {
                        $results[$key]->tabs  = $this->getTabs($program->id);
                    }
                    return $results;
                } else {
                    return false;
                }
            } else {
                $this->db->select('a.*');
                $this->db->select('a.id AS tabs');
                $this->db->select('u.is_admin AS is_admin');

                $type = preg_match('#^[0-9a-f]{32}$#', $id);
                if($type) {
                    $this->db->where('a.hash', $id);
                } else {
                    $this->db->where('a.id', $id);
                }
                if(!$deleted) {
                    $this->db->where('a.deleted', 0);
                }
                $this->db->join($this->users_table.' AS u', 'a.user_id = u.id', 'left');
                $query = $this->db->get($this->table.' AS a', 0, 1);
                $result = $query->row();
                if($result) {
                    $result->tabs  = $this->getTabs($result->id, false, $deleted_exercises);
                    return $result;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function saveProgram($data, $id = null) {
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

    public function getTab($id, $check = false) {
        if($id) {
            $type = preg_match('#^[0-9a-f]{32}$#', $id);
            if($type) {
                $this->db->where('hash', $id);
            } else {
                $this->db->where('id', $id);
            }

            if($check) {
                $query = $this->db->get($this->tabs_table);
                $result = $query->row();
                if($result) {
                    return (int) $result->id;
                } else {
                    return false;
                }
            } else {
                $this->db->select('*');
                $this->db->select('id AS exercises');
                $query = $this->db->get($this->tabs_table);
                $result = $query->row();
                $this->db->reset_query();

                if($result) {
                    $this->db->where('program_id', $result->program_id);
                    $this->db->where('tab_id', $result->id);
                    $query = $this->db->get($this->exercise_links_table);
                    $results = $query->result();
                    if($results) {
                        $result->exercises = $results;
                    } else {
                        $result->exercises = false;
                    }
                    return $result;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }

    }

    public function setTabs($program_id, $user_id, $data) {
        if($program_id && $user_id && $data) {
            $tab_list = $this->getTabsArray($program_id);

            foreach ($data as $key => $tab_data) {
                $type = preg_match('#^[0-9a-f]{32}$#', $key);
                if($type) {
                    if(is_array($tab_list) && in_array($key, $tab_list)) {
                        $tab_id = $this->getTab($key, true);
                        if(!empty($tab_id) && isset($tab_data['data']) && !empty($tab_data['data'])) {
                            $this->setTabData($program_id, $tab_id, $tab_data['data']);
                        }
                        if(($_key = array_search($key, $tab_list)) !== false) {
                            unset($tab_list[$_key]);
                        }
                    } else {
                        if(isset($tab_data['name']) && !empty($tab_data['name'])) {
                            $tab_id = 0;
                            $insert_data = array(
                                    'tab_name'   => $tab_data['name'],
                                    'program_id' => (int) $program_id,
                                    'hash'       => md5($tab_data['name'] . ' ' . $program_id . ' ' . date ('Y-m-d H:i:s') . ' ' . rand(7, 15)),
                                );
                            $result = $this->db->insert($this->tabs_table, $insert_data);
                            if($result) {
                                $tab_id = $this->db->insert_id();
                                if(!empty($tab_id) && isset($tab_data['data']) && !empty($tab_data['data'])) {
                                    $this->setTabData($program_id, $tab_id, $tab_data['data']);
                                }
                            }
                        }
                    }
                } else {
                    if(isset($tab_data['name']) && !empty($tab_data['name'])) {
                        $tab_id = 0;
                        $insert_data = array(
                                'tab_name'   => $tab_data['name'],
                                'program_id' => (int) $program_id,
                                'hash'       => md5($tab_data['name'] . ' ' . $program_id . ' ' . date ('Y-m-d H:i:s') . ' ' . rand(7, 15)),
                            );
                        $result = $this->db->insert($this->tabs_table, $insert_data);
                        if($result) {
                            $tab_id = $this->db->insert_id();
                            if(!empty($tab_id) && isset($tab_data['data']) && !empty($tab_data['data'])) {
                                $this->setTabData($program_id, $tab_id, $tab_data['data']);
                            }
                        }
                    }
                }
            }

            if(isset($tab_list) && !empty($tab_list)) {
                foreach ($tab_list as $key => $tab) {
                    $this->db->where('hash', $tab);
                    $this->db->delete($this->tabs_table);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function getTabsArray($program_id) {
        if($program_id) {
            $results = array();
            $this->db->select('hash');
            $this->db->where('program_id', (int) $program_id);
            $query = $this->db->get($this->tabs_table);
            $result = $query->result();
            if($result) {
                foreach ($result as $key => $value) {
                    $results[] = $value->hash;
                }
                return $results;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getTabs($program_id, $users = false, $deleted_exercises = false) {
        if($program_id) {
            $results = array();
            $this->db->select('id');
            $this->db->select('hash');
            $this->db->select('tab_name AS name');
            $this->db->select('id AS exercises');
            $this->db->where('program_id', (int) $program_id);
            $query = $this->db->get($this->tabs_table);
            $result = $query->result();
            if($result) {

                foreach ($result as $key => $value) {
                    $result[$key]->exercises = $this->getTabExercises($program_id, $value->id, $users, $deleted_exercises);
                }
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getTabExercisesArray($program_id, $tab_id) {
        if($program_id && $tab_id) {
            $results = array();
            $this->db->select('exercise_id');
            $this->db->where('program_id', (int) $program_id);
            $this->db->where('tab_id', (int) $tab_id);
            $query = $this->db->get($this->exercise_links_table);
            $result = $query->result();
            if($result) {
                $results = array();
                foreach ($result as $key => $value) {
                    $results[] = $value->exercise_id;
                }
                return $results;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getTabExercises($program_id, $tab_id, $users = false, $deleted_exercises = false) {
        if($program_id && $tab_id) {
            $results = array();
            $this->db->select('*');
            $this->db->where('program_id', (int) $program_id);
            $this->db->where('tab_id', (int) $tab_id);
            $this->db->order_by('order', 'ASC');
            $query = $this->db->get($this->exercise_links_table);
            $result = $query->result();
            if($result) {
                $results = array();
                foreach ($result as $key => $value) {
                    $additional = array(
                            'relation_id' => $value->id,
                            'quantity'    => $value->quantity,
                            'approaches'  => $value->approaches,
                            'weight'      => $value->weight,
                            'comment'     => $value->comment
                        );
                    if($users) {
                        $results[] = $this->exercises_model->getExercises($value->exercise_id, $users, $deleted_exercises, $additional);
                    } else {
                        $results[] = $this->exercises_model->getExercises($value->exercise_id, false, $deleted_exercises, $additional);
                    }
                }
                return $results;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setTabData($program_id, $tab_id, $data) {
        if($program_id && $tab_id && $data) {
            $insert_data = array();
            $update_data = array();
            $delete_data = array();

            $order = 0;
            $exclude_relation_id = array();

            $all_data = $this->getTabExercisesArray($program_id, $tab_id);

            foreach ($data as $key => $hash) {
                if(!is_array($hash)){
                    $exercise_id = $this->exercises_model->getExerciseByHash($hash);
                    $__exclude_id = $this->getProgramsExercisesRelationID($program_id, $exercise_id, $tab_id, $exclude_relation_id);
                    if($__exclude_id) {
                        $__exclude_id = reset($__exclude_id);
                        $__exclude_id = (int) $__exclude_id->id;
                    } else {
                        $__exclude_id = false;
                    }
                    
                    if(is_array($all_data) && in_array($exercise_id, $all_data) && $exercise_id && $__exclude_id) {
                        $order++;
                        if($__exclude_id) {
                            $update_data[] = array(
                                'id'          => $__exclude_id,
                                'program_id'  => (int) $program_id,
                                'tab_id'      => (int) $tab_id,
                                'exercise_id' => (int) $exercise_id,
                                'order'       => $order,
                                'quantity'    => (int) $data['quantity'][$key],
                                'approaches'  => (int) $data['approaches'][$key],
                                'weight'      => (float) $data['weight'][$key],
                                'comment'     => $data['comment'][$key]
                            );
                            $exclude_relation_id[] = $__exclude_id;
                        } else {
                            $update_data[] = array(
                                'program_id'  => (int) $program_id,
                                'tab_id'      => (int) $tab_id,
                                'exercise_id' => (int) $exercise_id,
                                'order'       => $order,
                                'quantity'    => (int) $data['quantity'][$key],
                                'approaches'  => (int) $data['approaches'][$key],
                                'weight'      => (float) $data['weight'][$key],
                                'comment'     => $data['comment'][$key]
                            );
                        }
                        
                        if(($_key = array_search($exercise_id, $all_data)) !== false) {
                            unset($all_data[$_key]);
                        }
                    } else {
                        if($exercise_id) {
                            $order++;
                            $insert_data[] = array(
                                    'program_id'  => (int) $program_id,
                                    'tab_id'      => (int) $tab_id,
                                    'exercise_id' => (int) $exercise_id,
                                    'order'       => $order,
                                    'quantity'    => (int) $data['quantity'][$key],
                                    'approaches'  => (int) $data['approaches'][$key],
                                    'weight'      => (float) $data['weight'][$key],
                                    'comment'     => $data['comment'][$key]
                                );
                        }
                    }
                }
            }

            if(!empty($all_data)) {
                foreach ($all_data as $key => $exercise_id) {
                    $this->db->reset_query();
                    if($exercise_id) {
                        $this->db->where('program_id', (int) $program_id);
                        $this->db->where('tab_id', (int) $tab_id);
                        $this->db->where('exercise_id', (int) $exercise_id);
                        if(!empty($exclude_relation_id)) {
                            $this->db->where_not_in('id', $exclude_relation_id);
                        }
                        $this->db->delete($this->exercise_links_table);
                    }
                }
            }
            if(!empty($update_data)) {
                foreach ($update_data as $key => $value) {
                    $this->db->set('order', (int) $value['order']);
                    $this->db->set('quantity', $value['quantity']);
                    $this->db->set('approaches', $value['approaches']);
                    $this->db->set('weight', $value['weight']);
                    $this->db->set('comment', $value['comment']);
                    if(isset($value['id']) && !empty($value['id'])) {
                        $this->db->where('id', $value['id']);
                    } else {
                        $this->db->where(
                            array(
                                'program_id' => $value['program_id'],
                                'tab_id' => $value['tab_id'],
                                'exercise_id' => $value['exercise_id']
                            )
                        );
                    }
                    $this->db->update($this->exercise_links_table);
                }
            }
            if(!empty($insert_data)) {
                $result = $this->db->insert_batch($this->exercise_links_table, $insert_data);
                if($result) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findPrograms($users, $user = null, $params = array(), $tags = array(), $exclude = null, $deleted = false, $exclude_category = false) {
        //if($users) {
            $this->db->select('e.*');
            $this->db->select('e.id AS id');
            $this->db->select('e.id AS tabs');
            $this->db->select('u.is_admin AS is_admin');
            $this->db->from($this->table.' AS e');
            if(!$deleted) {
                $this->db->where('e.deleted', 0);
            }
            if(!empty($users)) {
                $this->db->where_in('e.user_id', $users);
                $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');
            }
            if(!empty($user)) {
                $this->db->select('f.user_id AS favorite');
                $this->db->join($this->favorite_table.' AS f', 'f.program_id = e.id AND f.user_id = '.(int)$user, 'left');
                $this->db->order_by('favorite', 'DESC');
            }
            $this->db->order_by('e.user_id', 'DESC');
            if(!empty($exclude_category)) {
                if(is_array($exclude_category)) {
                    if(!empty($exclude_category)) {
                        $this->db->group_start();
                        $this->db->or_where_in('e.category', $exclude_category);
                        //$this->db->or_where('e.category IS ', 'NULL', false);
                        $this->db->group_end();
                    }
                } else {
                    $this->db->group_start();
                    $this->db->or_where('e.category', $exclude_category);
                    //$this->db->or_where('e.category IS ', 'NULL', false);
                    $this->db->group_end();
                }
            }
            if(!empty($params)) {
                $first = true;
                $keys = array('name', 'description', 'hash');
                foreach ($params as $key => $param) {
                    if(in_array($key, $keys)) {
                        if($first) {
                            $this->db->like('e.'.$key, mb_strtolower($param));
                            $first = false;
                        } else {
                            $this->db->or_like('e.'.$key, mb_strtolower($param));
                        }
                    }
                }
            }
            if(!empty($tags)) {
                $this->db->join($this->exercise_links_table.' AS ex', 'ex.program_id = e.id');
                $this->db->join($this->tags_links_table.' AS r', 'r.exercise_id = ex.exercise_id');
                foreach ($tags as $key => $tag) {
                    $this->db->where('r.tag_id', $tag);
                }
            }
            if(!empty($exclude)) {
                $this->db->where('e.id !=', $exclude);
            }

            $this->db->group_by('e.id');

            $results = $this->db->get()->result();

            if($results) {
                foreach ($results as $key => $result) {
                   $results[$key]->tabs  = $this->getTabs($result->id, $users);
                }
                return $results;
            } else {
                return false;
            }
        /*} else {
            return false;
        }*/
    }

    public function getLastNum($user, $deleted = false) {
        if($user) {
            $this->db->where('user_id', (int) $user);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $this->db->from($this->table);
            $result = $this->db->count_all_results();
            return $result;
        } else {
            return false;
        }
    }

    public function changeOrder($order, $id, $user, $deleted = false, $update = false) {
        if($order && $user && $id) {
            $this->db->where('user_id', (int) $user);
            $this->db->where('id !=', (int) $id);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $this->db->group_start();
            $this->db->where('order <', (int) $order);
            $this->db->or_where('order =', (int) $order);
            $this->db->group_end();

            $this->db->order_by('order', 'ASC');

            $query = $this->db->get($this->table);
            $results = $query->result();

            if($results) {
                foreach ($results as $key => $item) {
                    $this->db->reset_query();
                    $this->db->set('order', (int) $key + 1);
                    $this->db->where('id', $item->id);
                    $this->db->update($this->table);
                }
            }
            $this->db->reset_query();

            $this->db->where('user_id', (int) $user);
            $this->db->where('id !=', (int) $id);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $this->db->group_start();
            $this->db->where('order =', (int) $order);
            $this->db->or_where('order >', (int) $order);
            $this->db->group_end();

            $this->db->order_by('order', 'ASC');

            $query = $this->db->get($this->table);
            $results = $query->result();

            if($results) {
                foreach ($results as $key => $item) {
                    $this->db->reset_query();
                    $this->db->set('order', (int) $order + $key + 1);
                    $this->db->where('id', $item->id);
                    $this->db->update($this->table);
                }
            }

            if($update) {
                $results = $query->result();
                $this->db->set('order', (int) $order);
                $this->db->where('id', $id);
                $this->db->update($this->table);
            }
            return true;
        } else {
            return false;
        }
    }

    public function changeOrderDeleted($user, $deleted = false) {
        if($user) {
            $this->db->where('user_id', (int) $user);

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $this->db->order_by('order', 'ASC');

            $query = $this->db->get($this->table);
            $results = $query->result();

            if($results) {
                foreach ($results as $key => $item) {
                    $this->db->set('order', (int) $key + 1);
                    $this->db->where('id', $item->id);
                    $this->db->update($this->table);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function changeOrderAll($user) {
        if($user) {
            $this->db->where('user_id', (int) $user);
            $query = $this->db->get($this->table);
            $results = $query->result();
            if($results) {
                foreach ($results as $key => $item) {
                    $this->db->set('order', $key++);
                    $this->db->where('id', $item->id);
                    $this->db->update($this->table);
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getProgramsListTotal($user_id, $deleted = false, $params = array(), $category = false, $exclude_category = false) {
        if($user_id) {
            $this->db->where('user_id', $user_id);
            if(!$deleted) {
                $this->db->where('deleted', 0);
            }
            if(!empty($params)) {
                $first = true;
                $keys = array('name', 'description', 'hash');
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

            if(!empty($category)) {
                $this->db->where('category', $category);
            }

            if(!empty($exclude_category)) {
                if(is_array($exclude_category)) {
                    if(!empty($exclude_category)) {
                        $this->db->group_start();
                        $this->db->or_where_in('category', $exclude_category);
                        //$this->db->or_where('category IS ', 'NULL', false);
                        $this->db->group_end();
                    }
                } else {
                    $this->db->group_start();
                    $this->db->or_where('category', $exclude_category);
                    //$this->db->or_where('category IS ', 'NULL', false);
                    $this->db->group_end();
                }
            }

            $this->db->from($this->table);
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

    public function getProgramsListTotalAll($user_id, $deleted = false) {
        if($user_id) {
            $this->db->where('user_id !=', $user_id);
            if(!$deleted) {
                $this->db->where('deleted', 0);
            }
            $this->db->from($this->table);
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

    public function getProgramsList($user, $per_page = null, $page = 0, $deleted = false, $params = array(), $order = false, $category = false, $exclude_category = false) {
        if($user->id) {
            $this->db->select('a.*');
            $this->db->select('f.id AS favorite');
            $this->db->select('u.is_admin');

            $this->db->where('a.user_id', $user->id);

            if(!$deleted) {
                $this->db->where('a.deleted', 0);
            }

            $this->db->join($this->favorite_table.' AS f', 'f.program_id = a.id', 'left');
            $this->db->join($this->users_table.' AS u', 'u.id = a.user_id', 'left');

            if(empty($order)) {
                $this->db->order_by('favorite', 'DESC');
                $this->db->order_by('a.order', 'ASC');
            } else {
                foreach ($order as $key => $value) {
                    $this->db->order_by($key, $value);
                }
            }

            if(!empty($category)) {
                $this->db->where('a.category', $category);
            }

            if(!empty($exclude_category)) {
                if(is_array($exclude_category)) {
                    if(!empty($exclude_category)) {
                        $this->db->group_start();
                        $this->db->or_where_in('a.category', $exclude_category);
                        //$this->db->or_where('a.category IS ', 'NULL', false);
                        $this->db->group_end();
                    }
                } else {
                    $this->db->group_start();
                    $this->db->or_where('a.category', $exclude_category);
                    //$this->db->or_where('a.category IS ', 'NULL', false);
                    $this->db->group_end();
                }
            }

            if(!empty($params)) {
                $first = true;
                $keys = array('name', 'description', 'hash');
                $this->db->group_start();
                foreach ($params as $key => $param) {
                    if(in_array($key, $keys)) {
                        if($first) {
                            $this->db->like('a.' . $key, mb_strtolower($param));
                            $first = false;
                        } else {
                            $this->db->or_like('a.' . $key, mb_strtolower($param));
                        }
                    }
                }
                $this->db->group_end();
            }

            if($per_page) {
                $query = $this->db->get($this->table.' AS a', $per_page, $page);
            } else {
                $query = $this->db->get($this->table.' AS a');
            }

            $results = $query->result();

            if($results) {
                return $results;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getProgramsListAdmin($user = false, $per_page = null, $page = 0, $params = array(), $count = false, $author = false, $deleted = false, $order = false, $category = false) {
        $this->db->select('e.*');
        $this->db->select('u.is_admin AS is_admin');
        if(!$deleted) {
            $this->db->where('e.deleted', 0);
        }
        $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');
        if(!empty($user)) {
            if(is_array($user)) {
                $this->db->where_not_in('u.id', $user);
                //$this->db->where('u.is_admin !=', 0);
            } else {
                //$this->db->where('u.id', (int) $user);
                $this->db->where('u.is_admin !=', 0);
            }
        } else {
            $this->db->where('u.is_admin', 0);
        }
        if($author) {
            $this->db->select('u.surname AS user_surname');
            $this->db->select('u.name AS user_name');
            $this->db->select('u.middle_name AS user_middle_name');
            $this->db->select('u.email AS user_mail');
            $this->db->select('u.url AS user_url');
        }

        if(empty($order)) {
            $this->db->order_by('e.user_id', 'DESC');
        } else {
            foreach ($order as $key => $value) {
                $this->db->order_by('e.'.$key, $value);
            }
        }

        if(!empty($category)) {
            $this->db->where('e.category', $category);
        }

        if(!empty($params)) {
            $first = true;
            $user_search = array('surname', 'name', 'middle_name', 'email');
            $keys = array('name', 'description', 'hash');
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
        $this->db->order_by('e.order', 'ASC');

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

    public function getProgramsLast($user = false, $per_page = null, $page = 0, $order = array(), $count = false, $author = false, $deleted = false, $category = false, $exclude_category = false) {
        $this->db->select('e.*');
        $this->db->select('u.is_admin AS is_admin');
        if(!$deleted) {
            $this->db->where('e.deleted', 0);
        }
        $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');
        if(!empty($user)) {
            if(is_array($user)) {
                $this->db->where_not_in('u.id', $user);
            } else {
                $this->db->where('u.id', (int) $user);
            }
        } else {
            $this->db->where('u.is_admin', 0);
        }
        if($author) {
            $this->db->select('u.surname AS user_surname');
            $this->db->select('u.name AS user_name');
            $this->db->select('u.middle_name AS user_middle_name');
            $this->db->select('u.url AS user_url');
        }
        $this->db->order_by('e.user_id', 'DESC');

        $this->db->group_by('e.id');

        if(!empty($category)) {
            $this->db->where('e.category', $category);
        }

        if(!empty($exclude_category)) {
            if(is_array($exclude_category)) {
                if(!empty($exclude_category)) {
                    $this->db->group_start();
                    $this->db->or_where_in('e.category', $exclude_category);
                    //$this->db->or_where('e.category IS ', 'NULL', false);
                    $this->db->group_end();
                }
            } else {
                $this->db->group_start();
                $this->db->or_where('e.category', $exclude_category);
                //$this->db->or_where('e.category IS ', 'NULL', false);
                $this->db->group_end();
            }
        }

        if(empty($order)) {
            $this->db->order_by('e.id', 'DESC');
        } else {
            foreach ($order as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

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

    public function setDeleted($id, $user) {
        if($id && $user) {
            $user_id = (int) $user->id;
            $this->db->set('deleted', 1);
            $this->db->where('id', $id);
            $this->db->update($this->table);
            if($this->db->affected_rows() > 0) {
                $total = $this->getLastNum($user_id);
                $this->changeOrderDeleted($user_id);
                $this->unsetProgramData($id);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteProgram($id, $user) {
        if($id && $user) {
            $user_id = (int) $user->id;
            $this->db->where('id', $id);
            $this->db->delete($this->table);
            if($this->db->affected_rows() > 0) {
                $total = $this->getLastNum($user_id);
                $this->changeOrderDeleted($user_id);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function addFavorite($user, $hash) {
        if($hash && $user) {
            $id = $this->getProgramByHash($hash);
            if($id) {
                $this->db->from($this->favorite_table);
                $this->db->where('program_id', $id);
                $this->db->where('user_id', (int) $user);
                $exist = $this->db->count_all_results();
                if($exist == 0) {
                    $data = array(
                            'user_id'     => (int) $user,
                            'program_id' => $id
                        );
                    if($this->db->insert($this->favorite_table, $data)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function removeFavorite($user, $hash) {
        if($hash && $user) {
            $id = $this->getProgramByHash($hash);
            if($id) {
                $this->db->where('program_id', $id);
                $this->db->where('user_id', (int) $user);
                $this->db->delete($this->favorite_table);
                if($this->db->affected_rows() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setExerciseData($where, $data) {
        if($where && $data) {
            if(is_array($where)) {
                $this->db->where($where);
            } else {
                return false;
            }

            if($this->db->update($this->exercise_links_table, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function unsetProgramData($id) {
        if($id) {

            $this->db->or_where('program_id', $id);
            $this->db->delete($this->favorite_table);
            $this->db->reset_query();

            return true;
        } else {
            return false;
        }
    }

    public function getProgramsExercisesRelationID($program_id, $exercise_id, $tab_id, $exclude_id = array()) {

        $this->db->where(array(
                'program_id' => $program_id,
                'exercise_id' => $exercise_id,
                'tab_id' => $tab_id
            )
        );
        if(is_array($exclude_id) && !empty($exclude_id)) {
            $this->db->where_not_in('id', $exclude_id);
        }
        return $this->db->get($this->exercise_links_table)->result();
    }
}