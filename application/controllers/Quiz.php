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
		$user_name = $this->input->post('user_name');
		$this->session->set_userdata('user_name', $user_name);

		$data['quizzes'] = $this->quiz_model->retrieve_quizzes_anon();

		$data['main_content'] = 'quiz_list_anonymous_view';
        $this->load->view('template/body_view', $data);
	}

	public function take_quiz($quiz_id, $quiz_name)
	{
		$data['quiz_id'] = $quiz_id;
		$data['quiz_name'] = $quiz_name;
		$data['questions'] = $this->quiz_model->retrieve_questions($quiz_id);

		$data['main_content'] = 'take_quiz_view';
        $this->load->view('template/body_view', $data);
	}
}
