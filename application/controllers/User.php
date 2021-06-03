<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dasbor';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function profil()
    {
        $data['title'] = 'My Profil';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/profil', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $uploaded = FALSE;
        $this->form_validation->set_rules('name', 'Full name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {

            /*$name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path']   = './upload/user';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }*/
            $username = $this->input->post('username');

            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['upload_path']   = './upload/user';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                /*$error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);*/
                //redirect('user/prestasi/', 'refresh');
            } else {
                $uploaded = TRUE;

                $image_path = './upload/user/'; // your image path
                $_get_image = $this->db->get_where('user', array('username' => $username));

                foreach ($_get_image->result() as $record) {
                    $filename = $image_path . $record->image;
                    if (file_exists($filename)) {
                        delete_files($filename);
                        unlink($filename);
                    }
                }

                $upload_data = $this->upload->data();
                $bukti = $upload_data['file_name'];
            }

            $data = [
                'username' => $username,
                'name' => $this->input->post('name')

            ];


            if ($uploaded) {

                $data = [
                    'username' => $username,
                    'name' => $this->input->post('name'),
                    'image' => $bukti
                ];
            }

            /*$this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');*/

            $this->db->where('username', $data['username']);
            $this->db->update('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    // PENDATAAN TA

    public function pendataan_ta()
    {
        $data['title'] = 'Pendataan TA';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['data'] = $this->db->get_where('pendataan_ta', ['nim' =>
        $this->session->userdata('nim')])->result();
        //$this->load->view('surat/header');
        /*$data['data'] = $this->db->get('pengajuan_lomba')->result();*/

        /*$data['data'] = $this->db->get_where('pengajuan_lomba', 'nim' => $nim)->row();*/
        //$this->load->view('surat/footer');
        // //$this->load->view('surat/footer');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pendataan_ta', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/auth_footer');
    }

    public function save_pendataan_ta()
    {
        $data['title'] = 'Pendataan TA';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $name = (string) $this->session->userdata('name');
        $nim = (string) $this->session->userdata('nim');

        $data['pendataan_ta'] = $this->db->get('pendataan_ta')->result_array();


        /*$this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'NIM', 'required');*/
        $this->form_validation->set_rules('departemen', 'Departemen', 'required');
        $this->form_validation->set_rules('program_studi', 'Program Studi', 'required');
        $this->form_validation->set_rules('judul_ta', 'Judul TA', 'required');
        $this->form_validation->set_rules('nama_dosbing1', 'Nama Dosbing 1', 'required');
        $this->form_validation->set_rules('nama_dosbing2', 'Nama Dosbing 2', 'required');
        $this->form_validation->set_rules('ket_ta', 'Keterangan TA', 'required');
        $this->form_validation->set_rules('jenis_luaran_ta', 'Jenis Luaran TA', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pendataan_ta', $data);
            $this->load->view('templates/footer');
        } else {
            $file1 = $_FILES["file1"];
            $file2 = $_FILES["file2"];
            if (($file1 = '') && ($file2 = '')) {
            } else {
                $config['upload_path']          = './upload/data';
                $config['allowed_types']        = 'docx|pdf';

                $this->load->library('upload', $config);
                /*if ((!$this->upload->do_upload('file1')) && (!$this->upload->do_upload('file2'))) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', $error['error']);*/
                //redirect('user/prestasi/', 'refresh');

                $this->upload->do_upload('file1');
                $file1 = $this->upload->data('file_name');

                $this->upload->do_upload('file2');
                $file2 = $this->upload->data('file_name');


                $data = [
                    'nama' => $name,
                    'nim' => $nim,
                    'departemen' => $this->input->post('departemen'),
                    'program_studi' => $this->input->post('program_studi'),
                    'judul_ta' => $this->input->post('judul_ta'),
                    'nama_dosbing1' => $this->input->post('nama_dosbing1'),
                    'nama_dosbing2' => $this->input->post('nama_dosbing2'),
                    'ket_ta' => $this->input->post('ket_ta'),
                    'jenis_luaran_ta' => $this->input->post('jenis_luaran_ta'),
                    'file_ta' => $file1,
                    'luaran_ta' => $file2
                ];

                switch ($data['program_studi']) {
                    case "D4-Rekayasa Perancangan Mekanik":
                        $data['id_prodi'] = '1';
                        break;
                    case "D4-Teknologi Rekayasa Kimia Industri":
                        $data['id_prodi'] = '2';
                        break;
                    case "D4-Teknologi Rekayasa Otomasi":
                        $data['id_prodi'] = '3';
                        break;
                    case "D4-Teknologi Rekayasa Konstruksi Perkapalan":
                        $data['id_prodi'] = '4';
                        break;
                    case "D4-Teknik Infrastruktur Sipil Dan Perancangan":
                        $data['id_prodi'] = '5';
                        break;
                    case "D4-Perencanaan Tata Ruang Dan Pertanahan":
                        $data['id_prodi'] = '6';
                        break;
                    case "D4-Teknik Listrik Industri":
                        $data['id_prodi'] = '7';
                        break;
                    case "D4-Manajemen Dan Administrasi":
                        $data['id_prodi'] = '8';
                        break;
                    case "D4-Informasi Dan Hubungan Masyarakat":
                        $data['id_prodi'] = '9';
                        break;
                    case "D4-Akuntansi Perpajakan":
                        $data['id_prodi'] = '10';
                        break;
                    case "D4-Bahasa Asing Terapan":
                        $data['id_prodi'] = '11';
                        break;
                    case "D3-Teknologi Perencanaan Wilayah Dan Kota":
                        $data['id_prodi'] = '12';
                        break;
                    case "D3-Hubungan Masyarakat":
                        $data['id_prodi'] = '13';
                        break;
                    case "D3-Akuntansi":
                        $data['id_prodi'] = '14';
                        break;
                    case "D3-Manajemen Perusahaan":
                        $data['id_prodi'] = '15';
                        break;
                    case "D3-Administrasi Pajak":
                        $data['id_prodi'] = '16';
                        break;
                }

                $this->db->insert('pendataan_ta', $data);
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Pendataan TA Berhasil ditambahkan </div>');
        redirect('user/pendataan_ta');
    }

    public function update_ta($id)
    {

        $data['title'] = 'Pendataan TA';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $uploaded = FALSE;
        $this->form_validation->set_rules('departemen', 'Departemen', 'required');
        $this->form_validation->set_rules('program_studi', 'Program Studi', 'required');
        $this->form_validation->set_rules('judul_ta', 'Judul TA', 'required');
        $this->form_validation->set_rules('nama_dosbing1', 'Nama Dosbing 1', 'required');
        $this->form_validation->set_rules('nama_dosbing2', 'Nama Dosbing 2', 'required');
        $this->form_validation->set_rules('ket_ta', 'Keterangan TA', 'required');
        $this->form_validation->set_rules('jenis_luaran_ta', 'Jenis Luaran TA', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pendataan_ta', $data);
            $this->load->view('templates/footer');
        } else {

            $file1 = $_FILES["file1"];
            $file2 = $_FILES["file2"];
            if (($file1 = '') && ($file2 = '')) {
            } else {
                $config['upload_path']          = './upload/data';
                $config['allowed_types']        = 'docx|pdf';

                $this->load->library('upload', $config);
                /*if ((!$this->upload->do_upload('file1')) && (!$this->upload->do_upload('file2'))) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', $error['error']);*/
                //redirect('user/prestasi/', 'refresh');

                $upload_path = './upload/data/';
                //$upload_path2 = './upload/data/'; // your image path
                $_get_image = $this->db->get_where('pendataan_ta', array('id' => $id));

                foreach ($_get_image->result() as $record) {
                    $filename = $upload_path . $record->file_ta;
                    $filename2 = $upload_path . $record->luaran_ta;
                    if (file_exists($filename)) {
                        delete_files($filename);
                        unlink($filename);
                    }
                    if (file_exists($filename2)) {
                        delete_files($filename2);
                        unlink($filename2);
                    }
                }

                $this->upload->do_upload('file1');
                $file1 = $this->upload->data('file_name');

                $this->upload->do_upload('file2');
                $file2 = $this->upload->data('file_name');
                $uploaded = TRUE;

                $data = [
                    'id' => $id,
                    'nama' => $this->input->post('nama'),
                    'nim' => $this->input->post('nim'),
                    'departemen' => $this->input->post('departemen'),
                    'program_studi' => $this->input->post('program_studi'),
                    'judul_ta' => $this->input->post('judul_ta'),
                    'nama_dosbing1' => $this->input->post('nama_dosbing1'),
                    'nama_dosbing2' => $this->input->post('nama_dosbing2'),
                    'ket_ta' => $this->input->post('ket_ta'),
                    'jenis_luaran_ta' => $this->input->post('jenis_luaran_ta'),

                ];

                if ($uploaded) {

                    $data = [
                        'id' => $id,
                        'nama' => $this->input->post('nama'),
                        'nim' => $this->input->post('nim'),
                        'departemen' => $this->input->post('departemen'),
                        'program_studi' => $this->input->post('program_studi'),
                        'judul_ta' => $this->input->post('judul_ta'),
                        'nama_dosbing1' => $this->input->post('nama_dosbing1'),
                        'nama_dosbing2' => $this->input->post('nama_dosbing2'),
                        'ket_ta' => $this->input->post('ket_ta'),
                        'jenis_luaran_ta' => $this->input->post('jenis_luaran_ta'),
                        'file_ta' => $file1,
                        'luaran_ta' => $file2

                    ];
                }
            }


            $this->db->where('id', $data['id']);
            $this->db->update('pendataan_ta', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data TA Berhasil di Edit </div>');
            redirect('user/pendataan_ta');
        }
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
            $this->load->view('user/pendataan_ta', $data1);
            $this->load->view('templates/footer');
        }
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
        $this->load->view('user/detail_ta', $data);
        $this->load->view('templates/footer');
    }
}
