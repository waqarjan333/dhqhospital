<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab_testModel extends CI_Model
{
	public function show()
	{
		$result = $this->db->SELECT('*')->FROM('tests')->get()->result();

		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}

	}

	public function insert($array)
	{
		$result = $this->db->insert('tests', $array);
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}