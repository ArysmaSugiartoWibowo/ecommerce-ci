<?php

class Riwayat extends CI_Controller
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
        $data['invoice'] = $this->model_invoices->tampil_data_riwayat();  // Mengambil data invoice
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('riwayat', $data);  // View pemesanan
        $this->load->view('templates/footer');
    }

    public function detail($id_invoice)
    {
        $data['invoice'] = $this->model_invoices->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->model_invoices->ambil_id_pesanan($id_invoice);
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('detail_riwayat', $data);
        $this->load->view('templates/footer');
    }
}
