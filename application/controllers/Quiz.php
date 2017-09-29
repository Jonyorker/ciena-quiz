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

	public function start($quiz_id) // Splash page for quiz
	{
		if (is_null($this->session->userdata('user_id'))) {
			// $data['user_name'] = 'anonymous';
			// $this->session->set_userdata('user_id', $this->user_model->create_user($data));
			$this->session->set_userdata('referred_from', uri_string());
			redirect('/Welcome/index');
		}

		// Grab values and put in session
		$this->session->set_userdata('quiz_id', $quiz_id);
		$this->session->set_userdata('quiz_name', $this->quiz_model->get_quiz_name($quiz_id));

		// Load view
		$data['main_content'] = 'quiz_splash_view';
		$data['splash'] = true;
        $this->load->view('template/body_view', $data);


	}
	public function take_quiz($quiz_id) // Start and continue quiz
	{
		// Get count of questions in a quiz
		$data['question_count'] = $this->question_model->question_count($quiz_id);

		// Store session variables
		$this->session->set_userdata('question_index', 0);
		$this->session->set_userdata('user_score', 0);
		$this->session->set_userdata('question_count', $data['question_count']);

		// Add variables to $data
		$data['quiz_id'] = $quiz_id;
		$data['quiz_name'] = $this->session->userdata('quiz_name');
		$data['question'] = $this->question_model->retrieve_question_during_quiz($quiz_id, $this->session->userdata('question_index'));

		// Load views
		$data['main_content'] = 'take_quiz_view';
        $this->load->view('template/body_view', $data);
	}

	public function answer() // Save answer and check answer
	{
		// Get form values
				foreach($_POST as $key => $val)  
			 	    {  
			 	        $data[$key] = $this->input->post($key);  
			 	    }

	 	// Save answer
	 			$this->answer_model->create_answer($data);

	 	// Logic for answer tracking at the end of the quiz
			 	$data['user_answer'] = $this->answer_model->user_answer($data['question_id']);
			 	$data['right_choice'] = $this->question_model->retrieve_question_right_choice($data['quiz_id'], $this->session->userdata('question_index'));
			 	$data['extra_info'] = $this->question_model->retrieve_question_extra_info($data['quiz_id'], $this->session->userdata('question_index'));

			 	// increment $user_score if it was the right answer
			 	if ($data['user_answer'] == $data['right_choice']) {
			 		$user_score = $this->session->userdata('user_score');
			 		$user_score++;
			 		$this->session->set_userdata('user_score', $user_score);
			 	}

		// Logic for displaying congratulations or correct answer
			 	if ($data['right_choice'] == 1) {
			 		$data['right_choice_text'] = $this->question_model->retrieve_question_right_choice_text($data['quiz_id'], $this->session->userdata('question_index'), 'answer_a');
			 	}
			 	elseif ($data['right_choice'] == 2) {
			 		$data['right_choice_text'] = $this->question_model->retrieve_question_right_choice_text($data['quiz_id'], $this->session->userdata('question_index'), 'answer_b');
			 	}
			 	elseif ($data['right_choice'] == 3) {
			 		$data['right_choice_text'] = $this->question_model->retrieve_question_right_choice_text($data['quiz_id'], $this->session->userdata('question_index'), 'answer_c');
			 	}
			 	elseif ($data['right_choice'] == 4) {
			 		$data['right_choice_text'] = $this->question_model->retrieve_question_right_choice_text($data['quiz_id'], $this->session->userdata('question_index'), 'answer_d');
			 	}

		// Logic to determine button text depending on position in question list
			 	if ($this->session->userdata('question_index') == ($this->session->userdata('question_count') - 1)) {
					$data['button_text'] = 'Finish Quiz';
				}
				else {
					$data['button_text'] = 'Next Question';
				}

	 	// Load views
				$data['main_content'] = 'check_answer_view';
		        $this->load->view('template/body_view', $data);

	}

	// public function answers() // Save multiple answers at once
	// {
	// 	// Get Session Variables
	// 	$data['user_id'] = $this->session->userdata('user_id');
	// 	$quiz_id = $this->session->userdata('quiz_id');

	// 	// Get form variables
	// 	foreach($_POST as $key => $val)  
	//     {  
	//         $data[$key] = $this->input->post($key);  
	//     }

	// 	// Save answers
	// 	$this->quiz_model->save_answers($data);

	// 	// Get questions
	// 	$data['questions'] = $this->quiz_model->retrieve_questions($quiz_id);

	// 	// Load views
	// 	$data['main_content'] = 'quiz_result_view';
 // 	       $this->load->view('template/body_view', $data);
	// }

	public function next_question() // Go to next question or finish quiz
	{
		// Check if quiz should finish
		if ($this->session->userdata('question_index') == ($this->session->userdata('question_count') - 1)) {
			redirect('/Quiz/finish_quiz/');
		}
		else {
			// increment $question_index
			$question_index = $this->session->userdata('question_index');
			$question_index++;
			$this->session->set_userdata('question_index', $question_index);

			// Get question data for new question
			$data['question'] = $this->question_model->retrieve_question_during_quiz($this->session->userdata('quiz_id'), $this->session->userdata('question_index'));

			// Load views
			$data['main_content'] = 'take_quiz_view';
	        $this->load->view('template/body_view', $data);
		}
		
		
	}

	public function finish_quiz() // Finish quiz and show results
	{
		// Calculate percentage of correct answers
		$data['percentage'] = round(($this->session->userdata('user_score') / $this->session->userdata('question_count')) * 100);

		// Load views
		$data['main_content'] = 'quiz_result_view';
	    $this->load->view('template/body_view', $data);
	}





}
