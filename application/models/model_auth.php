<?php

class Model_auth extends CI_Model
{

    public function cek_login($username)
    {
        // Cari pengguna berdasarkan username
        $this->db->where('username', $username);
        $result = $this->db->get('tb_user');

        // Kembalikan data pengguna jika ditemukan
        if ($result->num_rows() == 1) {
            return $result->row();
        } else {
            return false;
        }
    }
}
