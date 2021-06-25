<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function index()
	{
		$page_data['message'] = '<label class="text-success"><h3 align="center">Welcome - '.$this->session->userdata('name').'</h3></label>';
		
		$page_data['page_name1'] = 'dashboard';
		$page_data['page_name'] = 'dashboard';

		$user_id = $this->session->userdata('user_id');
        $this->db->select('is_admin');
        $this->db->from('user');
        $this->db->where('id',$user_id);
        $exe = $this->db->get()->result_array();

		if($exe[0]['is_admin'] == 1)
		{
			$this->load->view('index',$page_data);
		}
		else
		{
			redirect('OPD/index');
		}
		
	}
}
