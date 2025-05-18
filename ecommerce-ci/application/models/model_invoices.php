<?php

class Model_invoices extends CI_Model
{
	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		$nama	= $this->input->post('nama');
		$alamat	= $this->input->post('alamat');

		$invoice = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'tgl_pesan' => date('Y-m-d H:i:s'),
			'batas_bayar' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y')))
		);

		$this->db->insert('tb_invoices', $invoice);
		$id_invoice = $this->db->insert_id();

		foreach ($this->cart->contents() as $item) {
			$data = array(
				'id_invoice'	=> $id_invoice,
				'id_brg'		=> $item['id'],
				'nama_brg'		=> $item['name'],
				'jumlah'		=> $item['qty'],
				'harga'			=> $item['price']
			);
			$this->db->insert('tb_pesanan', $data);
		}

		return TRUE;
	}

	public function tampil_data()
	{
		// Ambil username dari session
		$username = $this->session->userdata('username');

		// Filter data berdasarkan nama dan status 0 atau 1
		$this->db->where('nama', $username);  // Hanya ambil data yang memiliki nama yang sama dengan username
		$this->db->where_not_in('status', [3, 4]);  // Filter berdasarkan status 0 atau 1

		$result = $this->db->get('tb_invoices');

		if ($result->num_rows() > 0) {
			return $result->result();  // Kembalikan hasil jika data ditemukan
		} else {
			return false;  // Kembalikan false jika tidak ada data yang ditemukan
		}
	}
	public function tampil_data_admin()
	{
		// Filter hanya untuk status 0 atau 1
		$this->db->where_not_in('status', [3, 4]);
	
		// Ambil data dari tabel 'tb_invoices'
		$query = $this->db->get('tb_invoices');
	
		// Jika ada hasil, kembalikan hasil query
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	
		// Kembalikan false jika tidak ada data yang ditemukan
		return false;
	}
	

	public function tampil_data_riwayat_admin()
{
    // Filter untuk status 4 atau 3
    $this->db->where_in('status', [4, 3]);

    $result = $this->db->get('tb_invoices');
    if ($result->num_rows() > 0) {
        return $result->result();
    } else {
        return false;
    }
}


	public function tampil_data_riwayat()
	{
		// Ambil username dari session
		$username = $this->session->userdata('username');

		// Filter data berdasarkan nama dan status 0 atau 1
		$this->db->where('nama', $username);  // Hanya ambil data yang memiliki nama yang sama dengan username
		$this->db->where_in('status', [4, 3]); // Filter berdasarkan status 0 atau 1

		$result = $this->db->get('tb_invoices');

		if ($result->num_rows() > 0) {
			return $result->result();  // Kembalikan hasil jika data ditemukan
		} else {
			return false;  // Kembalikan false jika tidak ada data yang ditemukan
		}
	}


	public function get_all()
	{
		$query = $this->db->get('tb_invoices'); // Ambil data dari tabel tb_invoice
		return $query->result();
	}

	public function ambil_id_invoice($id_invoice)
	{
		$result = $this->db->where('id', $id_invoice)->limit(1)->get('tb_invoices');
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return null; // Lebih baik mengembalikan null untuk data tunggal
		}
	}

	public function ambil_id_pesanan($id_invoice)
	{
		$result = $this->db->where('id_invoice', $id_invoice)->get('tb_pesanan');
		if ($result->num_rows() > 0) {
			return $result->result(); // Mengembalikan array objek
		} else {
			return []; // Kembalikan array kosong untuk mencegah error
		}
	}


	public function tampil_data_pesanan()
	{
		return $this->db->get('tb_pesanan');
	}
	public function tampil_data_pesanan_proses()
	{
		return $this->db->where_in('pilihan', [0, 1])->get('tb_pesanan');
	}

	public function tampil_data_pesanan_selesai()
	{
		return $this->db->where_in('pilihan', [2, 3])->get('tb_pesanan');
	}


	public function update_status($id, $status)
	{
		// Memperbarui status berdasarkan id invoice
		$data = array(
			'pilihan' => $status
		);

		// Melakukan update pada tabel invoice
		$this->db->where('id', $id);
		$this->db->update('tb_pesanan', $data);
	}
}
