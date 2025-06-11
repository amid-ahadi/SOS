	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Clients extends MX_Controller {

		public function __construct()
		{
			parent::__construct();
			//$this->auth->check_access('1', true);
			$this->load->model("clients_model");
			$this->load->model("custom_field_model");
			$this->load->library('form_validation');
			$this->load->library('session');
		}


		function index(){
			$data['clients'] = $this->clients_model->get_all_clients();
			$data['page_title'] = lang('clients');
			$data['body'] = 'clients/list';
			$this->load->view('template/main', $data);

		}


		function export(){
			$data['clients'] = $this->clients_model->get_all_clients();
			$this->load->view('clients/export', $data);

		}

		function add(){
			$data['fields'] = $this->custom_field_model->get_custom_fields(1);
			if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				$this->form_validation->set_message('required', lang('custom_required'));

				$this->form_validation->set_rules('name', 'lang:name', 'required');
				$this->form_validation->set_rules('gender', 'lang:gender', 'required');
				$this->form_validation->set_rules('dob', 'lang:date_of_birth');
				$this->form_validation->set_rules('meli', 'lang:meli', 'required|numeric|exact_length[10]|is_unique[users.meli]');
				$this->form_validation->set_rules('father', 'lang:father', 'required');
				$this->form_validation->set_rules('ss', 'lang:ss', 'required');
				$this->form_validation->set_rules('lob', 'lang:lob', 'required');
				$this->form_validation->set_rules('job', 'lang:job');
				$this->form_validation->set_rules('moaref', 'lang:moaref');
				$this->form_validation->set_rules('postcode', 'lang:postcode');
				//$this->form_validation->set_rules('username', 'lang:username', 'trim|required|is_unique[users.username]');
				//$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
				//$this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
				$this->form_validation->set_rules('contact', 'lang:phone', 'required');
				$this->form_validation->set_rules('address', 'lang:address', '');
				foreach ($data['fields'] as $doc) {
				$this->form_validation->set_rules("reply[{$doc->id}]", $doc->name, 'required');
				}

				$this->form_validation->set_message('is_unique', lang('meli_already_exists'));
				$this->form_validation->set_message('numeric', lang('meli_not_numeric'));
				$this->form_validation->set_message('exact_length', lang('meli_invalid_length'));

				if ($this->form_validation->run() == FALSE)
				{
					// $this->session->set_flashdata('error', validation_errors());
				}
				else
				{
					$save['name'] = $this->input->post('name');
					$save['gender'] = $this->input->post('gender');
					$save['dob'] = $this->input->post('dob');
					$save['meli'] = $this->input->post('meli');
					$save['job'] = $this->input->post('job');
					$save['father'] = $this->input->post('father');
					$save['lob'] = $this->input->post('lob');
					$save['postcode'] = $this->input->post('postcode');
					$save['moaref'] = $this->input->post('moaref');
					$save['ss'] = $this->input->post('ss');
					$save['username'] = $this->input->post('username');
					$save['password'] = sha1($this->input->post('password'));
					$save['contact'] = $this->input->post('contact');
					$save['address'] = $this->input->post('address');
					$save['user_role'] = 2;

					$p_key = $this->clients_model->save($save);

					$reply = $this->input->post('reply');
					if(!empty($reply)){
						$save_fields = array();
						foreach($this->input->post('reply') as $key => $val) {
							$save_fields[] = array(
								'custom_field_id'=> $key,
								'reply'=> $val,
								'table_id'=> $p_key,
								'form'=> 1,
							);
						}
						$this->custom_field_model->save_answer($save_fields);
					}
					$this->session->set_flashdata('message', lang('client_created'));
					redirect('admin/clients');
				}
			}
			$data['page_title'] = lang('add') . lang('client');
			$data['body'] = 'clients/add';
			$this->load->view('template/main', $data);
		}


		function add_client(){
			if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				$this->load->library('form_validation');
				$this->form_validation->set_message('required', lang('custom_required'));
				// Update MELI rule here too if this method is used for adding clients
				$this->form_validation->set_rules('name', 'lang:name', 'required');
				$this->form_validation->set_rules('gender', 'lang:gender', 'required');
				$this->form_validation->set_rules('meli', 'lang:meli', 'required'); // Add '|numeric|exact_length[10]|is_unique[users.meli]' here if needed
				$this->form_validation->set_rules('father', 'lang:father', 'required');
				$this->form_validation->set_rules('ss', 'lang:ss', 'required');
				$this->form_validation->set_rules('lob', 'lang:lob', 'required');
				$this->form_validation->set_rules('job', 'lang:job');
				$this->form_validation->set_rules('moaref', 'lang:moaref');
				$this->form_validation->set_rules('postcode', 'lang:postcode');
			   // $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]|is_unique[users.email]');
				//$this->form_validation->set_rules('username', 'lang:username', 'trim|required|is_unique[users.username]');
			//	$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
			//	$this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');

				if ($this->form_validation->run()==true)
				{
					$save['name'] = $this->input->post('name');
					$save['gender'] = $this->input->post('gender');
					$save['dob'] = $this->input->post('dob');
				 //   $save['email'] = $this->input->post('email');
					//$save['username'] = $this->input->post('username');
				//	$save['password'] = sha1($this->input->post('password'));
					$save['contact'] = $this->input->post('contact');
					$save['address'] = $this->input->post('address');
					$save['user_role'] = 2;

					$p_key = $this->clients_model->save($save);
					$reply = $this->input->post('reply');
					if(!empty($reply)){
						$save_fields = array();
						foreach($this->input->post('reply') as $key => $val) {
							$save_fields[] = array(
								'custom_field_id'=> $key,
								'reply'=> $val,
								'table_id'=> $p_key,
								'form'=> 1,
							);
						}
						$this->custom_field_model->save_answer($save_fields);
					}

					echo "Success";
				}else{
				echo '
					<div class="alert alert-danger alert-dismissable">
													<i class="fa fa-ban"></i>
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
													<b>Alert!</b>'.validation_errors().'
												</div>
					';
				}
			}
		}


		function edit($id=false){
			$data['fields'] = $this->custom_field_model->get_custom_fields(1);
			$data['clients'] = $this->clients_model->get_client_by_id($id);
			if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				$this->load->library('form_validation');
				$this->form_validation->set_message('required', lang('custom_required'));
				$this->form_validation->set_rules('name', 'lang:name', 'required');
				$this->form_validation->set_rules('gender', 'lang:gender', 'required');
				// Corrected MELI rule for editing: uses dots for is_unique parameter separation
				$this->form_validation->set_rules('meli', 'lang:meli', 'required|numeric|exact_length[10]');
				$this->form_validation->set_rules('father', 'lang:father');
				$this->form_validation->set_rules('ss', 'lang:ss');
				$this->form_validation->set_rules('lob', 'lang:lob');
				$this->form_validation->set_rules('job', 'lang:job');
				$this->form_validation->set_rules('moaref', 'lang:moaref');
				$this->form_validation->set_rules('postcode', 'lang:postcode');
			   // $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]');
				//$this->form_validation->set_rules('username', 'lang:username', 'trim|required|');
				$this->form_validation->set_rules('contact', 'lang:phone', 'required');
			//	if ($this->input->post('password') != '' || $this->input->post('confirm') != '' || !$id)
			//	{
			//		$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
			//		$this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
			//	}

				// Set custom messages for validation rules
				$this->form_validation->set_message('is_unique', lang('meli_already_exists'));
				$this->form_validation->set_message('numeric', lang('meli_not_numeric'));
				$this->form_validation->set_message('exact_length', lang('meli_invalid_length'));

				if ($this->form_validation->run())
				{

					$save['name'] = $this->input->post('name');
					$save['gender'] = $this->input->post('gender');
					$save['dob'] = $this->input->post('dob');
			   //     $save['email'] = $this->input->post('email');
					//$save['username'] = $this->input->post('username');
					$save['contact'] = $this->input->post('contact');
					$save['meli'] = $this->input->post('meli');
					$save['job'] = $this->input->post('job');
					$save['father'] = $this->input->post('father');
					$save['lob'] = $this->input->post('lob');
					$save['postcode'] = $this->input->post('postcode');
					$save['moaref'] = $this->input->post('moaref');
					$save['ss'] = $this->input->post('ss');
					$save['address'] = $this->input->post('address');
					$save['user_role'] = 2;
				   if ($this->input->post('password') != '' || !$id)
					{
						$save['password']	= sha1($this->input->post('password'));
					}


					$reply = $this->input->post('reply');
					if(!empty($reply)){
						$save_fields = array();
						foreach($this->input->post('reply') as $key => $val) {
							$save_fields[] = array(
								'custom_field_id'=> $key,
								'reply'=> $val,
								'table_id'=> $id,
								'form'=> 1,
							);
						}
						$this->custom_field_model->delete_answer($id,$form=1);
						$this->custom_field_model->save_answer($save_fields);
					}


					$this->clients_model->update($save,$id);
					$this->session->set_flashdata('message', lang('client_updated'));
					redirect('admin/clients');
				}


			}
			$data['page_title'] = lang('edit') . lang('client');
			$data['body'] = 'clients/edit';
			$this->load->view('template/main', $data);

		}

		function view_client($id=false){
			$data['fields'] = $this->custom_field_model->get_custom_fields(1);
			$data['clients'] = $this->clients_model->get_client_by_id($id);
			$data['page_title'] = lang('view') . lang('client');
			$data['body'] = 'clients/view';
			$this->load->view('template/main', $data);
		}



		function delete($id=false){

			if($id){
				$this->clients_model->delete($id);
				$this->session->set_flashdata('message',lang('client_deleted'));
				redirect('admin/clients');
			}
		}


	}