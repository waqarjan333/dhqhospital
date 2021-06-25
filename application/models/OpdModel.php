<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpdModel extends CI_Model
{
	public function get_opd_invoice($dept_id)
  	{
	 	$year=date('y');   
	    $exe="SELECT * FROM `opd_entry` WHERE `id` !='' AND dept_id='$dept_id' AND is_deleted=0 AND yearly_no='$year' ORDER BY `receptNumber` DESC LIMIT 1 ";
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

	public function get_dep_nick($dept_id)
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

	public function insert_opd($data)
	{
		$exe="DELETE FROM opd_entry WHERE receptNumber='$data[receptNumber]' AND dept_id='$data[dept_id]' AND yearly_no='$data[yearly_no]' ";
	 
	      $query=$this->db->query($exe);
	      if($query)
	      {
	         $query1=$this->db->insert('opd_entry',$data);
	      	 return $query1; 
	      }
	 
	}

	public function get_opd_invoice_by_id($receptNumber,$yearly_no,$dept_id)
  	{
	    $exe="SELECT opd.*, dis.name AS dis_name FROM opd_entry AS opd LEFT JOIN districts AS dis ON (opd.address=dis.id) WHERE opd.receptNumber='$receptNumber' AND opd.dept_id='$dept_id' AND opd.yearly_no='$yearly_no' AND opd.is_deleted=0";
	    $query=$this->db->query($exe);
	    return $query; 
  	}

}