<?php


require_once FCPATH . 'vendor/autoload.php';  // Make sure Composer autoloader is included
use Dompdf\Dompdf;

class Riwayat extends CI_Controller
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
        $data['invoice'] = $this->model_invoices->tampil_data_riwayat_admin();  // Mengambil data invoice
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/riwayat', $data);  // View pemesanan
        $this->load->view('templates_admin/footer');
    }

    public function detail($id_invoice)
    {
        $data['invoice'] = $this->model_invoices->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->model_invoices->ambil_id_pesanan($id_invoice);
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/detail_riwayat', $data);
        $this->load->view('templates_admin/footer');
    }

    public function riwayat_pdf()
    {
        // Get your data here (example data)
        $data['invoice'] = $this->model_invoices->tampil_data_riwayat_admin(); // Adjust as needed

        // Load your view to create the HTML content
        $html = $this->load->view('admin/riwayat_pdf', $data, true);


        // Initialize Dompdf
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass)
        $dompdf->render();

        // Output the generated PDF (force download)
        $dompdf->stream("riwayat.pdf", array("Attachment" => 0));
    }
}
