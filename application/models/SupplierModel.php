<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierModel extends CI_Model
{


 public function get_supplier_invoice()
   {
     
     $exe="SELECT * FROM `supplier_invoice` WHERE `id` !='' AND `supplier`='mcc_supplier' ORDER BY `receptNumber` DESC LIMIT 1 ";
     $query=$this->db->query($exe);

     return $query;
   }

     public function fetch_recept_by_supplier_type($id)
 {

     $exe="SELECT * FROM `supplier_invoice` WHERE `id` !='' AND `supplier`='$id' ORDER BY `receptNumber` DESC LIMIT 1 ";
     $query=$this->db->query($exe);

     $receptNumber=$query->row_array();
     echo $receptNumber['receptNumber']+1;
 }

   public function save_supplier_invoice($data,$item_name,$item_qty,$item_batch,$item_expiry,$item_comment)
 {

     $query=$this->db->insert('supplier_invoice',$data);
   $inv_id=$this->db->insert_id();

  for($i=0;$i<count($item_name);$i++){

    $det="INSERT INTO supplier_invoice_detail SET
    `inv_id`=".$inv_id.",
    `product`='".$item_name[$i]."',
    `quantity`='".$item_qty[$i]."',
    `batch_no`='".$item_batch[$i]."',
                `expiry`='".$item_expiry[$i]."',
    `comment`='".$item_comment[$i]."'
    "; 

    $run=$this->db->query($det);


   $exe="INSERT INTO item_batch SET 
      `item_id`='".$item_name[$i]."', 
      `batch_no`='".$item_batch[$i]."', 
      `expiry`='".$item_expiry[$i]."' 
         ";

   $run1=$this->db->query($exe);      
  }

  if($run)
  {
   echo $inv_id;
  }
 }

 public function save_supplierOrder_invoice($data,$item_name,$item_qty,$sub_total,$discount,$amount)
 {
 $query=$this->db->insert('supplier_invoice',$data);
   $inv_id=$this->db->insert_id();

  for($i=0;$i<count($item_name);$i++){

    $det="INSERT INTO supplier_invoice_detail SET
    `inv_id`=".$inv_id.",
    `product`='".$item_name[$i]."',
    `quantity`='".$item_qty[$i]."',
    `amount`='".$amount[$i]."',
                `discount`='".$discount[$i]."',
                `sub_total`='".$sub_total[$i]."'"; 

    $run=$this->db->query($det);

  }

  if($run)
  {
   echo $inv_id;
  } 
 }

 public function getSupplier()
 {
  $result =$this->db->select('*');
      $this->db->where('type', 'Supplier');
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

 public function insert_vendor($data)
 {
   $result = $this->db->insert('vendors', $data); 
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

 public function get_vendor()
 {
   $result ="SELECT v.id,v.name,g.name AS vendor FROM vendors v LEFT JOIN groups g ON (g.id=v.vendor_type)";
     $query=$this->db->query($result);

     return $query;
 }

 public function fetch_vendor($id)
 {
  $output='';
  $this->db->select('*');
      $this->db->where('vendor_type', $id);
      $result = $this->db->get('vendors');
      // $quantity    = $result->result();
      // var_dump($quantity);exit;
      $output.='<option>Select Vendors</option>';
      foreach($result->result() as $row)
      {
       
        $output.='<option value='.$row->id.'>'.$row->name.'</option>';  
      }
     echo $output; 
 }

 public function show_supplier()
 {
  $sql="SELECT sp.receptNumber,sp.id,sp.dated,g.name AS supplier, ind.name AS type, v.name FROM supplier_invoice sp LEFT JOIN groups g ON (g.id=sp.supplier) LEFT JOIN vendors v ON (v.id=sp.vendor_id) LEFT JOIN indent_sub_name ind ON (ind.id=sp.product_type) WHERE sp.is_deleted=0";
  $query=$this->db->query($sql);

     return $query;
 }

 public function update_supplier_invoice($data,$item_name,$item_qty,$item_batch,$item_expiry,$item_comment,$id,$sub_total,$discount,$amount,$date)
 {
  $exe="DELETE FROM supplier_invoice where id='$id'";
  $query=$this->db->query($exe);
  if($query)
  {
  $query=$this->db->insert('supplier_invoice',$data);
   $inv_id=$this->db->insert_id(); 
  }

     $exe1="DELETE FROM supplier_invoice_detail where inv_id='$id'";
  $query1=$this->db->query($exe1);
  if($query1)
  {
   for($i=0;$i<count($item_name);$i++){

    $det="INSERT INTO supplier_invoice_detail SET
    `inv_id`=".$inv_id.",
    `product`='".$item_name[$i]."',
    `quantity`='".$item_qty[$i]."',
    `batch_no`='".$item_batch[$i]."',
    `expiry`='".$item_expiry[$i]."',
    `amount`='".$amount[$i]."',
    `discount`='".$discount[$i]."',
    `sub_total`='".$sub_total[$i]."',
    `comment`='".$item_comment[$i]."',
    `inv_date`='".$date."'
    "; 

    $run=$this->db->query($det);

    
   $exe="INSERT INTO item_batch SET 
      `item_id`='".$item_name[$i]."', 
      `batch_no`='".$item_batch[$i]."', 
      `expiry`='".$item_expiry[$i]."' 
         ";

   $run1=$this->db->query($exe);  
  }
  }
  

  if($run)
  {
   echo $inv_id;
  }
 }


  public function print_SupplierInvoice($id)
  {
   $query ="SELECT sp.receptNumber,sp.id,sp.dated,g.name AS supplier, ind.name AS type, v.name ,sp.sub_memo,sp.statement FROM supplier_invoice sp LEFT JOIN groups g ON (g.id=sp.supplier) LEFT JOIN vendors v ON (v.id=sp.vendor_id) LEFT JOIN indent_sub_name ind ON (ind.id=sp.product_type) WHERE sp.id='$id'";
   // echo $query;exit;
   $run=$this->db->query($query);
  return $run->row_array();
  }

  public function print_SupplierInvoice_detail($id)
  {
    $result = $this->db->SELECT('supplier_invoice_detail.*,item.*');
  $this->db->from('supplier_invoice_detail');
  $this->db->join( 'item','item.id = supplier_invoice_detail.product');
  $this->db->where('supplier_invoice_detail.inv_id',$id);
  $query = $this->db->get()->result();
  return $query;
  }
}
?>