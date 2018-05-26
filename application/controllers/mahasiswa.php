<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class mahasiswa extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('mahasiswa_m');
        }

        public function index()
        {
            $config['base_url'] = site_url('mahasiswa/index');
            $config['total_rows'] = $this->db->count_all('mahasiswa');
            $config['per_page'] = "3";
            $config["uri_segment"] = 3;
            $choice = $config["total_rows"]/$config["per_page"];
            $config["num_links"] = floor($choice);

            //Pagination
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '«';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '»';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data['mahasiswalist'] = $this->mahasiswa_m->get_mahasiswa($config['per_page'], $data['page'], NULL);
            $data['pagination'] = $this->pagination->create_links();

            $this->load->view('mahasiswa_v', $data);
        }

        public function search()
        {
            $search = ($this->input->post('mahasiswa_name')) ? $this->input->post('mahasiswa_name') : "NIL";
            $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

            $config = array();
            $config['base_url'] = site_url("mahasiswa/search/$search");
            $config['total_rows'] = $this->mahasiswa_m->get_mahasiswa_count($search);
            $config['per_page'] = "5";
            $config["uri_segment"] = 4;
            $choice = $config["total_rows"]/$config["per_page"];
            $config["num_links"] = floor($choice);

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Prev';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data['mahasiswalist'] = $this->mahasiswa_m->get_mahasiswa($config['per_page'], $data['page'], $search);

            $data['pagination'] = $this->pagination->create_links();

            $this->load->view('mahasiswa_v', $data);
        }
    }
?>