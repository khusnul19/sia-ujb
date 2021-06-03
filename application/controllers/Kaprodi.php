<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kaprodi extends CI_Controller
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

        $data['nama_prodi'] = $this->db->get_where('user', ['name' =>
        $this->session->userdata('name')])->row_array();

        $data['data'] = $this->db->query("select status_prodi ='0' as status_prodi,COUNT(status_prodi ='0') as count from pendataan_ta")->result();


        $id_prodi = $_SESSION['id_prodi'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        if ($id_prodi == '1') {
            $this->load->view('kaprodi/index1', $data);
        } else if ($id_prodi == '2') {
            $this->load->view('kaprodi/index2', $data);
        } else if ($id_prodi == '3') {
            $this->load->view('kaprodi/index3', $data);
        } else if ($id_prodi == '4') {
            $this->load->view('kaprodi/index4', $data);
        } else if ($id_prodi == '5') {
            $this->load->view('kaprodi/index5', $data);
        } else if ($id_prodi == '6') {
            $this->load->view('kaprodi/index6', $data);
        } else if ($id_prodi == '7') {
            $this->load->view('kaprodi/index7', $data);
        } else if ($id_prodi == '8') {
            $this->load->view('kaprodi/index8', $data);
        } else if ($id_prodi == '9') {
            $this->load->view('kaprodi/index9', $data);
        } else if ($id_prodi == '10') {
            $this->load->view('kaprodi/index10', $data);
        } else if ($id_prodi == '11') {
            $this->load->view('kaprodi/index11', $data);
        } else if ($id_prodi == '12') {
            $this->load->view('kaprodi/index12', $data);
        } else if ($id_prodi == '13') {
            $this->load->view('kaprodi/index13', $data);
        } else if ($id_prodi == '14') {
            $this->load->view('kaprodi/index14', $data);
        } else if ($id_prodi == '15') {
            $this->load->view('kaprodi/index15', $data);
        } else if ($id_prodi == '16') {
            $this->load->view('kaprodi/index16', $data);
        }

        $this->load->view('templates/footer');
    }

    public function perlu_diproses()
    {
        $data['title'] = 'Perlu Di Proses';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();


        $data['data'] = $this->db->query("SELECT pendataan_ta.id, pendataan_ta.nama, pendataan_ta.nim, pendataan_ta.departemen, pendataan_ta.program_studi, pendataan_ta.judul_ta, pendataan_ta.nama_dosbing1, pendataan_ta.nama_dosbing2, pendataan_ta.ket_ta, pendataan_ta.status_prodi, pendataan_ta.id_prodi  FROM pendataan_ta
        WHERE 
     pendataan_ta.status_prodi = '0'")->result();;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kaprodi/perlu_diproses', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/auth_footer');
    }

    public function history_pendataan_ta()
    {
        $data['title'] = 'History';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        //$this->load->view('surat/header');
        $data['data'] = $this->db->get('pendataan_ta')->result();
        //$this->load->view('surat/footer');
        // //$this->load->view('surat/footer');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kaprodi/history_pendataan_ta', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/auth_footer');
    }

    public function data_disetujui()
    {
        $data['title'] = 'TA Disetujui';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();


        $data['data'] = $this->db->query("SELECT pendataan_ta.id, pendataan_ta.nama, pendataan_ta.nim, pendataan_ta.departemen, pendataan_ta.program_studi, pendataan_ta.judul_ta, pendataan_ta.nama_dosbing1, pendataan_ta.nama_dosbing2, pendataan_ta.ket_ta, pendataan_ta.status_prodi, pendataan_ta.id_prodi  FROM pendataan_ta
        WHERE 
     pendataan_ta.status_prodi = '3'")->result();;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kaprodi/data_disetujui', $data);
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
        $this->load->view('kaprodi/detail_ta', $data);
        $this->load->view('templates/footer');
    }

    public function setuju()

    {

        $cek = $this->uri->segment(3);

        $this->db->set('status_prodi', '3');
        $this->db->where('id', $cek);
        $query = $this->db->update('pendataan_ta');


        if ($query) {
            echo 'sukses';
            if ($cek != "") {
                redirect(base_url('Kaprodi/perlu_diproses'), 'refresh');
            } else {
                redirect(base_url('index'), 'refresh');
            }
        } else {
            echo 'Menyetujui gagal';
            redirect(base_url('index'), 'refresh');
        }
    }

    public function tolak($cek)

    {

        $cek = $this->uri->segment(3);

        $data = $this->db->query("SELECT pendataan_ta.id, pendataan_ta.nama, pendataan_ta.nim, pendataan_ta.departemen, pendataan_ta.program_studi, pendataan_ta.judul_ta, pendataan_ta.nama_dosbing1, pendataan_ta.nama_dosbing2, pendataan_ta.ket_ta, pendataan_ta.id_prodi  FROM pendataan_ta
        WHERE 
     pendataan_ta.id = $cek")->result();;


        $this->form_validation->set_rules('ket_tolak_prodi', 'ket_tolak_prodi', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kaprodi/perlu_diproses', $data);
            $this->load->view('templates/footer');
        } else {


            $data = [

                'ket_tolak_prodi' => $this->input->post('ket_tolak_prodi'),

            ];

            $this->db->set('status_prodi', '1');
            $this->db->where('id', $cek);
            $query = $this->db->update('pendataan_ta', $data);
        }


        if ($query) {
            echo 'sukses';
            if ($cek != "") {
                redirect(base_url('Kaprodi/perlu_diproses'), 'refresh');
            } else {
                redirect(base_url('index'), 'refresh');
            }
        } else {
            echo 'Menolak gagal';
            redirect(base_url('index'), 'refresh');
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil di tolak </div>');
        redirect('kaprodi/perlu_diproses');
    }

    public function delete_pendataan_ta($id = null)
    {
        if (!isset($id)) show_404();
        else {

            $image_path1 = './upload/data/';
            //$image_path2 = './upload/data/'; // your image path
            $_get_image = $this->db->get_where('pendataan_ta', array('id' => $id));

            foreach ($_get_image->result() as $record) {
                $filename = $image_path1 . $record->file_ta;
                $filename2 = $image_path1 . $record->luaran_ta;
                if (file_exists($filename)) {
                    delete_files($filename);
                    unlink($filename);
                }
                if (file_exists($filename2)) {
                    delete_files($filename2);
                    unlink($filename2);
                }
            }


            $this->db->delete('pendataan_ta', array("id" => $id));

            $data['title'] = 'Pendataan TA';
            $data['user'] = $this->db->get_where('user', ['username' =>
            $this->session->userdata('username')])->row_array();

            $data1['data'] = $this->db->query('select * from pendataan_ta')->result();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kaprodi/pendataan_ta', $data1);
            $this->load->view('templates/footer');
        }
    }
}
