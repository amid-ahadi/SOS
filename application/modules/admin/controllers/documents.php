<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class documents extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("document_model");
        $this->load->model("cases_model");
        $this->load->model("clients_model"); // Ensure clients_model is loaded to use get_case_by_case_id
        $this->load->library('form_validation');
    }

    function index() {
        $data['documents'] = $this->document_model->get_all();
        $data['page_title'] = lang('documents');
        $data['body'] = 'documents/list';
        $this->load->view('template/main', $data);
    }

    function add() {
        $this->load->library('form_validation');
        $this->load->model('cases_model');
        $this->load->model('document_model');
        $this->load->model("clients_model"); // Ensure clients_model is loaded

        $data['cases'] = $this->cases_model->get_all();

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_message('required', lang('custom_required'));
            $this->form_validation->set_rules('is_case', lang('type'), 'required');
            $this->form_validation->set_rules('title', lang('title'), 'required');

            if ($this->input->post('is_case') == 1) {
                $this->form_validation->set_rules('case_id', lang('case'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {

                $save = array(
                    'is_case' => $this->input->post('is_case'),
                    'title'   => $this->input->post('title')
                );

                if ($this->input->post('is_case') == 1) {
                    $save['case_id'] = $this->input->post('case_id');
                }

                if (isset($_FILES['document_file']) && !empty($_FILES['document_file']['name'])) {
                    $config['upload_path'] = './uploads/documents/';
                    $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|ppt|pptx|txt|jpg|png';
                    $config['max_size'] = 2048;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('document_file')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/documents/add');
                    } else {
                        $upload_data = $this->upload->data();
                        $save['file_name'] = $upload_data['file_name'];
                        $save['file_type'] = $upload_data['file_type'];
                        $save['upload_date'] = date('Y-m-d H:i:s');
                    }
                } else {
                    $save['file_name'] = NULL;
                    $save['file_type'] = NULL;
                }

                $this->document_model->save($save);
                $this->session->set_flashdata('message', lang('document_saved'));
                redirect('admin/documents');
            }
        }

        $data['page_title'] = lang('add') . ' ' . lang('document');
        $data['body'] = 'documents/add';
        $this->load->view('template/main', $data);
    }

    function edit($id = false){
        $data['document'] = $this->document_model->get($id);
        $data['cases'] = $this->cases_model->get_all();
        $data['id'] = $id;

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', lang('title'), 'required');

            if ($this->input->post('is_case') == 1) {
                $this->form_validation->set_rules('case_id', lang('case'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $save = array(
                    'is_case' => $this->input->post('is_case'),
                    'title' => $this->input->post('title')
                );

                if ($this->input->post('is_case') == 1) {
                    $save['case_id'] = $this->input->post('case_id');
                }

                $this->document_model->update($save, $id);
                $this->session->set_flashdata('message', lang('document_updated'));
                redirect('admin/documents');
            }
        }

        $data['page_title'] = lang('edit') . lang('document');
        $data['body'] = 'documents/edit';
        $this->load->view('template/main', $data);
    }

    function manage($id = false) {
        if (!$id) {
            redirect('admin/documents');
        }

        $data['document'] = $this->document_model->get($id);
        $data['documents'] = $this->document_model->get_all_documents($id);
        $data['id'] = $id;

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->load->library('upload');

            // Determine the upload folder name
            $upload_folder_name = $id; // Default to document_id
            if ($data['document'] && $data['document']->is_case == 1 && !empty($data['document']->case_id)) {
                // Use clients_model->get_case_by_case_id to fetch case details
                $case_details = $this->clients_model->get_case_by_case_id($data['document']->case_id);
                if ($case_details && !empty($case_details->case_no)) {
                    $upload_folder_name = $case_details->case_no; // Use case_no for folder name
                }
            }

            if (!empty($_FILES['doc']['name'][0])) {
                $files = $_FILES;
                $cpt = count($_FILES['doc']['name']);

                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name']     = $files['doc']['name'][$i];
                    $_FILES['userfile']['type']     = $files['doc']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['doc']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['doc']['error'][$i];
                    $_FILES['userfile']['size']     = $files['doc']['size'][$i];

                    $title = isset($_POST['title'][$i]) ? $_POST['title'][$i] : 'Untitled';

                    $upload_path = './uploads/documents/' . $upload_folder_name; // Use determined folder name

                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0755, true);
                    }

                    $config = array(
                        'upload_path'   => $upload_path,
                        'allowed_types' => 'pdf|doc|docx|xls|xlsx|ppt|pptx|txt|jpg|png',
                        'max_size'      => 2048,
                        'encrypt_name'  => TRUE
                    );

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload()) {
                        $upload_data = $this->upload->data();

                        $save = array(
                            'document_id' => $id,
                            'file_name'   => $upload_data['file_name'],
                            'title'       => $title,
                            'upload_date' => date('Y-m-d H:i:s')
                        );

                        $this->document_model->save_document($save);
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
            }

            $this->session->set_flashdata('message', lang('documents_saved'));
            redirect('admin/documents/manage/' . $id);
        }

        $data['page_title'] = lang('manage') . ' ' . lang('documents');
        $data['body'] = 'documents/manage';
        $this->load->view('template/main', $data);
    }

    function download($id, $file_name = null)
    {
        $file_info = $this->document_model->get_file_by_id($id);

        if (!$file_info || !$file_name) {
            $this->session->set_flashdata('error', lang('file_not_found'));
            redirect('admin/documents');
        }
        
        // Re-determine the path for download based on case_id if applicable
        $document_parent_info = $this->document_model->get($file_info->document_id);
        $parent_folder_name = $file_info->document_id; // Default to document_id

        if ($document_parent_info && $document_parent_info->is_case == 1 && !empty($document_parent_info->case_id)) {
            // Use clients_model->get_case_by_case_id to fetch case details
            $case_details = $this->clients_model->get_case_by_case_id($document_parent_info->case_id);
            if ($case_details && !empty($case_details->case_no)) {
                $parent_folder_name = $case_details->case_no;
            }
        }

        $file_path = FCPATH . 'uploads/documents/' . $parent_folder_name . '/' . $file_name;

        if (!file_exists($file_path)) {
            $this->session->set_flashdata('error', lang('file_not_found'));
            redirect('admin/documents/manage/' . $file_info->document_id);
        }

        $this->load->helper('download');
        force_download($file_name, file_get_contents($file_path));
    }

    function delete_document($id, $file_name = null)
    {
        $file_info = $this->document_model->get_file_by_id($id);

        if (!$file_info || !$file_name) {
            $this->session->set_flashdata('error', lang('file_not_found'));
            redirect('admin/documents');
        }

        // Re-determine the path for deletion based on case_id if applicable
        $document_parent_info = $this->document_model->get($file_info->document_id);
        $parent_folder_name = $file_info->document_id; // Default to document_id

        if ($document_parent_info && $document_parent_info->is_case == 1 && !empty($document_parent_info->case_id)) {
            // Use clients_model->get_case_by_case_id to fetch case details
            $case_details = $this->clients_model->get_case_by_case_id($document_parent_info->case_id);
            if ($case_details && !empty($case_details->case_no)) {
                $parent_folder_name = $case_details->case_no;
            }
        }

        $file_path = FCPATH . 'uploads/documents/' . $parent_folder_name . '/' . $file_name;

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $this->document_model->delete_file_record($id);
        $this->session->set_flashdata('message', lang('file_deleted'));

        redirect('admin/documents/manage/' . $file_info->document_id);
    }

    function delete($id = false) {
        if ($id) {
            $this->document_model->delete($id);
            $this->session->set_flashdata('message', lang('document_deleted'));
            redirect('admin/documents');
        }
    }

    function set_upload_options()
    {
        $config = array();
        $config['upload_path'] = './uploads/documents/';
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|ppt|pptx|txt|jpg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        return $config;
    }
}