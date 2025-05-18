<?php

class kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('role_id') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  Anda Belum Login!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/kategori', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_aksi()
    {
        $nama    = $this->input->post('nama');
        $kode = $this->input->post('kode');

        $data = array(
            'nama'    => $nama,
            'kode' => $kode,
        );

        $this->model_kategori->tambah_kategori($data, 'tb_kategori');
        redirect('admin/kategori/index');
    }


    public function edit($id)
    {
        $where    = array('id' => $id);
        $data['kategori'] = $this->model_kategori->edit_kategori($where, 'tb_kategori')->result();

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/edit_kategori', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update()
    {
        $id         = $this->input->post('id');
        $nama       = $this->input->post('nama');
        $kode       = $this->input->post('kode');

        $data     = array(
            'nama'    => $nama,
            'kode' => $kode,
        );

        $where     = array(
            'id' => $id
        );

        $this->model_kategori->update_data($where, $data, 'tb_kategori');
        redirect('admin/kategori/index');
    }

    public function hapus($id)
    {
        $where    = array('id' => $id);
        $this->model_kategori->hapus_data($where, 'tb_kategori');
        redirect('admin/kategori/index');
    }
}
