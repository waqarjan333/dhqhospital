<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends CI_Model
{
	public function show()
	{
		$result = $this->db->SELECT('a.id, a.f_name, a.l_name, a.user_name, a.contact, a.email, a.is_admin,a.user_nick, a.security_type, a.add_date, b.id as dept_id, b.user_id, c.dep_name')->FROM('user as a')
		->join('user_departments as b','a.id=b.user_id','INNER')
		->join('departments as c','c.id=b.dept_id','INNER')
		->where('a.is_deleted',0)->group_by('a.id')->get()->result();

		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}

	}

	public function addDep($data)
	{	

		$query = $this->db->insert('user_departments', $data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function editDep($data)
	{

		$query = $this->db->insert('user_departments', $data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function type()
	{
		$result = $this->db->select('*')->from('type')->get()->result();
		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function department()
	{
		$result = $this->db->select('*')->from('departments')->where(array('parent_id'=>0, 'is_deleted'=>0))->get()->result();
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
		$result = $this->db->insert('user', $array);
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