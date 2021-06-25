<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TypeModel extends CI_Model
{
	public function show()
	{
		$result = $this->db->SELECT('a.*, b.dep_name, b.id as dp_id')->FROM('type as a')->join('departments as b','a.dep_id=b.id','INNER')->where('a.is_deleted',0)->get()->result();

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
		$result = $this->db->select('*')->from('departments')->where(array('is_deleted'=>0,'parent_id'=>0))->get()->result();
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
		$result = $this->db->insert('type', $array);
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
		$result = $this->db->delete('type', array('id'=>$id));
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