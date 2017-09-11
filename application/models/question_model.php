<?php
class Question_model extends CI_Model {

	    function create_question($data) // Create question
        {
                $this->db->insert('question', $data);
                return;
        }

        function list_questions($id) // Retrieve questions for a specific quiz
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                return $query;
        }

        function retrieve_question_value($id) // Retrieve values for a specific question
        {		
                $query = $this->db->get_where('question', array('question_id' => $id));
                return $query->row_array();
        }

        function question_count($id) // Get the number of questions associated with a quiz
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                return $query->num_rows();
        }

        function retrieve_question_during_quiz($id, $question_index) // Retrieve question values with quiz-question index increment
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                return $query->row_array($question_index);
        }

        function save_question_changes($data) // Save values to DB
        {
                $this->db->where('question_id', $data['question_id']);
		$this->db->update('question', $data);
		return;
        }

        function retrieve_question_right_choice($id, $question_index) // Get which answer is the right one for a specific question
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                $result = $query->row($question_index);
                return $result->right_choice;
        }

        function retrieve_question_right_choice_text($id, $question_index, $answer_column) // Get the text that belongs to the right choice for a specifc question
        {               
                $query = $this->db->get_where('question', array('quiz_id' => $id));
                $result = $query->row($question_index);
                return $result->$answer_column;
        }

        function delete_question($question_id) // Delete specific question
        {		
                $this->db->where('question_id', $question_id);
		$this->db->delete('question');
		return;
        }

        function delete_quiz_questions($quiz_id) // Delete all questions related to specifc quiz
        {		
                $this->db->where('quiz_id', $quiz_id);
		$this->db->delete('question');
		return;
        }

}