<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		
		// Get form values
		$data['user_name'] = $this->input->post('user_id');

		//create a user ID and store in SESSION
		$this->session->set_userdata('user_id', $this->user_model->create_user($data));

		// Retrieve list of quizzes that can be taken anonymously
		$data['quizzes'] = $this->quiz_model->list_quizzes_anon();

		// Load views
		$data['main_content'] = 'quiz_list_view';
        $this->load->view('template/body_view', $data);
	}

}
