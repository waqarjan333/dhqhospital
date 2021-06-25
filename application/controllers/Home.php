<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('HondaCityModel');
	}
	
	public function index()
	{
		//$page_data['message'] = '<label class="text-success"><h3 align="center">Welcome - '.$this->session->userdata('email').'</h3></label>';

		$page_data['detail'] =$this->HondaCityModel->showcar();
		$page_data['slider'] = $this->HondaCityModel->Slider();
		
		$this->load->view('frontend/index',$page_data);
		
	}
}
