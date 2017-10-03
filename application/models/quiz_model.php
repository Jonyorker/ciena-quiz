<?php
class Quiz_model extends CI_Model {

        function create_quiz($data) // Create quiz
        {
                $this->db->insert('quiz', $data);
                $quiz_id = $this->db->insert_id();
                return $quiz_id;
        }

        function list_quizzes() // Retrieve Quizzes
        {
                $query = $this->db->get('quiz');
                return $query;
        }

        function list_quizzes_anon() // Retrieve Quizzes that can be anonymous
        {
                $query = $this->db->get_where('quiz', array('anonymous' => TRUE));
                return $query;
        }

        function get_quiz_name($id) // Get the name of the quiz
        {		
                $query = $this->db->get_where('quiz', array('quiz_id' => $id));
                $result = $query->row();
		return $result->quiz_name;
        }

        function get_quiz_background($id) // Get the background for that quiz
        {
                $query = $this->db->get_where('quiz', array('quiz_id' => $id));
                $result = $query->row();
                return $result->background_img;
        }

        function delete_quiz($quiz_id) // Delete quiz
        {               
                $this->db->where('quiz_id', $quiz_id);
                $this->db->delete('quiz');
                return;
        }


}