<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RegisterModel');
	}

	public function index()
	{
		$this->load->view('frontend/signup');	
	}

	public function add()
	{
		if(isset($_POST['save']))
		{
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$uname = $this->input->post('uname');
			$cnic = $this->input->post('cnic');
			$password = $this->input->post('password');
			//$repassword = $this->input->post('repassword');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$city = $this->input->post('city');
			$address = $this->input->post('address');
			$date = date('y-m-d');

			$data = array(

				'f_name'=>$fname,
				'l_name'=>$lname,
				'uname'=>$uname,
				'password'=>$password,
				'ucnic'=>$cnic,
				'uphone'=>$phone,
				'uemail'=>$email,
				'city'=>$city,
				'address'=>$address,
				'add_date'=>$date

			);

			$model = $this->RegisterModel->add($data);

			if($model)
			{
				$this->session->set_flashdata('message', 'Registered Successfully');
				redirect('WebLogin/');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Registered');
				redirect('Register/');
			}
		}
	}
}