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

        function save_question_changes($data)
        {
                $this->db->where('question_id', $data['question_id']);
				$this->db->update('question', $data);
				return;
        }

        function retrieve_quizzes()
        {
                $query = $this->db->get('quiz');
                return $query;
        }
        function retrieve_quizzes_anon()
        {
                $query = $this->db->get_where('quiz', array('anonymous' => TRUE));
                return $query;
        }

        function retrieve_questions($id)
        {		
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                return $query;
        }

        function retrieve_question_value($id)
        {		
                $query = $this->db->get_where('question', array('question_id' => $id));
                return $query->row_array();
        }

        function get_quiz_name($id)
        {		
                $query = $this->db->get_where('quiz', array('quiz_id' => $id));
                $result = $query->row();
				return $result->quiz_name;
        }

        function delete_quiz($quiz_id)
        {		
                $this->db->where('quiz_id', $quiz_id);
				$this->db->delete('quiz');
				return;
        }

        function delete_quiz_questions($quiz_id)
        {		
                $this->db->where('quiz_id', $quiz_id);
				$this->db->delete('question');
				return;
        }

        function delete_question($question_id)
        {		
                $this->db->where('question_id', $question_id);
				$this->db->delete('question');
				return;
        }

        function save_answers($data)
        {
                foreach ($data['user_answer'] as $key) {
                        $this->db->insert('answer', $data);
                }       
        }


}