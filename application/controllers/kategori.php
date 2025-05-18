<?php

class Kategori extends CI_Controller
{
    public function kategoris()
    {
        $id_kategori = $this->input->get('id');
        $data['kategori'] = $this->model_kategori->tampil_data()->result();
        $data['ban_motor_baru'] = $this->model_kategori->data_ban_motor_baru($id_kategori)->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('list_kategori', $data);
        $this->load->view('templates/footer');
    }

   
}
