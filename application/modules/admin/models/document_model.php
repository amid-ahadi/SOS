<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Document_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($save) {
        $this->db->insert('documents', $save);
    }

    function save_document($save) {
        $this->db->insert('rel_document_files', $save);
    }

    function get_all() {
        $this->db->select('D.*, C.case_no, C.title as case_title, C.id as c_id');
        $this->db->from('documents D');
        $this->db->join('cases C', 'C.id = D.case_id', 'LEFT');
        return $this->db->get()->result();
    }

    function get_all_documents($document_id) {
        $this->db->where('document_id', $document_id);
        return $this->db->get('rel_document_files')->result();
    }

    function get_file_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('rel_document_files')->row();
    }

    function get($id) {
        $this->db->where('id', $id);
        return $this->db->get('documents')->row();
    }

    function update($save, $id) {
        $this->db->where('id', $id);
        $this->db->update('documents', $save);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('documents');
    }

    function delete_file_record($id) {
        $this->db->where('id', $id);
        $this->db->delete('rel_document_files');
    }

    
}