<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {
    public function get_table_headers() {
        $table_name = 'student_info'; 

        $query = $this->db->query("SHOW COLUMNS FROM $table_name")->result_array();

        $headers = array();
        foreach ($query as $column) {
            $headers[] = $column['Field'];
        }

        return $headers;
    }
    public function getRowCount($limit) {
        $query = $this->db->get('student_info');
        $no_of_students = $query->num_rows();
    
        if ($no_of_students % $limit == 0) {
            return $no_of_students / $limit;
        } else {
            return floor($no_of_students / $limit) + 1;
        }
    }

    public function get_table_data($limit, $offset) {
        $query = $this->db->limit($limit, $offset)->get('student_info');

        if ($query) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}