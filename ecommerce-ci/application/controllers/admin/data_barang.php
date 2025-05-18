<?php

require_once FCPATH . 'vendor/autoload.php';  // Make sure Composer autoloader is included
use Dompdf\Dompdf;

class Data_barang extends CI_Controller
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
		$data['barang'] = $this->model_barang->tampil_data()->result();
		$data['kategori'] = $this->model_barang->get_kategori();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/data_barang', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_aksi()
{
    $nama_brg    = $this->input->post('nama_brg');
    $keterangan  = $this->input->post('keterangan');
    $kategori    = $this->input->post('kategori');
    $harga       = $this->input->post('harga');
    $stok        = $this->input->post('stok');
    $gambar      = $_FILES['gambar']['name'];

    if ($gambar) {
        // Buat nama file unik
        $uniq_name = uniqid() . '_' . str_replace(' ', '_', $gambar);

        // Konfigurasi upload
        $config['upload_path']   = './upload';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name']     = $uniq_name;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data('file_name'); // Ambil nama file yang berhasil diupload
        } else {
            echo "Gambar gagal diupload!";
            return;
        }
    } else {
        echo "Gambar tidak ditemukan!";
        return;
    }

    $data = array(
        'nama_brg'   => $nama_brg,
        'keterangan' => $keterangan,
        'kategori'   => $kategori,
        'harga'      => $harga,
        'stok'       => $stok,
        'gambar'     => $gambar
    );

    $this->model_barang->tambah_barang($data, 'tb_barang');
    redirect('admin/data_barang/index');
}
public function update()
{
    $id         = $this->input->post('id_brg');
    $nama_brg   = $this->input->post('nama_brg');
    $keterangan = $this->input->post('keterangan');
    $kategori   = $this->input->post('kategori');
    $harga      = $this->input->post('harga');
    $stok       = $this->input->post('stok');
    $gambar     = $_FILES['gambar']['name'];
    $gambar_lama = $this->input->post('gambar_lama'); // Nama gambar lama

    if ($gambar) {
        // Buat nama file unik
        $uniq_name = uniqid() . '_' . str_replace(' ', '_', $gambar);

        // Konfigurasi upload
        $config['upload_path']   = './upload';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name']     = $uniq_name;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data('file_name'); // Ambil nama file yang berhasil diupload
        } else {
            echo "Gambar gagal diupload!";
            return;
        }
    } else {
        $gambar = $gambar_lama; // Gunakan gambar lama jika tidak ada yang diunggah
    }

    $data = array(
        'nama_brg'   => $nama_brg,
        'keterangan' => $keterangan,
        'kategori'   => $kategori,
        'harga'      => $harga,
        'stok'       => $stok,
        'gambar'     => $gambar
    );

    $where = array('id_brg' => $id);

    $this->model_barang->update_data($where, $data, 'tb_barang');
    redirect('admin/data_barang/index');
}


	public function hapus($id)
	{
		$where	= array('id_brg' => $id);
		$this->model_barang->hapus_data($where, 'tb_barang');
		redirect('admin/data_barang/index');
	}

	public function detail($id_brg)
	{
		$data['barang'] = $this->model_barang->detail_brg($id_brg);
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/detail_barang', $data);
		$this->load->view('templates_admin/footer');
	}

	public function barang_pdf()
	{
		// Get your data here (example data)
		$data['barang'] = $this->model_barang->get_all(); // Adjust as needed

		// Load your view to create the HTML content
		$html = $this->load->view('admin/barang_pdf', $data, true);


		// Initialize Dompdf
		$dompdf = new Dompdf();

		// Load HTML content
		$dompdf->loadHtml($html);

		// (Optional) Set paper size
		$dompdf->setPaper('A4', 'portrait');

		// Render PDF (first pass)
		$dompdf->render();

		// Output the generated PDF (force download)
		$dompdf->stream("barang.pdf", array("Attachment" => 0));
	}
}
