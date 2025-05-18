<?php

class PesananController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('role_id') != '2') {
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
        $data['pesanan'] = $this->model_invoices->tampil_data_pesanan_proses()->result();
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pesanan', $data);
        $this->load->view('templates_admin/footer');
    }
}
