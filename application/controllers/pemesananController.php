<?php

class PemesananController extends CI_Controller
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
        $data['invoice'] = $this->model_invoices->tampil_data();  // Mengambil data invoice
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pemesanan', $data);  // View pemesanan
        $this->load->view('templates/footer');
    }

    // Fungsi untuk membatalkan pesanan
    public function batalkan($id_invoice)
    {
        // Perbarui status di tb_invoices menjadi 3 (Dibatalkan)
        $data_invoice = array(
            'status' => 3,  // Status Dibatalkan
        );
        $this->db->where('id', $id_invoice);
        $this->db->update('tb_invoices', $data_invoice);

        // Perbarui status di tb_pesanan yang memiliki id_invoice yang sama menjadi 3 (Dibatalkan)
        $data_pesanan = array(
            'pilihan' => 3,  // Status Dibatalkan
        );
        $this->db->where('id_invoice', $id_invoice);
        $this->db->update('tb_pesanan', $data_pesanan);

        // Set pesan sukses
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pesanan berhasil dibatalkan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');

        // Redirect kembali ke halaman pemesanan
        redirect('pemesanan');
    }



    public function detail($id_invoice)
    {
        $data['invoice'] = $this->model_invoices->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->model_invoices->ambil_id_pesanan($id_invoice);
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pesanan', $data);
        $this->load->view('templates/footer');
    }

    public function diterima($id_invoice)
    {
        // Pastikan id_invoice valid
        if (!empty($id_invoice)) {
            // Update status di tb_invoices menjadi 2 (Diterima)
            $data_invoice = array(
                'status' => 4 // Status "Diterima"
            );
            $this->db->where('id', $id_invoice);
            $this->db->update('tb_invoices', $data_invoice);

            // Update status di tb_pesanan menjadi 2 (Diterima) untuk id_invoice yang sama
            $data_pesanan = array(
                'pilihan' => 4 // Status "Diterima"
            );
            $this->db->where('id_invoice', $id_invoice);
            $this->db->update('tb_pesanan', $data_pesanan);

            // Tambahkan pesan sukses
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Pesanan telah diterima.</div>');

            // Redirect kembali ke halaman pemesanan
            redirect('pemesanan');
        } else {
            // Jika id_invoice tidak valid, tampilkan error
            $this->session->set_flashdata('error', '<div class="alert alert-danger">ID Invoice tidak ditemukan.</div>');
            redirect('pemesanan');
        }
    }
}
