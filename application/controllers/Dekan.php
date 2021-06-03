<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dekan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dekan/index', $data);
        $this->load->view('templates/footer');
    }

    public function pendataan_ta()
    {
        $data['title'] = 'Pendataan TA';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();


        $data['data'] = $this->db->query("SELECT pendataan_ta.id, pendataan_ta.nama, pendataan_ta.nim, pendataan_ta.departemen, pendataan_ta.program_studi, pendataan_ta.judul_ta, pendataan_ta.nama_dosbing1, pendataan_ta.nama_dosbing2, pendataan_ta.ket_ta, pendataan_ta.status_prodi, pendataan_ta.id_prodi  FROM pendataan_ta
        WHERE 
     pendataan_ta.status_prodi = '3'")->result();;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dekan/pendataan_ta', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/auth_footer');
    }

    public function detail_data($id)
    {
        $data['title'] = 'Detail Data TA';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $detail_data = $this->db->get_where('pendataan_ta', array('id' => $id))->row();
        $data['detail'] = $detail_data;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dekan/detail_ta', $data);
        $this->load->view('templates/footer');
    }
}
