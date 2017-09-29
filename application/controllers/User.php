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
		if (!is_null($this->session->userdata('referred_from')))
		{
		    redirect($this->session->userdata('referred_from'));
		}
		else {
			$data['main_content'] = 'quiz_list_view';
        	$this->load->view('template/body_view', $data);
		}
		
	}

	public function registered_user()
	{
		
		// Get form values
		$username = $data['user_name'] = $this->input->post('user_email');
		$password = $this->input->post('user_password');

		// LDAP Connection
		$login_result = $this->ldap_verify($username, $password);
		
		// Check LDAP Results
		if ($login_result != false) {
			$data['user_name'] = $login_result;
			$login_success = true;
		}
		else {
			$login_success = false;
		}
		
		// Logic based on LDAP Connection Result
		if ($login_success == true) {

			// check if user logged in before
			$user_id = $this->user_model->check_user_exists($data['user_name']);
			if ($user_id >= 1) {
				$this->session->set_userdata('user_id', $user_id);
			}
			else {
			//create a user ID and store in SESSION
			$this->session->set_userdata('user_id', $this->user_model->create_user($data));
			}

			// Retrieve list of quizzes
			$data['quizzes'] = $this->quiz_model->list_quizzes();

			// Load views
			if (!is_null($this->session->userdata('referred_from')))
			{
			    redirect(base_url().$this->session->userdata('referred_from'));
			}
			else {
				$data['main_content'] = 'quiz_list_view';
	        $this->load->view('template/body_view', $data);
			}
			// Load views
			
		}
		else {

			$data['login_error'] = 'Invalid username/password – please try again';
			$data['main_content'] = 'welcome_view';
	        $this->load->view('template/body_view', $data);			
		}
		
	}

	public function ldap_verify($username, $password)
	{
		if (isset($username) && isset($password)) {
			$ldaprdn = 'ciena' . "\\" . $username;
        	$adServer = "vawdc01.ciena.com";
        	$ldap = ldap_connect($adServer);
        	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        	$bind = @ldap_bind($ldap, $ldaprdn, $password);

        	if ($bind == true) {
        		$result = ldap_search($ldap, "dc=CIENA,dc=COM","(sAMAccountName=$username)");
        		$info = ldap_get_entries($ldap, $result);
              	ldap_close($ldap);

              	return $info[0]['mail'][0];
        	}
        	else {
				return false;
			}
		
		}
	}
}
