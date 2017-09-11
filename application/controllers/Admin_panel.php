<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_panel extends CI_Controller {

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
	public function index()
	{
		$data['main_content'] = 'admin/admin_home_view';
        $this->load->view('template/body_view', $data);
	}

	public function create_quiz() // Create Quiz
	{
		$data['main_content'] = 'admin/create_quiz_view';
        $this->load->view('template/body_view', $data);
	}

	public function store_quiz() // Store Quiz
	{
		// Get form values
		foreach($_POST as $key => $val)  
	 	    {  
	 	        $data[$key] = $this->input->post($key);  
	 	    }

		// Save quiz in DB
		$data['quiz_id'] = $this->quiz_model->create_quiz($data);

		// Load views
		$data['main_content'] = 'admin/add_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function create_question() // Create and store question
	{
		// Get form values for question
		$data['quiz_id'] = $this->input->post('quiz_id');
		$data['question_text'] = $this->input->post('question_text');
		$data['answer_a'] = $this->input->post('answer_a');
		$data['answer_b'] = $this->input->post('answer_b');
		$data['answer_c'] = $this->input->post('answer_c');
		$data['answer_d'] = $this->input->post('answer_d');
		$data['right_choice'] = $this->input->post('right_choice');

		// Save question in DB
		$this->question_model->create_question($data);

		// Get quiz name for view
		$data['quiz_name'] = $this->input->post('quiz_name');

		// Add more questions or finished to Load views
		if($this->input->post('more')) {
			$data['main_content'] = 'admin/add_question_view'; // Add another question
		}
		if($this->input->post('finish')) {
			$data['main_content'] = 'admin/admin_home_view'; // Return to admin panel
		}

		// Load views
        $this->load->view('template/body_view', $data);
	}

	public function list_quizzes() // Get list of all quizzes in DB
	{
		// Retrieve quizzes
		$data['quizzes'] = $this->quiz_model->list_quizzes();

		// Load views
		$data['main_content'] = 'admin/list_quizzes_view';
        $this->load->view('template/body_view', $data);
	}

	public function list_questions($id, $name) // Get list of questions for specific quiz
	{
		// Store variables
		$data['questions'] = $this->question_model->list_questions($id);
		$data['quiz_name'] = $name;
		$data['quiz_id'] = $id;
		
		// Load views
		$data['main_content'] = 'admin/list_questions_view';
        $this->load->view('template/body_view', $data);
	}

	public function retrieve_question_value($id) // Edit question values
	{
		// Store variables
		$data['question'] = $this->question_model->retrieve_question_value($id);
		
		// Load views
		$data['main_content'] = 'admin/edit_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function save_question_changes() // Store changes to question
	{
		// Get form values
		foreach($_POST as $key => $val)  
	 	    {  
	 	        $data[$key] = $this->input->post($key);  
	 	    }

		// Store changes
		$this->question_model->save_question_changes($data);
		
		// Load views
		$data['main_content'] = 'admin/admin_home_view';
        $this->load->view('template/body_view', $data);
	}

	public function add_question($quiz_id) // Add question to quiz from edit screen
	{
		// Store variables
		$data['quiz_id'] = $quiz_id;
		$data['quiz_name'] = $this->quiz_model->get_quiz_name($quiz_id);

		// Load views
		$data['main_content'] = 'admin/add_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function delete_quiz($quiz_id) // Delete quiz and related questions
	{
		// Interact with models
		$this->quiz_model->delete_quiz($quiz_id);
		$this->question_model->delete_quiz_questions($quiz_id);

		// Load views
		$data['main_content'] = 'admin/admin_home_view';
        $this->load->view('template/body_view', $data);
	}

	public function delete_question($question_id) // Delete question
	{
		// Interact with models
		$this->question_model->delete_question($question_id);

		// Load views
		$data['main_content'] = 'admin/admin_home_view';
        $this->load->view('template/body_view', $data);
	}
}