<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DistrictModel extends CI_Model
{
	public function show()
	{
		$result = $this->db->SELECT('*')->FROM('districts')->get()->result();

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
		$result = $this->db->insert('districts', $array);
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