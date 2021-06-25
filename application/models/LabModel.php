<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LabModel extends CI_Model
{
	public function get_lab_invoice($dept_id)
  	{
	    $year = date('y');
	    $exe="SELECT * FROM `lab_entry` WHERE `id` !='' AND is_deleted=0 AND dept_id='$dept_id' AND yearly_no='$year'  ORDER BY `receptNumber` DESC LIMIT 1 ";
	    $query=$this->db->query($exe);
	    return $query;
  	}
  	public function get_districts()
	{
		$result = $this->db->select('*')->from('districts')->get()->result();
		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}
	public function get_tests()
	{
		$result = $this->db->select('*')->from('testcategories')->where('parent_id',0)->get()->result();
		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

		public function get_tests_by_id($test_id)
	{
		$result = $this->db->select('*')->from('testcategories')
		->where('id',$test_id)
		->get()->result_array();
		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}
	
  	public function get_nick($dept_id)
	{
	    $result = $this->db->select('dept_nick')->from('departments')->where(array('is_deleted'=>0,'id'=>$dept_id))->get()->result_array();
		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function get_dep_nick($idss)
	{
	    $result = $this->db->select('dept_nick')->from('departments')->where(array('is_deleted'=>0,'id'=>$idss))->get()->result_array();
		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function insert_lab($data)
	{
		$this->db->insert('lab_entry',$data);
		
	}

	public function insert_lab_details($data)
	{

		$this->db->insert('lab_entry_details',$data);
	}

	public function get_lab_invoice_by_id($receptNumber,$yearly_no,$dept_id)
  	{

	    $exe="SELECT lab.*, dis.name AS dis_name,dept.dept_nick,dept.dep_name 
	    FROM lab_entry AS lab 
	    LEFT JOIN districts AS dis ON (lab.address=dis.id) 
	    LEFT JOIN departments AS dept ON (lab.dept_id=dept.id) 
	    WHERE lab.receptNumber='$receptNumber' AND lab.is_deleted=0 AND lab.dept_id='$dept_id' AND yearly_no='$yearly_no'";
	    $query=$this->db->query($exe);
	    return $query; 
  	}

  	

}