<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class XrayModel extends CI_Model
{
	public function get_xray_invoice($dept_id)
  	{
	    $year=date('y');
	    $exe="SELECT * FROM `xray_entry` WHERE `id` !='' AND is_deleted=0 AND dept_id='$dept_id' AND yearly_no='$year'  ORDER BY `receptNumber` DESC LIMIT 1 ";
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
	public function get_xray_types()
	{
		$result = $this->db->select('*')->from('xray_type')->get()->result();
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
	public function insert_xray($data)
	{
		
		$this->db->insert('xray_entry',$data);
	}
	public function insert_xray_details($data)
	{

		$this->db->insert('xray_entry_details',$data);

			 
	}
	public function get_xray_invoice_by_id($receptNumber,$yearly_no,$dept_id)
  	{
  	   

	    $exe="SELECT xray.*, dis.name AS dis_name,dept.dept_nick,dept.dep_name 
	    FROM xray_entry AS xray 
	    LEFT JOIN districts AS dis ON (xray.address=dis.id) 
	    LEFT JOIN departments AS dept ON (xray.dept_id=dept.id)
	    WHERE xray.receptNumber='$receptNumber' AND yearly_no='$yearly_no' AND xray.is_deleted=0 AND xray.dept_id='$dept_id'";
	    $query=$this->db->query($exe);
	    return $query; 
  	}

  	public function update_xray($data)
  	{ 		
  	$this->db->where('receptNumber', $data['receptNumber']);
  	$this->db->where('yearly_no', $data['yearly_no']);
	$this->db->update('xray_entry', $data);
  	}


}