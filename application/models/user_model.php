<?php
class User_model extends CI_Model {

        function create_user($data)
        {
                $this->db->insert('users', $data);
                $user_id = $this->db->insert_id();
                return $user_id;
        }

}