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

        function question_count($id)
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                return $query->num_rows();
        }

        function retrieve_question($id, $question_index)
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                return $query->row_array($question_index);
        }

        function retrieve_question_right_choice($id, $question_index)
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                $result = $query->row($question_index);
                return $result->right_choice;
        }

        function retrieve_question_right_choice_text($id, $question_index, $answer_column)
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                $result = $query->row($question_index);
                return $result->$answer_column;
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

        function save_answer($data)
        {
                $this->db->insert('answer', $data);
                return;
        }

        function save_answers($data)
        {
                $index = 0;
                foreach ($data['user_answer'] as $key) {
                        $answer = array('user_id' => $data['user_id'], 'quiz_id' => $data['quiz_id'], 'question_id' => $data['question_id'][$index], 'user_answer' => $key);
                        $index++;
                        $this->db->insert('answer', $answer);    
                } 
        }

        function user_answer($question_id)
        {
                $user_id = $this->session->userdata('user_id');
                $query = $this->db->get_where('answer', array('question_id' => $question_id, 'user_id' => $user_id));
                $result = $query->row();
                return $result->user_answer;
        }


}