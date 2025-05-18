<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$data['barang'] = $this->model_barang->get_barang()->result();
		$data['kategori'] = $this->model_kategori->tampil_data()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data); // Kirim data kategori ke sidebar
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function invoice()
	{
		$data['invoice'] = $this->model_invoice->tampil_data()->result();
		$data['kategori'] = $this->model_kategori->tampil_data()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $data); // Kirim data kategori ke sidebar
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}
}
