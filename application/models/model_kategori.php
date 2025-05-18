<?php

class Model_kategori extends CI_Model {

    public function tampil_data()
    {
        return $this->db->get( 'tb_kategori' );
    }

    public function tambah_kategori( $data, $table )
    {
        $this->db->insert( $table, $data );
    }

    public function edit_kategori( $where, $table )
    {
        return $this->db->get_where( $table, $where );
    }

    public function update_data( $where, $data, $table )
    {
        $this->db->where( $where );
        $this->db->update( $table, $data );
    }

    public function hapus_data( $where, $table )
    {
        $this->db->where( $where );
        $this->db->delete( $table );
    }

    public function find( $id )
    {
        $result = $this->db->where( 'id', $id )
        ->limit( 1 )
        ->get( 'tb_kategori' );
        if ( $result->num_rows() > 0 ) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function data_ban_motor_baru( $id_kategori )
    {
        return $this->db->get_where( 'tb_barang', array( 'kategori' => $id_kategori ) );
    }

    public function data_ban_motor_bekas()
    {
        return $this->db->get_where( 'tb_barang', array( 'kategori' => 'ban motor bekas' ) );
    }

    public function data_ban_mobil_baru()
    {
        return $this->db->get_where( 'tb_barang', array( 'kategori' => 'ban mobil baru' ) );
    }

    public function data_ban_mobil_bekas()
    {
        return $this->db->get_where( 'tb_barang', array( 'kategori' => 'ban mobil bekas' ) );
    }

    public function data_ban_sepeda()
    {
        return $this->db->get_where( 'tb_barang', array( 'kategori' => 'ban sepeda' ) );
    }

    public function data_other()
    {
        $excluded_categories = [ 'ban motor bekas', 'ban motor baru', 'ban mobil bekas', 'ban mobil baru', 'ban sepeda' ];
        // Kategori yang ingin dikecualikan
        $this->db->where_not_in( 'kategori', $excluded_categories );
        // Filter kategori selain yang disebutkan
        return $this->db->get( 'tb_barang' );
        // Ambil data dari tabel tb_barang
    }
}
