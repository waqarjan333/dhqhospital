<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model
{

 public function insert($array)
 {
  $result = $this->db->insert('item', $array);
   $item_id=$this->db->insert_id();
   $sql="INSERT INTO item_batch  (`item_id`,`batch_no`,`expiry`) VALUES ('".$item_id."','".$array['batch_no']."','".$array['expiry']."')";
   $query=$this->db->query($sql); 
  if($result)
  {

   return true;
  }
  else
  {
   return false;
  }
 }

public function insert_unit($array)
{
 $result = $this->db->insert('groups', $array); 
 if($result)
  {
    // echo "true";
   return true;
  }
  else
  {
   return false;
  }
}

public function insert_type($array)
{
 $result = $this->db->insert('indent_sub_name', $array); 
 if($result)
  {

   return true;
  }
  else
  {
   return false;
  }
}
 public function get_items()
 { 
   $result = $this->db->select('*')->from('item')->get()->result();
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  }
 }
  public function get_unit()
 { 
   $result =$this->db->select('*');
      $this->db->where('type', 'unit');
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
  public function get_category()
 { 
   $result =$this->db->select('*');
      $this->db->where('type', 'category');
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
 public function get_type()
 { 
   $result =$this->db->select('*');
      $result = $this->db->get('indent_sub_name')->result();
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  }
 }

 public function get_batch($id)
 {

      $this->db->select('*');
      $this->db->where('item_id', $id);
      $result = $this->db->get('item_batch')->result();
      echo json_encode($result);
 }

 public function fetch_product_qty($id)
 {
  $sql="SELECT * FROM (SELECT id,quantity FROM item WHERE id='$id') x 

LEFT JOIN (SELECT SUM(patient_invoice_detail.qty) as p_qty,patient_invoice_detail.item_id AS p_pid FROM patient_invoice_detail GROUP BY p_pid ) y ON x.id=y.p_pid 

LEFT JOIN (SELECT SUM(unit_indent_invoice_detail.quantity) AS uind_qty,unit_indent_invoice_detail.product AS unid_pid FROM unit_indent_invoice_detail GROUP BY unid_pid) z ON x.id=z.unid_pid 

LEFT JOIN (SELECT SUM(supplier_invoice_detail.quantity) AS sup_qty,supplier_invoice_detail.product AS sup_pid FROM supplier_invoice_detail GROUP BY sup_pid) q ON x.id=q.sup_pid";

     
      $query=$this->db->query($sql);
      // var_dump($quantity);exit;
       $quantity    = $query->result_array();
       $remaining=$quantity[0]['quantity']+$quantity[0]['sup_qty']-$quantity[0]['uind_qty']-$quantity[0]['p_qty'];
      echo $remaining;
 } 

 public function fetch_item_by_type($id)
 {
  $search='';
  $output='';
  if($id !='')
  {
    $search="product_cat='$id'";
  }
  else{
    $search="id !=''";
  }
  $sql="SELECT * FROM item WHERE ".$search;
      // $quantity    = $result->result();
      // var_dump($quantity);exit;
  // echo $exe;exit;
    $result=$this->db->query($sql);
      // $quantity    = $result->result();
      // var_dump($quantity);exit;
      $output.='<option>Select Medicine</option>';
      foreach($result->result() as $row)
      {
       
        $output.='<option value="'.$row->id.'">'.$row->name.'</option>';  
      }
     echo $output; 
 }
 public function get_product()
   {
    $exe="SELECT * FROM (SELECT id,quantity AS op_qty,name FROM item ) x LEFT JOIN (SELECT SUM(patient_invoice_detail.qty) as p_qty,patient_invoice_detail.item_id AS p_pid FROM patient_invoice_detail GROUP BY p_pid ) y ON x.id=y.p_pid LEFT JOIN (SELECT SUM(unit_indent_invoice_detail.quantity) AS ind_qty,unit_indent_invoice_detail.product AS unid_pid FROM unit_indent_invoice_detail GROUP BY unid_pid) z ON x.id=z.unid_pid LEFT JOIN (SELECT SUM(supplier_invoice_detail.quantity) AS supplier_qty,supplier_invoice_detail.product AS sup_pid FROM supplier_invoice_detail GROUP BY sup_pid) q ON x.id=q.sup_pid LEFT JOIN (SELECT SUM(adjust_stock.qty) AS adj_qty,adjust_stock.item_id AS adj_pid FROM adjust_stock GROUP BY adj_pid) j ON x.id=j.adj_pid
";
    $query=$this->db->query($exe);
   
    $row=$query->result(); 
      
      echo json_encode($row);
      return $row;
   }

  
   public function get_product_type_item($value)
   {
    $exe="SELECT * FROM  item WHERE med_type='$value'";
     $query=$this->db->query($exe);
     $row=$query->result(); 
      
      echo json_encode($row);
      return $row;
   }

   public function getCat()
   {
    $result =$this->db->select('*');
      $this->db->where('type', 'category');
      $result = $this->db->get('groups')->result();
      echo json_encode($result);
      return $result;
   } 

   public function getType()
   {
    $result =$this->db->select('*');
      $result = $this->db->get('indent_sub_name')->result();
      echo json_encode($result);
      return $result;
   }   

     public function get_product_name_item($id)
   {
    $exe="SELECT * FROM (SELECT id,quantity AS op_qty,name FROM item WHERE id='$id') x LEFT JOIN (SELECT SUM(patient_invoice_detail.qty) as p_qty,patient_invoice_detail.item_id AS p_pid FROM patient_invoice_detail GROUP BY p_pid ) y ON x.id=y.p_pid LEFT JOIN (SELECT SUM(unit_indent_invoice_detail.quantity) AS ind_qty,unit_indent_invoice_detail.product AS unid_pid FROM unit_indent_invoice_detail GROUP BY unid_pid) z ON x.id=z.unid_pid LEFT JOIN (SELECT SUM(supplier_invoice_detail.quantity) AS supplier_qty,supplier_invoice_detail.product AS sup_pid FROM supplier_invoice_detail GROUP BY sup_pid) q ON x.id=q.sup_pid LEFT JOIN (SELECT SUM(adjust_stock.qty) AS adj_qty,adjust_stock.item_id AS adj_pid FROM adjust_stock GROUP BY adj_pid) j ON x.id=j.adj_pid";
    // echo $exe;exit();
     $query=$this->db->query($exe);
     $row=$query->result(); 
      
      echo json_encode($row);
      return $row;
   }

      public function fetch_product($search)
   {
    $exe="SELECT * FROM item WHERE name LIKE '%".$search."%'";
    $query=$this->db->query($exe);
    $output='<ul class="list-unstyled">';
  if( $query->num_rows()>0)
  {
    foreach($query->result_array() as $row){

    $output.='<li class="li_unstyle">'.$row['name'].'</li>';
  }
  }
  else{
    $output.='<li>NO PRODUCT FOUND';
  }
  $output.='</ul>';
  echo $output;
   }

    public function get_product_cat_item($value)
   {
    $exe="SELECT * FROM (SELECT id,quantity AS op_qty,name FROM item WHERE product_cat='$value') x LEFT JOIN (SELECT SUM(patient_invoice_detail.qty) as p_qty,patient_invoice_detail.item_id AS p_pid FROM patient_invoice_detail GROUP BY p_pid ) y ON x.id=y.p_pid LEFT JOIN (SELECT SUM(unit_indent_invoice_detail.quantity) AS ind_qty,unit_indent_invoice_detail.product AS unid_pid FROM unit_indent_invoice_detail GROUP BY unid_pid) z ON x.id=z.unid_pid LEFT JOIN (SELECT SUM(supplier_invoice_detail.quantity) AS supplier_qty,supplier_invoice_detail.product AS sup_pid FROM supplier_invoice_detail GROUP BY sup_pid) q ON x.id=q.sup_pid LEFT JOIN (SELECT SUM(adjust_stock.qty) AS adj_qty,adjust_stock.item_id AS adj_pid FROM adjust_stock GROUP BY adj_pid) j ON x.id=j.adj_pid";

    // $exe="SELECT * FROM (SELECT * FROM item WHERE product_cat='$value')x LEFT JOIN (SELECT id,name AS cat_name FROM indent_sub_name)y ON x.product_cat=y.id";
     $query=$this->db->query($exe);
     $row=$query->result(); 
      
      echo json_encode($row);
      return $row;
   }
}
?>