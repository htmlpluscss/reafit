<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Exercises_model extends CI_Model {

    private $table;
    private $tag_table;
    private $tag_group_table;
    private $tags_links_table;
    private $related_links_table;
    private $progress_links_table;
    private $programs_exercises_table;
    private $favorite_table;
    private $users_table;

    public function __construct() {
        parent::__construct();

        $this->table = 'exercises';
        $this->tag_table = 'tags';
        $this->tag_group_table = 'tags_groups';
        $this->tags_links_table = 'exercises_tags';
        $this->related_links_table = 'exercises_related';
        $this->progress_links_table = 'exercises_progress';
        $this->favorite_table = 'users_favorites';
        $this->users_table = 'users';
        $this->programs_exercises_table = 'programs_exercises';
    }

    public function getExerciseByHash($hash, $full = false, $deleted = false) {
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

    public function getExercises($id, $users = false, $deleted = false, $add = array()) {
        if($id) {
            if(is_array($id)) {
                $this->db->select('a.*');
                $this->db->select('a.id AS id');
                $this->db->select('a.id AS related');
                $this->db->select('a.id AS progress');
                $this->db->select('a.id AS tags');
                if(!empty($add)) {
                    foreach ($add as $key => $value) {
                        $this->db->select('a.id AS '.$key);
                    }
                }
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
                if($users) {
                    if (is_array($users)) {
                        $this->db->where_in('a.user_id', $users);
                    } else {
                        $this->db->where('a.user_id', $users);
                    }
                }
                $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');
                $query = $this->db->get($this->table.' AS a');
                $results = $query->result();
                if($results) {
                    foreach ($results as $key => $result) {
                       $results[$key]->related  = $this->getRelations($result->id, 'related', false, true, $users);
                       $results[$key]->progress = $this->getRelations($result->id, 'progress', false, true, $users);
                       $results[$key]->tags     = $this->getFilters($result->id);
                       if(!empty($add)) {
                            foreach ($add as $_key => $value) {
                                $results[$key]->{$_key} = $value;
                            }
                        }
                    }
                    return $results;
                } else {
                    return false;
                }
            } else {
                $this->db->select('a.*');
                $this->db->select('a.id AS id');
                $this->db->select('a.id AS related');
                $this->db->select('a.id AS progress');
                $this->db->select('a.id AS tags');
                $this->db->select('u.is_admin AS is_admin');
                if(!empty($add)) {
                    foreach ($add as $key => $value) {
                        $this->db->select('a.id AS '.$key);
                    }
                }
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
                    $result->related  = $this->getRelations($result->id, 'related', true);
                    $result->progress = $this->getRelations($result->id, 'progress', true);
                    $result->tags     = $this->getFilters($result->id);
                    if(!empty($add)) {
                        foreach ($add as $_key => $value) {
                            $result->{$_key} = $value;
                        }
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

    public function saveExercise($data, $id = null) {
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

    public function setFilters($exercise_id, $data) {
        if($exercise_id && $data) {
            $data = array_unique($data);
            $data = array_filter($data);
            $this->db->where('exercise_id', $exercise_id);
            $query = $this->db->get($this->tags_links_table);

            if($query->num_rows() != 0) {
                $_exist = array();
                $_result = $query->result();
                foreach ($_result as $key => $tag) {
                    if(!in_array($tag->tag_id, $data)) {
                        $this->db->where('id', $tag->id);
                        $this->db->delete($this->tags_links_table);
                    } else {
                        $_exist[] = $tag->tag_id;
                    }
                }
                $insert_data = array();
                foreach ($data as $key => $tag) {
                   if(!in_array($tag, $_exist)) {
                        $insert_data[] = array(
                            'exercise_id' => $exercise_id,
                            'tag_id'      => (int) $tag,
                        );
                   }
                }
                if(!empty($insert_data)) {
                    $result = $this->db->insert_batch($this->tags_links_table, $insert_data);
                    if($result) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }

            } else {
                $insert_data = array();
                foreach ($data as $key => $tag) {
                   $insert_data[] = array(
                        'exercise_id' => (int) $exercise_id,
                        'tag_id'      => (int) $tag,
                    );
                }
                if(!empty($insert_data)) {
                    $result = $this->db->insert_batch($this->tags_links_table, $insert_data);
                    if($result) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } elseif(!$data && $exercise_id) {
            $this->db->where('exercise_id', (int) $exercise_id);
            $this->db->delete($this->tags_links_table);
        } else {
            return false;
        }
    }

    public function setRelations($exercise_id, $data, $type = 'related') {
        if($exercise_id && $data) {
            //$data = array_unique($data);
            $data = array_filter($data);

            $this->db->where('exercise_id', $exercise_id);
            $query = $this->db->get($this->{$type . '_links_table'});

            foreach ($data as $key => $item) {
                if($item == 'current') {
                    $real_key = $this->getExerciseByHash($exercise_id);
                } else {
                    $real_key = $this->getExerciseByHash($item);
                }

                if(!empty($real_key)) {
                    $data[$key] = $real_key;
                } else {
                    unset($data[$key]);
                }
            }

            $order_data = $data;

            if($query->num_rows() != 0) {
                $_exist = array();
                $_result = $query->result();
                foreach ($_result as $key => $related) {
                    if(!in_array($related->{$type.'_id'}, $data)) {
                        $this->db->where('id', $related->id);
                        $this->db->delete($this->{$type . '_links_table'});
                    } else {
                        $_exist[] = $related->{$type.'_id'};
                    }
                }
                $insert_data = array();
                foreach ($data as $key => $related) {
                   if(!in_array($related, $_exist)) {
                        $insert_data[] = array(
                            'exercise_id' => $exercise_id,
                            $type.'_id'   => (int) $related,
                            'order'       => (int) $key + 1
                        );
                   }
                }

                if(!empty($insert_data)) {
                    $result = $this->db->insert_batch($this->{$type . '_links_table'}, $insert_data);
                    if($result) {
                        $this->setRelationsOrder($exercise_id, $order_data, $type);
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    $this->setRelationsOrder($exercise_id, $order_data, $type);
                    return false;
                }

            } else {
                $insert_data = array();
                foreach ($data as $key => $related) {
                   $insert_data[] = array(
                        'exercise_id' => (int) $exercise_id,
                        $type.'_id'   => (int) $related,
                        'order'       => (int) $key + 1
                    );
                }
                if(!empty($insert_data)) {
                    $result = $this->db->insert_batch($this->{$type . '_links_table'}, $insert_data);
                    if($result) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } elseif(!$data && $exercise_id) {
            $this->db->where('exercise_id', (int) $exercise_id);
            $this->db->delete($this->{$type . '_links_table'});
        } else {
            return false;
        }
    }

    public function getRelations($id, $type = 'related', $sub = false, $users = false, $deleted = false) {
        if($id) {
            $this->db->select('a.*');
            $this->db->select('a.id AS id');
            $this->db->select('a.id AS related');
            $this->db->select('a.id AS progress');
            $this->db->select('a.id AS tags');
            $this->db->select('u.is_admin AS is_admin');
            $this->db->from($this->{$type . '_links_table'}.' AS b');
            $this->db->where('b.exercise_id', $id);
            if(!$deleted) {
                $this->db->where('a.deleted', 0);
            }
            if($users) {
                if (is_array($users)) {
                    $this->db->where_in('a.user_id', $users);
                } else {
                    $this->db->where('a.user_id', $users);
                }
            }
            $this->db->join($this->table.' AS a', 'b.' . $type .'_id = a.id', 'left');
            $this->db->join($this->users_table.' AS u', 'a.user_id = u.id', 'left');
            $this->db->order_by('b.order', 'ASC');
            $results = $this->db->get()->result();
            if($results) {
                if($sub) {
                    foreach ($results as $key => $result) {
                        $results[$key]->related  = $this->getRelations($result->id, 'related', false, $users, $deleted);
                        $results[$key]->progress = $this->getRelations($result->id, 'progress', false, $users, $deleted);
                        $results[$key]->tags     = $this->getFilters($result->id);
                    }
                } else {
                    foreach ($results as $key => $result) {
                        $results[$key]->related  = false;
                        $results[$key]->progress = false;
                        $results[$key]->tags     = false;
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

    public function getFilters($id) {
        if($id) {
            $this->db->select('tag_id');
            $this->db->where('exercise_id', $id);
            $this->db->from($this->tags_links_table);
            $results = $this->db->get()->result();
            if($results) {
                $_results = array();
                foreach ($results as $key => $result) {
                    $_results[] = $result->tag_id;
                }
                return $_results;

            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findExercises($users, $user = null, $params = array(), $tags = array(), $exclude = null, $deleted = false) {
        if($users) {
            $this->db->select('e.*');
            $this->db->select('e.id AS id');
            $this->db->select('e.id AS related');
            $this->db->select('e.id AS progress');
            $this->db->select('e.id AS tags');
            $this->db->select('u.is_admin AS is_admin');
            $this->db->from($this->table.' AS e');
            if(!$deleted) {
                $this->db->where('e.deleted', 0);
            }
            $this->db->where_in('e.user_id', $users);
            $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');
            if(!empty($user)) {
                $this->db->select('f.user_id AS favorite');
                $this->db->join($this->favorite_table.' AS f', 'f.exercise_id = e.id AND f.user_id = '.(int)$user, 'left');
                $this->db->order_by('favorite', 'DESC');
            }
            $this->db->order_by('e.user_id', 'DESC');
            if(!empty($params)) {
                $first = true;
                $keys = array('name', 'name_desc', 'description');
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
                $this->db->join($this->tags_links_table.' AS r', 'r.exercise_id = e.id');
                /* ----------- OR CASE ---------------
                    $this->db->where_in('r.tag_id', $tags);
                   -----------------------------------*/
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
                    $results[$key]->related  = $this->getRelations($result->id, 'related', false, $users);
                    $results[$key]->progress = $this->getRelations($result->id, 'progress', false, $users);
                    $results[$key]->tags     = $this->getFilters($result->id);
                }
                return $results;
            } else {
                return false;
            }
        } else {
            return false;
        }
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

    public function setRelationsOrder($id, $data, $type = 'related') {
        if($data && $id) {
            $this->db->where('exercise_id', (int) $id);

            $query = $this->db->get($this->{$type . '_links_table'});
            $results = $query->result();
            if($results) {
                foreach ($data as $key => $item) {
                    $this->db->set('order', $key + 1);
                    $this->db->where('exercise_id', $id);
                    $this->db->where($type.'_id', $item);
                    $this->db->update($this->{$type . '_links_table'});
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getExercisesListTotal($user_id, $deleted = false) {
        if($user_id) {
            $this->db->where('user_id', $user_id);
            if(!$deleted) {
                $this->db->where('deleted', 0);
            }
            $this->db->from($this->table);
            return $this->db->count_all_results();
        } else {
            return false;
        }
    }

    public function getExercisesListTotalAll($user_id, $deleted = false) {
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

    public function getExercisesList($user, $per_page = null, $page = 0, $deleted = false) {
        if($user->id) {
            $this->db->select('*');
            $this->db->select('id AS tags');

            if(empty($user->is_admin)) {
                $this->db->where('user_id', $user->id);
            }

            if(!$deleted) {
                $this->db->where('deleted', 0);
            }

            $this->db->order_by('order', 'ASC');

            if($per_page) {
                $query = $this->db->get($this->table, $per_page, $page);
            } else {
                $query = $this->db->get($this->table);
            }

            $results = $query->result();

            $this->db->reset_query();

            if($results) {
                foreach ($results as $key => $item) {
                    $this->db->reset_query();

                    $this->db->select('t.*');
                    $this->db->from($this->tags_links_table.' AS a');
                    $this->db->where('a.exercise_id', (int) $item->id);
                    $this->db->join($this->tag_table.' AS t', 't.id = a.tag_id', 'left');

                    $tags = $this->db->get()->result();
                    if(!empty($tags)) {
                        $results[$key]->tags = $tags;
                    } else {
                        $results[$key]->tags = false;
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

    public function getExercisesListAdmin($user = false, $per_page = null, $page = 0, $params = array(), $count = false, $author = false, $deleted = false) {
        $this->db->select('e.*');
        $this->db->select('e.id AS related');
        $this->db->select('e.id AS progress');
        $this->db->select('e.id AS tags');
        $this->db->select('u.is_admin AS is_admin');
        if(!$deleted) {
            $this->db->where('e.deleted', 0);
        }
        $this->db->join($this->users_table.' AS u', 'user_id = u.id', 'left');
        if(!empty($user)) {
            $this->db->where('u.id', (int) $user);
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
        if(!empty($params)) {
            $first = true;
            $user_search = array('surname', 'name', 'middle_name');
            $keys = array('name', 'name_desc', 'description');
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
                foreach ($results as $key => $result) {
                    $results[$key]->related  = $this->getRelations($result->id, 'related');
                    $results[$key]->progress = $this->getRelations($result->id, 'progress');
                    $results[$key]->tags     = $this->getFilters($result->id);

                    $this->db->reset_query();

                    $this->db->select('t.*');
                    $this->db->from($this->tags_links_table.' AS a');
                    $this->db->where('a.exercise_id', (int) $result->id);
                    $this->db->join($this->tag_table.' AS t', 't.id = a.tag_id', 'left');
                    /*$this->db->select('pt.tag AS parent_tag');
                    $this->db->join($this->tag_table.' AS pt', 'pt.id = t.parent_id', 'left');*/

                    $this->db->order_by('t.group_id', 'ASC');
                    $this->db->order_by('t.order', 'ASC');

                    $tags = $this->db->get()->result();
                    if(!empty($tags)) {
                        $results[$key]->tags = $tags;
                    } else {
                        $results[$key]->tags = false;
                    }
                }
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
                $this->unsetExerciseData($id);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteExercise($id, $user) {
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
            $id = $this->getExerciseByHash($hash);
            if($id) {
                $this->db->from($this->favorite_table);
                $this->db->where('exercise_id', $id);
                $this->db->where('user_id', (int) $user);
                $exist = $this->db->count_all_results();
                if($exist == 0) {
                    $data = array(
                            'user_id'     => (int) $user,
                            'exercise_id' => $id
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


    public function getExercisesLast($user = false, $per_page = null, $page = 0, $order = array(), $count = false, $author = false, $deleted = false) {
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

    public function removeFavorite($user, $hash) {
        if($hash && $user) {
            $id = $this->getExerciseByHash($hash);
            if($id) {
                $this->db->where('exercise_id', $id);
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

    private function unsetExerciseData($id) {
        if($id) {
            $this->db->where('exercise_id', $id);
            $this->db->delete($this->tags_links_table);
            $this->db->reset_query();

            $this->db->or_where('related_id', $id);
            $this->db->delete($this->related_links_table);
            $this->db->reset_query();

            $this->db->or_where('progress_id', $id);
            $this->db->delete($this->progress_links_table);
            $this->db->reset_query();

            $this->db->or_where('exercise_id', $id);
            $this->db->delete($this->favorite_table);
            $this->db->reset_query();

            $this->db->or_where('exercise_id', $id);
            $this->db->delete($this->programs_exercises_table);
            $this->db->reset_query();

            return true;
        } else {
            return false;
        }
    }

}