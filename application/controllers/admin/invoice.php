<?php

require_once FCPATH . 'vendor/autoload.php';  // Make sure Composer autoloader is included
use Dompdf\Dompdf;
use Dompdf\Options;

class Invoice extends CI_Controller
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
		$data['invoice'] = $this->model_invoices->tampil_data_admin();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/invoice', $data);
		$this->load->view('templates_admin/footer');
	}

	public function detail($id_invoice)
	{
		$data['invoice'] = $this->model_invoices->ambil_id_invoice($id_invoice);
		$data['pesanan'] = $this->model_invoices->ambil_id_pesanan($id_invoice);
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/detail_invoice', $data);
		$this->load->view('templates_admin/footer');
	}


	public function invoice_pdf()
	{
		// Get your data here (example data)
		$data['invoice'] = $this->model_invoices->get_all(); // Adjust as needed

		// Load your view to create the HTML content
		$html = $this->load->view('admin/invoice_pdf', $data, true);


		// Initialize Dompdf
		$dompdf = new Dompdf();

		// Load HTML content
		$dompdf->loadHtml($html);

		// (Optional) Set paper size
		$dompdf->setPaper('A4', 'portrait');

		// Render PDF (first pass)
		$dompdf->render();

		// Output the generated PDF (force download)
		$dompdf->stream("invoice.pdf", array("Attachment" => 0));
	}

	public function konfirmasi_pesanan($invoice_id)
	{
		// Cek apakah invoice_id valid
		if (!empty($invoice_id)) {
			// Update status pada tb_pesanan
			$data_pesanan = array(
				'pilihan' => 1, // Status "Dikirim"
			);

			$this->db->where('id_invoice', $invoice_id);
			$this->db->update('tb_pesanan', $data_pesanan);

			// Update status pada tb_invoice
			$data_invoice = array(
				'status' => 1, // Status "Dikonfirmasi"
			);

			$this->db->where('id', $invoice_id);
			$this->db->update('tb_invoices', $data_invoice);

			// Menambahkan pesan flash atau pemberitahuan sukses
			$this->session->set_flashdata('pesan', 'Pesanan berhasil dikonfirmasi!');

			// Redirect kembali ke halaman daftar invoice
			redirect('admin/invoice/index');
		} else {
			// Jika ID tidak valid
			$this->session->set_flashdata('error', 'Invoice tidak ditemukan.');
			redirect('admin/invoice/index');
		}
	}

	public function kirimkan_pesanan($invoice_id)
	{
		// Cek apakah invoice_id valid
		if (!empty($invoice_id)) {
			// Update status pada tb_pesanan
			$data_pesanan = array(
				'pilihan' => 2, // Status "Dikirim"
			);

			$this->db->where('id_invoice', $invoice_id);
			$this->db->update('tb_pesanan', $data_pesanan);

			// Update status pada tb_invoice
			$data_invoice = array(
				'status' => 2, // Status "Dikonfirmasi"
			);

			$this->db->where('id', $invoice_id);
			$this->db->update('tb_invoices', $data_invoice);

			// Menambahkan pesan flash atau pemberitahuan sukses
			$this->session->set_flashdata('pesan', 'Pesanan berhasil dikonfirmasi!');

			// Redirect kembali ke halaman daftar invoice
			redirect('admin/invoice/index');
		} else {
			// Jika ID tidak valid
			$this->session->set_flashdata('error', 'Invoice tidak ditemukan.');
			redirect('admin/invoice/index');
		}
	}
}
