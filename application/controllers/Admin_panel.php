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

		$data['quiz_id'] = $this->quiz_model->create($data);

		$data['main_content'] = 'admin/add_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function add_question()
	{
		$this->input->post('user_name');
		$data['main_content'] = 'admin/add_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function edit_quiz()
	{
		$this->input->post('user_name');
		$data['main_content'] = 'admin/edit_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function user_quiz_score()
	{
		$this->input->post('user_name');
		$data['main_content'] = 'admin/edit_question_view';
        $this->load->view('template/body_view', $data);
	}

	public function delete_quiz()
	{
		$this->input->post('user_name');
		$data['main_content'] = 'admin/edit_question_view';
        $this->load->view('template/body_view', $data);
	}
}