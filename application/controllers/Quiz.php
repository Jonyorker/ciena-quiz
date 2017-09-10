<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function anonymous()
	{
		// Store variables
		//create a user ID and store in SESSION
		$data['user_name'] = $this->input->post('user_id');
		$user_id = $this->user_model->create_user($data);
		$this->session->set_userdata('user_id', $user_id);

		// Interact with models
		$data['quizzes'] = $this->quiz_model->retrieve_quizzes_anon();

		// Load views
		$data['main_content'] = 'quiz_list_anonymous_view';
        $this->load->view('template/body_view', $data);
	}

	public function take_quiz($quiz_id, $quiz_name)
	{
		// Store variables
		$this->session->set_userdata('quiz_id', $quiz_id);
		$this->session->set_userdata('quiz_name', $quiz_name);

		$data['quiz_id'] = $quiz_id;
		$data['quiz_name'] = $quiz_name;
		// $data['questions'] = $this->quiz_model->retrieve_questions($quiz_id);
		$question_count = $data['question_count'] = $this->quiz_model->question_count($quiz_id);
		$this->session->set_userdata('question_count', $question_count);
		$this->session->set_userdata('question_index', 0);
		$this->session->set_userdata('user_score', 0);
		$question_index = $this->session->userdata('question_index');

		$data['question'] = $this->quiz_model->retrieve_question($quiz_id, $question_index);

		// Load views
		$data['main_content'] = 'take_quiz_view';
        $this->load->view('template/body_view', $data);
	}

	public function answer()
	{
		// Store variables
		foreach($_POST as $key => $val)  
	 	    {  
	 	        $data[$key] = $this->input->post($key);  
	 	    }
	 	// Interact with models
	 	$this->quiz_model->save_answer($data);
	 	$data['user_answer'] = $this->quiz_model->user_answer($data['question_id']);
	 	$data['right_choice'] = $this->quiz_model->retrieve_question_right_choice($data['quiz_id'], $this->session->userdata('question_index'));

	 	if ($data['user_answer'] == $data['right_choice']) {
	 		$user_score = $this->session->userdata('user_score');
	 		$user_score++;
	 		$this->session->set_userdata('user_score', $user_score);
	 	}

	 	if ($data['right_choice'] == 1) {
	 		$data['right_choice_text'] = $this->quiz_model->retrieve_question_right_choice_text($data['quiz_id'], $this->session->userdata('question_index'), 'answer_a');
	 	}
	 	elseif ($data['right_choice'] == 2) {
	 		$data['right_choice_text'] = $this->quiz_model->retrieve_question_right_choice_text($data['quiz_id'], $this->session->userdata('question_index'), 'answer_b');
	 	}
	 	elseif ($data['right_choice'] == 3) {
	 		$data['right_choice_text'] = $this->quiz_model->retrieve_question_right_choice_text($data['quiz_id'], $this->session->userdata('question_index'), 'answer_c');
	 	}
	 	elseif ($data['right_choice'] == 4) {
	 		$data['right_choice_text'] = $this->quiz_model->retrieve_question_right_choice_text($data['quiz_id'], $this->session->userdata('question_index'), 'answer_d');
	 	}

	 	$question_index = $this->session->userdata('question_index');
		$question_count = $this->session->userdata('question_count');
	 	if ($question_index == ($question_count - 1)) {
			$data['button_text'] = 'Finish Quiz';
		}
		else {
			$data['button_text'] = 'Next Question';
		}

	 	// Load views
		$data['main_content'] = 'check_answer_view';
        $this->load->view('template/body_view', $data);

	}

	public function next_question()
	{
		$question_index = $this->session->userdata('question_index');
		$question_count = $this->session->userdata('question_count');
		$quiz_id = $this->session->userdata('quiz_id');

		if ($question_index == ($question_count - 1)) {
			redirect('/Quiz/finish_quiz/');
		}
		else {
			$question_index++;
			$this->session->set_userdata('question_index', $question_index);

			$data['question'] = $this->quiz_model->retrieve_question($quiz_id, $question_index);

			// Load views
			$data['main_content'] = 'take_quiz_view';
	        $this->load->view('template/body_view', $data);
		}
		
		
	}

	public function finish_quiz()
	{
		$question_count = $this->session->userdata('question_count');
		$user_score = $this->session->userdata('user_score');

		$data['percentage'] = round(($user_score / $question_count) * 100);

		$data['main_content'] = 'quiz_result_view';
	    $this->load->view('template/body_view', $data);
	}

	// public function answers()
	// {
	// 	// Store variables
	// 	$data['user_id'] = $this->session->userdata('user_id');
	// 	$quiz_id = $this->session->userdata('quiz_id');

	// 	foreach($_POST as $key => $val)  
	// 	    {  
	// 	        $data[$key] = $this->input->post($key);  
	// 	    }

	// 	// Interact with models
	// 	$this->quiz_model->save_answers($data);
	// 	$data['questions'] = $this->quiz_model->retrieve_questions($quiz_id);

	// 	// Load views
	// 	$data['main_content'] = 'quiz_result_view';
 //        $this->load->view('template/body_view', $data);
	// }



}
