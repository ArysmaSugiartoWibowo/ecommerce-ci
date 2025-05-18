<?php

class MY_Controller extends CI_Controller
 {
    public $data = [];

    public function __construct()
 {
        parent::__construct();
        $this->load->model( 'Kategori_model' );
        $this->data[ 'kategori' ] = $this->Kategori_model->get_all_kategori();
    }
}
