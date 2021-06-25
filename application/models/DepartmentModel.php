<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentModel extends CI_Model
{
	public function show()
	{
		// $result = $this->db->SELECT('*')->FROM('departments as a')->join('departments as b','a.id=b.parent_id','INNER')->where('a.is_deleted',0)->get()->result();
		$result = $this->db->SELECT('*')->FROM('departments')->where(array('is_deleted'=>0,'parent_id'=>0))->get()->result();

		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}

	}

	public function getDepartment()
	{
		$result = $this->db->select('id,parent_id, dep_name')->from('departments')->where(array('is_deleted'=>0,'parent_id'=>0))->get()->result();
		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getSub($id)
	{

		$result = $this->db->select('*')->from('departments')->where(array('is_deleted'=>0,'parent_id'=>$id))->get()->result();
		
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
		$result = $this->db->insert('departments', $array);
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete($id)
	{
		$result = $this->db->delete('customers', array('id'=>$id));
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