<?php

class Invoice extends CI_Controller
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
        $data['invoice'] = $this->model_invoices->tampil_data_pesanan()->result();
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('invoice', $data);
        $this->load->view('templates/footer');
    }
    public function proses()
    {
        $data['invoice'] = $this->model_invoices->tampil_data_pesanan_proses()->result();
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('proses', $data);
        $this->load->view('templates/footer');
    }


    public function update_status($id, $status)
    {
        // Memperbarui status invoice dengan id yang diberikan
        $this->model_invoices->update_status($id, $status);

        // Setelah update, kembali ke halaman index
        redirect('pemesanan');
    }
}
