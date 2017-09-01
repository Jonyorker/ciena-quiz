<?php
class Quiz_model extends CI_Model {

        function create($data)
        {
                $this->db->insert('quiz', $data);
                $quiz_id = $this->db->insert_id();
                return $quiz_id;
        }

        function add_question($data)
        {
                $this->db->insert('question', $data);
                return;
        }


}