<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends REST_Controller {

    // funtion yang construct untuk pertama kali dijalankan
    public function __construct()
    {
        parent::__construct();

        // load model yang digunakan
        $this->load->model('user_model');

        // aturan limit untuk berapa kali dapat diakses 
        $this->methods['index_get']['limit'] = 10;
    }

    // funtion untuk ke API ini dengan method request get 
	public function index_get()
    {
        // variabel untuk pengambilan parameter id pada client
        $id_user = $this->get('id_user');

        // pengecekan apakah ada parameter id pada request URL
        if ($id_user === null) {
            // mengambil seluruh data pada database
            $users = $this->user_model->get_user();
        }
        else {
            // mengambil seluruh data pada database
            $users = $this->user_model->get_user($id_user);
        }

        // jika proses berhasil dan kembalikan data berupa json
        if ($users) {
            $this->response([
                    'status' => TRUE,
                    'data' => $users
            ], REST_Controller::HTTP_OK);
        }
        else {
            $this->response([
                    'status' => FALSE,
                    'message' => 'id users were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
