<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('text');
    }
    public function index()
    {
        $data['title'] = 'Pendataan TA';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();


        $data['data'] = $this->db->query("SELECT pendataan_ta.id, pendataan_ta.nama, pendataan_ta.nim, pendataan_ta.departemen, pendataan_ta.program_studi, pendataan_ta.judul_ta, pendataan_ta.nama_dosbing1, pendataan_ta.nama_dosbing2, pendataan_ta.ket_ta, pendataan_ta.status_prodi, pendataan_ta.id_prodi  FROM pendataan_ta
        WHERE 
     pendataan_ta.status_prodi = '3'")->result();;

        $this->load->view('layout/v_head', $data);
        $this->load->view('layout/v_header', $data);
        $this->load->view('layout/v_nav', $data);
        $this->load->view('v_home', $data);
        $this->load->view('layout/v_footer');


        /*$this->load->view('layout/v_wrapper', $data, FALSE);*/
    }
}
