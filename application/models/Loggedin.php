<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loggedin extends CI_Model
{
	public function login($email, $password)
	{
		$this->db->where('user_name', $email);
		$this->db->where('password', md5($password));

		$query = $this->db->get('user');

		if($query->num_rows())
		{
			return $data=$query->row();
		}
		else
		{	
		$this->session->set_flashdata('msg','<div class="text-danger">Incorrect Password Or Email, Please try again!!!</div>');
			return false;
		}
	}

	public function login_code($code, $user_id, $name)
	{
	echo "login model";exit();
		$this->db->where('id', $user_id);
		$this->db->where('user_name', $name);
		$this->db->where('security_code', $code);

		$query = $this->db->get('user');

		if($query->num_rows())
		{
			return $data=$query->row();
		}
		else
		{	
			$this->session->set_flashdata('msg','<div class="text-danger">Incorrect Code, Please try again!!!</div>');
			return false;
		}
	}




}
