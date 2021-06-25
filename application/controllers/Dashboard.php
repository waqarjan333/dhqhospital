<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{

	public function __construct()
        {
            parent::__construct();
			//$this->load->model('');
        }

	public function index()
	{
    	
		$page_data['message'] = '<label class="text-success"><h3 align="center">Welcome - '.$this->session->userdata('name').'</h3></label>';
		
		$page_data['page_name1'] = 'dashboard';
		$page_data['page_name'] = 'dashboard';

		$is_admin = $this->session->userdata('is_admin');

		if($is_admin == 1)
		{
			$page_data['page_name'] = 'dashboard';
		}
		else
		{
			$page_data['page_name'] = 'user_dashboard';
		}
			$this->load->view('index',$page_data);
	}

}
	