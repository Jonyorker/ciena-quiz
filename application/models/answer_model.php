<?php
class Answer_model extends CI_Model {

        function create_answer($data) // Save individual answer
        {
                $this->db->insert('answer', $data);
                return;
        }

        // function create_answers($data) // Save multiple answers at once
        // {
        //         $index = 0;
        //         foreach ($data['user_answer'] as $key) {
        //                 $answer = array('user_id' => $data['user_id'], 'quiz_id' => $data['quiz_id'], 'question_id' => $data['question_id'][$index], 'user_answer' => $key);
        //                 $index++;
        //                 $this->db->insert('answer', $answer);    
        //         } 
        // }

        function user_answer($question_id)
        {
                $user_id = $this->session->userdata('user_id');
                $query = $this->db->get_where('answer', array('question_id' => $question_id, 'user_id' => $user_id));
                $result = $query->row();
                return $result->user_answer;
        }

}