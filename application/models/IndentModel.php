<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndentModel extends CI_Model
{


	public function get_unit_indent_invoice()
  	{
	    
	    $exe="SELECT * FROM `unit_indent_invoice` WHERE `id` !='' AND `indent_type`='1' ORDER BY `receptNumber` DESC LIMIT 1 ";
	    $query=$this->db->query($exe);

	    return $query;
  	}

  	public function fetch_recept_by_indent_type($id)
	{

	    $exe="SELECT * FROM `unit_indent_invoice` WHERE `id` !='' AND `indent_type`='$id' ORDER BY `receptNumber` DESC LIMIT 1 ";
	    $query=$this->db->query($exe);

	    $receptNumber=$query->row_array();
	    echo $receptNumber['receptNumber']+1;
	}

public function get_unit_name()
{
    $this->db->select('*');
      $this->db->where('type', 'unit_name');
      $result = $this->db->get('groups');
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  } 
}
public function get_consult_name()
{
    $this->db->select('*');
      $this->db->where('type', 'cons_specailist');
      $result = $this->db->get('groups');
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  } 
}
public function get_storkeeper_name()
{
    $this->db->select('*');
      $this->db->where('type', 'store_keeper');
      $result = $this->db->get('groups');
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  } 
}
public function get_ward_incharge_name()
{
    $this->db->select('*');
      $this->db->where('type', 'ward_incharge');
      $result = $this->db->get('groups');
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  } 
}
public function get_issue_from_name()
{
    $this->db->select('*');
      $this->db->where('type', 'issue_from');
      $result = $this->db->get('groups');
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  } 
}
public function get_unit_indent_name()
{
    $this->db->select('*');
      $this->db->where('view', 'Pharmacy');
      $this->db->where('is_deleted', '0');
      $this->db->where('parent_id != ',0,false);
      $result = $this->db->get('departments');
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  } 
}

public function save_invoice($data,$item_name,$item_qty,$item_batch,$item_expiry,$item_comment)
	{
        // var_dump($data);exit;
		   $query=$this->db->insert('unit_indent_invoice',$data);
		 $inv_id=$this->db->insert_id();

		for($i=0;$i<count($item_name);$i++){

      
			 $det="INSERT INTO unit_indent_invoice_detail SET
				`inv_id`=".$inv_id.",
				`product`='".$item_name[$i]."',
				`quantity`='".$item_qty[$i]."',
				`batch_no`='".$item_batch[$i]."',
        `expiry`='".$item_expiry[$i]."',
        `deliver_quantity`='".$item_qty[$i]."',
				`comment`='".$item_comment[$i]."'
				"; 

				$run=$this->db->query($det);

		}

		if($run)
		{
			echo $inv_id;
		}
	}

  public function print_indent($id)
  {
    // echo $id;exit;
    $result = $this->db->SELECT('*')->FROM('unit_indent_invoice')->where('id',$id)->get()->row();

    // var_dump($result);exit;
    return $result;
  }

  public function print_indent_detail($id)
  {
    $result = $this->db->SELECT('unit_indent_invoice_detail.*,item.*');
    $this->db->from('unit_indent_invoice_detail');
    $this->db->join( 'item','item.id = unit_indent_invoice_detail.product');
    $this->db->where('unit_indent_invoice_detail.inv_id',$id);
    $query = $this->db->get()->result();
    return $query;
  }

  public function show_IndentInvoices()
  {
    $exe = "SELECT uind.*,dep.dep_name AS deparment,g.name AS unit FROM unit_indent_invoice uind LEFT JOIN departments dep ON (dep.id=uind.indent_type) LEFT JOIN groups g ON (uind.unit_id=g.id) WHERE uind.is_deleted=0";
    $query = $this->db->query($exe);
    $result=$query->result();
    if($result)
    {
      return $result;
    }
    else
    {
      return false;
    }

  }

  public function updateIndentInvoice($data,$item_name,$item_qty,$item_batch,$item_expiry,$item_comment,$id)
  {
   $exe="DELETE FROM unit_indent_invoice where id='$id'";
  $query=$this->db->query($exe);
  if($query)
  {
  $query=$this->db->insert('unit_indent_invoice',$data);
     $inv_id=$this->db->insert_id();  
  }

      $exe1="DELETE FROM unit_indent_invoice_detail where inv_id='$id'";
  $query1=$this->db->query($exe1);
  if($query1)
  {
    for($i=0;$i<count($item_name);$i++){

       $det="INSERT INTO unit_indent_invoice_detail SET
        `inv_id`=".$inv_id.",
        `product`='".$item_name[$i]."',
        `quantity`='".$item_qty[$i]."',
        `batch_no`='".$item_batch[$i]."',
        `expiry`='".$item_expiry[$i]."',
        `deliver_quantity`='".$item_qty[$i]."',
        `comment`='".$item_comment[$i]."'
        "; 

        $run=$this->db->query($det);

    }
  }
    
  if($run)
    {
      echo $inv_id;
    } 
  }

  public function fetchInvoicesByType($type)
  {
   $exe = "SELECT uind.*,dep.dep_name AS deparment,g.name AS unit FROM unit_indent_invoice uind LEFT JOIN departments dep ON (dep.id=uind.indent_type) LEFT JOIN groups g ON (uind.unit_id=g.id) WHERE uind.is_deleted=0 AND uind.indent_type='$type'";
    $query = $this->db->query($exe); 
    $result=$query->result();
    echo json_encode($result);

  }

}
?>