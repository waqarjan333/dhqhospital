<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterModel extends CI_Model
{

	// public function showcar()
	// {
	// 	$result=$this->db->select('*')->from('car_type')->where('is_deleted',0)->get()->result();
	// 	if($result)
	// 		{
	// 			return $result;
	// 		}
	// 		else
	// 		{
	// 			return false;
	// 		}
	// }

	public function add($data)
	{
		$result=$this->db->insert('customers',$data);
		if($result)
			{
				return true;
			}
			else
			{
				return false;
			}
	}

	// public function delete($id)
	// {
	// 	$result = $this->db->delete('car_type',array('id'=>$id));
	// 	if($result)
	// 	{
	// 		return true;
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}

	// }

}
?>