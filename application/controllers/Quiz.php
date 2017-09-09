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
		$data['quiz_id'] = $quiz_id;
		$data['quiz_name'] = $quiz_name;
		$data['questions'] = $this->quiz_model->retrieve_questions($quiz_id);

		// Load views
		$data['main_content'] = 'take_quiz_view';
        $this->load->view('template/body_view', $data);
	}

	public function answers()
	{
		// Store variables
		$data['user_id'] = $this->session->userdata('user_id');
		$quiz_id = $this->session->userdata('quiz_id');

		foreach($_POST as $key => $val)  
		    {  
		        $data[$key] = $this->input->post($key);  
		    }

		// Interact with models
		$this->quiz_model->save_answers($data);
		$data['questions'] = $this->quiz_model->retrieve_questions($quiz_id);

		// Load views
		$data['main_content'] = 'quiz_result_view';
        $this->load->view('template/body_view', $data);
	}



}
