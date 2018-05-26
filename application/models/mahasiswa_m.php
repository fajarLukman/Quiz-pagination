<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class mahasiswa_m extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        public function get_mahasiswa($limit, $start, $st = NULL)
        {
            if($st == "NIL") $st = "";
            $sql = "SELECT * FROM mahasiswa WHERE nama LIKE '%$st%' LIMIT ".$start.", ".$limit;
            $query = $this->db->query($sql);
            return $query->result();
        }

        public function get_mahasiswa_count($st = NULL)
        {
            if($st == "NIL") $st = "";
            $sql = "SELECT * FROM mahasiswa WHERE nama LIKE '%$st%'";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }
    }
?>