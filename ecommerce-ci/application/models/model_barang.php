<?php

class Model_barang extends CI_Model
{

	public function tampil_data()
	{
		// Mengambil data dari tb_barang dan menggabungkan dengan tb_kategori berdasarkan id kategori
		$this->db->select('tb_barang.*, tb_kategori.nama AS nama_kategori');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'tb_barang.kategori = tb_kategori.id'); // pastikan tb_barang.kategori merujuk pada id kategori
		return $this->db->get();
	}


	public function get_kategori()
	{
		return $this->db->get('tb_kategori')->result(); // Assuming you have a table called tb_kategori
	}
	public function get_barang()
	{
		return $this->db->get('tb_barang');
	}

	public function tambah_barang($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function edit_barang($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function hapus_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function find($id)
	{
		$result = $this->db->where('id_brg', $id)
			->limit(1)
			->get('tb_barang');
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return array();
		}
	}

	public function detail_brg($id_brg)
	{
		$result = $this->db->where('id_brg', $id_brg)->get('tb_barang');
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return false;
		}
	}

	public function get_all()
	{
		$query = $this->db->get('tb_barang');
		return $query->result();
	}
}
