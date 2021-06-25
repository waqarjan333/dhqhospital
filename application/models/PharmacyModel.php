<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PharmacyModel extends CI_Model
{

	public function get_patient_indent_invoice()
  	{
	    
	    $exe="SELECT * FROM `patient_indent_invoice` WHERE `invoice_id` !='' AND `type`='1' ORDER BY `receptNumber` DESC LIMIT 1 ";
	    $query=$this->db->query($exe);

	    return $query;
  	}
	public function save_invoice($data,$item_name,$item_qty,$item_batch,$item_expiry,$item_comment,$date)
	{

		   $query=$this->db->insert('patient_indent_invoice',$data);
		 $inv_id=$this->db->insert_id();

		for($i=0;$i<count($item_name);$i++){

			 $det="INSERT INTO patient_invoice_detail SET
				`inv_id`=".$inv_id.",
				`item_id`='".$item_name[$i]."',
				`qty`='".$item_qty[$i]."',
				`batch_no`='".$item_batch[$i]."',
                `expiry`='".$item_expiry[$i]."',
				`comment`='".$item_comment[$i]."',
				`date`='".$date."'
				"; 

				$run=$this->db->query($det);

		}

		if($run)
		{
			echo $inv_id;
		}
	}

	public function update_patient_invoice($data,$item_name,$item_qty,$item_batch,$item_expiry,$item_comment,$id,$date)
	{
		$exe="DELETE FROM patient_indent_invoice where invoice_id='$id'";
 	$query=$this->db->query($exe);
 	if($query)
 	{
 	$query=$this->db->insert('patient_indent_invoice',$data);
		 $inv_id=$this->db->insert_id();	
 	}

 	  	$exe1="DELETE FROM patient_invoice_detail where inv_id='$id'";
 	$query1=$this->db->query($exe1);
 	if($query1)
 	{
 		for($i=0;$i<count($item_name);$i++){

			 $det="INSERT INTO patient_invoice_detail SET
				`inv_id`=".$inv_id.",
				`item_id`='".$item_name[$i]."',
				`qty`='".$item_qty[$i]."',
				`batch_no`='".$item_batch[$i]."',
                `expiry`='".$item_expiry[$i]."',
				`comment`='".$item_comment[$i]."',
				`date`='".$date[$i]."'
				"; 

				$run=$this->db->query($det);

		}
 	}
		

		if($run)
		{
			echo $inv_id;
		}
	}

	public function show_patientInvoices()
	{
		$result = $this->db->SELECT('*')->FROM('patient_indent_invoice')->where(array('is_deleted'=>0))->get()->result();

		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}

	}

	public function print_invoice_detail($id)
	{
		$result = $this->db->SELECT('patient_invoice_detail.*,item.*');
		$this->db->from('patient_invoice_detail');
		$this->db->join( 'item','item.id = patient_invoice_detail.item_id');
		$this->db->where('patient_invoice_detail.inv_id',$id);
		$query = $this->db->get()->result();
		return $query;
	}
	public function print_invoice($id)
	{
				$result = $this->db->SELECT('*')->FROM('patient_indent_invoice')->where('invoice_id',$id)->get()->row();
		return $result;
	}

	public function fetch_recept_by_type($id)
	{

	    $exe="SELECT * FROM `patient_indent_invoice` WHERE `invoice_id` !='' AND `type`='$id' ORDER BY `receptNumber` DESC LIMIT 1 ";
	    $query=$this->db->query($exe);

	    $receptNumber=$query->row_array();
	    echo $receptNumber['receptNumber']+1;
	}


	 public function get_advisor()
		 { 
		   $result =$this->db->select('*');
		      $this->db->where('type', 'Advisor');
		      $result = $this->db->get('groups')->result();
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