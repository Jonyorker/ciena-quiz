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

	public function create_quiz()
	{
		$data['main_content'] = 'admin/create_quiz_view';
        $this->load->view('template/body_view', $data);
	}

	public function store_quiz()
	{
		$data['quiz_name'] = $this->input->post('quiz_name');
		$data['anonymous'] = $this->input->post('anonymous');

		$data['quiz_id'] = $this->quiz_model->create($data);

		$data['main_content'] = 'admin/add_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function add_question()
	{
		$data['quiz_id'] = $this->input->post('quiz_id');
		$data['question_text'] = $this->input->post('question_text');
		$data['answer_a'] = $this->input->post('answer_a');
		$data['answer_b'] = $this->input->post('answer_b');
		$data['answer_c'] = $this->input->post('answer_c');
		$data['answer_d'] = $this->input->post('answer_d');
		$data['right_choice'] = $this->input->post('right_choice');

		$this->quiz_model->add_question($data);

		$data['quiz_name'] = $this->input->post('quiz_name');

		if($this->input->post('more')) {
			$data['main_content'] = 'admin/add_question_view';
		}
		if($this->input->post('finish')) {
			$data['main_content'] = 'admin/admin_home_view';
		}

		
        $this->load->view('template/body_view', $data);
	}

	public function edit_quiz()
	{
		$data['quizzes'] = $this->quiz_model->retrieve_quizzes();

		$data['main_content'] = 'admin/edit_quiz_view';
        $this->load->view('template/body_view', $data);
	}

	public function list_questions($id, $name)
	{
		$data['questions'] = $this->quiz_model->retrieve_questions($id);
		$data['quiz_name'] = $name;
		$data['quiz_id'] = $id;
		
		$data['main_content'] = 'admin/edit_question_list_view';
        $this->load->view('template/body_view', $data);
	}

	public function edit_question($id)
	{
		$data['question'] = $this->quiz_model->retrieve_question_value($id);
		
		$data['main_content'] = 'admin/edit_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function edit_question_save()
	{
		$data['question_id'] = $this->input->post('question_id');
		$data['question_text'] = $this->input->post('question_text');
		$data['answer_a'] = $this->input->post('answer_a');
		$data['answer_b'] = $this->input->post('answer_b');
		$data['answer_c'] = $this->input->post('answer_c');
		$data['answer_d'] = $this->input->post('answer_d');
		$data['right_choice'] = $this->input->post('right_choice');

		$this->quiz_model->save_question_changes($data);
		
		$data['main_content'] = 'admin/admin_home_view';
        $this->load->view('template/body_view', $data);
	}

	public function edit_add_question($quiz_id)
	{
		$data['quiz_id'] = $quiz_id;
		$data['quiz_name'] = $this->quiz_model->get_quiz_name($quiz_id);
		$data['main_content'] = 'admin/add_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function delete_question($question_id)
	{
		$this->quiz_model->delete_question($question_id);

		$data['main_content'] = 'admin/admin_home_view';
        $this->load->view('template/body_view', $data);
	}

	public function user_quiz_score()
	{
		
		$data['main_content'] = 'admin/edit_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function delete_quiz($quiz_id)
	{
		$this->quiz_model->delete_quiz($quiz_id);
		$this->quiz_model->delete_quiz_questions($quiz_id);

		$data['main_content'] = 'admin/admin_home_view';
        $this->load->view('template/body_view', $data);
	}
}