<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class XRAYtypeModel extends CI_Model
{
	public function show()
	{
		$result = $this->db->SELECT('*')->FROM('xray_type')->get()->result();

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
		$result = $this->db->insert('xray_type', $array);
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