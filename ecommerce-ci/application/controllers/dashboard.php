<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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



	public function tambah_keranjang($id)
	{
		$barang 	= $this->model_barang->find($id);

		$data = array(
			'id'      => $barang->id_brg,
			'qty'     => 1,
			'price'   => $barang->harga,
			'name'    => $barang->nama_brg

		);

		$this->cart->insert($data);
		redirect('welcome');
	}

	public function detail_keranjang()
	{
		$data['kategori'] = $this->model_kategori->tampil_data()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data); // Kirim data kategori ke sidebar
		$this->load->view('keranjang');
		$this->load->view('templates/footer');
	}

	public function hapus_keranjang()
	{
		$this->cart->destroy();
		redirect('welcome');
	}

	public function pembayaran()
	{
		$data['kategori'] = $this->model_kategori->tampil_data()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data); // Kirim data kategori ke sidebar
		$this->load->view('pembayaran');
		$this->load->view('templates/footer');
	}

	public function get_ongkir($destination_city_id, $courier_code)
	{
		// URL API RajaOngkir
		$url = 'https://api.rajaongkir.com/starter/cost';

		// API Key (Ganti dengan API Key Anda)
		$api_key = 'YOUR_RAJAOONGKIR_API_KEY';

		// Inisialisasi cURL
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => [
				'origin' => 501, // ID kota asal (misalnya Jakarta)
				'destination' => $destination_city_id, // ID kota tujuan
				'weight' => 1000, // Berat dalam gram (contoh: 1000g = 1kg)
				'courier' => $courier_code // Kode jasa pengiriman (jne, jnt, dll.)
			],
			CURLOPT_HTTPHEADER => [
				"key: $api_key"
			]
		]);

		// Eksekusi cURL dan ambil responsenya
		$response = curl_exec($curl);
		curl_close($curl);

		$data = json_decode($response, true);
		return $data;
	}

	// Fungsi untuk memproses pesanan
	public function proses_pesanan()
	{
		// Mengambil data keranjang
		$data['kategori'] = $this->model_kategori->tampil_data()->result();
		$keranjang = $this->cart->contents();
		if ($keranjang) {
			// Mengambil data dari form
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$no_tlp = $this->input->post('no_tlp');
			$courier = $this->input->post('courier'); // Jasa pengiriman dari form
			$destination_city_id = $this->input->post('city_id'); // ID kota tujuan dari form

			// Mendapatkan ongkir dari API RajaOngkir
			$shipping_cost = $this->get_ongkir($destination_city_id, $courier);

			// Mengambil hasil ongkir dari API
			if ($shipping_cost && isset($shipping_cost['rajaongkir']['results'])) {
				$shipping_details = $shipping_cost['rajaongkir']['results'][0]['costs'];
				$shipping_info = $shipping_details[0]; // Mengambil opsi ongkir pertama
				$shipping_price = $shipping_info['cost'][0]['value']; // Ongkir yang dipilih
			} else {
				$shipping_price = 0; // Jika tidak ada hasil ongkir
			}

			// Memproses pesanan dan menyimpan ke database
			$is_processed = $this->model_invoices->index($nama, $alamat, $no_tlp, $shipping_price);

			if ($is_processed) {
				$this->cart->destroy(); // Mengosongkan keranjang setelah pesanan diproses
				$this->load->view('templates/header');
				$this->load->view('templates/sidebar', $data); // Kirim data kategori ke sidebar
				$this->load->view('proses_pesanan', ['shipping_cost' => $shipping_price]); // Menampilkan ongkir di view
				$this->load->view('templates/footer');
			} else {
				echo "Maaf, Pesanan Anda Gagal diproses!";
			}
		} else {
			echo "<h4>Keranjang Belanja Anda Masih Kosong</h4>";
		}
	}

	public function detail($id_brg)
	{
		$data['barang'] = $this->model_barang->detail_brg($id_brg);
		$data['kategori'] = $this->model_kategori->tampil_data()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('detail_barang', $data);
		$this->load->view('templates/footer');
	}
}
