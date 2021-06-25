<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OtModel extends CI_Model
{
	public function get_other_invoice($dept_id)
  	{
	    $year=date('y');
	    $exe="SELECT * FROM `other_entry` WHERE `id` !='' AND is_deleted=0 AND dept_id='$dept_id' AND yearly_no='$year'  ORDER BY `receptNumber` DESC LIMIT 1 ";
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

	public function get_dept_nick($idss)
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

	public function get_dept_by_id($id)
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

	public function insert_other($data)
	{
		$year=date('y');
		$exe="DELETE FROM other_entry WHERE receptNumber='$data[receptNumber]' AND dept_id='$data[dept_id]' AND yearly_no='$year'";
	 
	      $query=$this->db->query($exe);
	      if($query)
	      {
	         $query1=$this->db->insert('other_entry',$data);
	      	return $query1; 
	      }
	 
	}

	public function get_other_invoice_by_id($receptNumber,$yearly_no,$dept_id)
  	{
  		
	    $exe="SELECT ot.*,dis.name AS dis_name,dept.dept_nick,dept.dep_name, ot.sub_dept_id AS sub_dept_id, ot.dept_id AS dept_id
	    FROM other_entry AS ot 
	    LEFT JOIN districts AS dis ON (ot.address=dis.id) 
	    LEFT JOIN departments AS dept ON (ot.dept_id=dept.id) 
	    WHERE ot.receptNumber='$receptNumber' 
	    AND ot.dept_id='$dept_id' 
	    AND ot.yearly_no='$yearly_no'
	     AND ot.is_deleted=0";

	    $query=$this->db->query($exe);
	    return $query; 
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


}