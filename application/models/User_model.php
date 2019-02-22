<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{
	public function get_user($id = null)
	{
        if ($id === null) {
            return $this->db->get('user')->result_array();
        }
		else {
            return $this->db->get_where('user',['id_user' => $id])->result_array();
        }
    }
    
}
