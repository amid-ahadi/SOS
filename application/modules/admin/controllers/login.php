<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
	}

	function index()
	{
		$redirect_if_logged_in = $this->auth->is_logged_in(false, false);
		if($redirect_if_logged_in)
		{
			redirect('admin/dashboard');
		}

		$data = array();
		$data['redirect'] = $this->session->flashdata('redirect');

		$submitted = $this->input->post('submitted');

        // --- CAPTCHA GENERATION LOGIC (CONDITIONAL & ROBUST) ---
        if (!$this->session->userdata('captcha_answer') || $_SERVER['REQUEST_METHOD'] === 'GET') {
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            $operators = ['+', '-', '*'];
            $operator = $operators[array_rand($operators)];

            $captcha_question_string = $num1 . ' ' . $operator . ' ' . $num2 . ' = ?';
            $captcha_calculated_answer = 0;

            switch ($operator) {
                case '+':
                    $captcha_calculated_answer = $num1 + $num2;
                    break;
                case '-':
                    $captcha_calculated_answer = $num1 - $num2;
                    break;
                case '*':
                    $captcha_calculated_answer = $num1 * $num2;
                    break;
            }

            $this->session->set_userdata('captcha_answer', $captcha_calculated_answer);
            $this->session->set_userdata('captcha_question_display', $captcha_question_string);
        }

        // Always pass the current (or newly generated) captcha question to the view.
        $data['captcha_question'] = $this->session->userdata('captcha_question_display');
        // IMPORTANT: Also pass the captcha ANSWER to the view for client-side validation
        $data['captcha_answer'] = $this->session->userdata('captcha_answer'); // <--- ADD THIS LINE

        // --- END OF CAPTCHA GENERATION LOGIC ---


		if ($submitted)
		{
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$remember	= $this->input->post('remember');
			$redirect	= $this->input->post('redirect');
			$user_captcha_input = $this->input->post('captcha_input');

			// Server-side CAPTCHA Validation
            $stored_captcha_answer = $this->session->userdata('captcha_answer');

            if ((int)$user_captcha_input !== (int)$stored_captcha_answer) {
                $this->session->set_flashdata('error', lang('incorrect_captcha_answer'));
                $this->session->unset_userdata('captcha_answer');
                $this->session->unset_userdata('captcha_question_display');
                redirect('admin/login');
            }


			if ($this->auth->login_admin($username, $password, $remember))
			{
				if ($redirect == '')
				{
					$redirect = 'admin/dashboard';
				}
                $this->session->unset_userdata('captcha_answer');
                $this->session->unset_userdata('captcha_question_display');
				redirect($redirect);
			}
			else
			{
                $this->session->unset_userdata('captcha_answer');
                $this->session->unset_userdata('captcha_question_display');
				$this->session->set_flashdata('error', lang('login_failed'));
				redirect('admin/login');
			}
		}

		$data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';
		$data['error'] = ($this->session->flashdata('error')) ? $this->session->flashdata('error') : '';

		$this->load->view('login/login', $data);
	}

	function logout()
	{
		$this->auth->logout();
		$this->session->set_flashdata('message', lang('logged_out'));
		redirect('admin/login');
	}

}