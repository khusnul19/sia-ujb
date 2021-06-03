<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->query('select id as id,COUNT(id) as count from user')->result();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    //ROLE

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role Berhasil Ditambahkan!</div>');
            redirect('admin/role');
        }
    }




    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    //USERRRRRRRR

    public function data_user()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->query('select user.id as id, user.name as name, user.nim as nim, user.username as username, user.image as image, user_role.role as role from user , user_role where user.role_id=user_role.id')->result();

        $data['role_id'] = $this->db->query('select * from user_role')->result();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/auth_footer');
    }

    public function save_user()
    {

        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->query('select user.id as id, user.name as name, user.nim as nim, user.username as username, user.image as image, user_role.role as role from user , user_role where user.role_id=user_role.id')->result();

        $data['role_id'] = $this->db->query('select * from user_role')->result();

        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('role_id', 'Role ID', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/data_user', $data);
            $this->load->view('templates/footer');
        } else {
            $image = $_FILES["image"];
            if ($image = '') {
            } else {
                $config['upload_path']          = './upload/user';
                $config['allowed_types']        = 'jpg|jpeg|png|gif';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', $error['error']);
                    //redirect('user/prestasi/', 'refresh');
                } else {
                    $image = $this->upload->data('file_name');

                    $data = [
                        'name' => $this->input->post('name'),
                        'nim' => $this->input->post('nim'),
                        'username' => $this->input->post('username'),
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'role_id' => $this->input->post('role_id'),
                        'image' => $this->upload->data('file_name'),
                        'is_active' => 1,
                        'date_created' => time()
                    ];
                    $this->db->insert('user', $data);
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> User Berhasil ditambahkan </div>');
            redirect('admin/data_user');
        }
    }

    public function delete_user($id = null)
    {
        if (!isset($id)) show_404();
        else {


            $image_path = './upload/user/'; // your image path
            $_get_image = $this->db->get_where('user', array('id' => $id));

            foreach ($_get_image->result() as $record) {
                $filename = $image_path . $record->image;
                if (file_exists($filename)) {
                    delete_files($filename);
                    unlink($filename);
                }
            }

            $this->db->delete('user', array("id" => $id));

            $data['title'] = 'Data User';
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

            $data['role'] = $this->db->query('select user.id as id, user.name as name, user.nim as nim, user.username as username, user.image as image, user_role.role as role from user , user_role where user.role_id=user_role.id')->result();

            $data['role_id'] = $this->db->query('select * from user_role')->result();;


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/data_user', $data);
            $this->load->view('templates/footer');
        }
    }

    public function update_user($id)
    {

        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->query('select user.id as id, user.name as name, user.nim as nim, user.username as username, user.image as image, user_role.role as role from user , user_role where user.role_id=user_role.id')->result();

        $data['role_id'] = $this->db->query('select * from user_role')->result();

        $uploaded = FALSE;
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('role_id', 'Role ID', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/data_user', $data);
            $this->load->view('templates/footer');
        } else {

            $config['upload_path']          = './upload/user';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                /*$error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);*/
                //redirect('user/prestasi/', 'refresh');
            } else {
                $uploaded = TRUE;

                $image_path = './upload/user/'; // your image path
                $_get_image = $this->db->get_where('user', array('id' => $id));

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
                'id' => $id,
                'name' => $this->input->post('name'),
                'nim' => $this->input->post('nim'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id'),
                'is_active' => 1,
                'date_created' => time()
            ];

            if ($uploaded) {

                $data = [
                    'id' => $id,
                    'name' => $this->input->post('name'),
                    'nim' => $this->input->post('nim'),
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role_id' => $this->input->post('role_id'),
                    'is_active' => 1,
                    'date_created' => time(),
                    'image' => $bukti

                ];
            }

            $this->db->where('id', $data['id']);
            $this->db->update('user', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data User Berhasil di Edit </div>');
        redirect('admin/data_user');
    }
}
