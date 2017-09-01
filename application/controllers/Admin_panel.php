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
		$data['main_content'] = 'welcome_view';
        $this->load->view('template/body_view', $data);
	}

	public function create_quiz()
	{
		$this->input->post('user_name')
		$data['main_content'] = 'welcome_view';
        $this->load->view('template/body_view', $data);
	}

	public function add_question()
	{
		$this->input->post('user_name')
		$data['main_content'] = 'welcome_view';
        $this->load->view('template/body_view', $data);
	}

	public function edit_question()
	{
		$this->input->post('user_name')
		$data['main_content'] = 'welcome_view';
        $this->load->view('template/body_view', $data);
	}
}