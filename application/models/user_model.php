<?php
class User_model extends CI_Model {

        function create_user($data)
        {
            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();
            return $user_id;
        }

        function check_user_exists($data)
        {
        	$query = $this->db->get_where('users', array('user_name' => $data));
        	return $query->row('user_id');
        }

}