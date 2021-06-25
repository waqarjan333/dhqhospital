<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitIndent extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('IndentModel');
        }


	public function index()
	{
		$this->load->model('ProductModel');
        $page_data['page_name1'] = 'unit-indent';
        $page_data['page_name'] = 'pharmacy/unit-indent';
        $page_data['getTypes'] = $this->ProductModel->get_type();
        $page_data['inv_no'] = $this->IndentModel->get_unit_indent_invoice();
        $page_data['items'] = $this->ProductModel->get_items();   
        $page_data['unit_name'] = $this->IndentModel->get_unit_name();   
        $page_data['consult_name'] = $this->IndentModel->get_consult_name();   
        $page_data['storkeeper_name'] = $this->IndentModel->get_storkeeper_name();   
        $page_data['ward_incharge_name'] = $this->IndentModel->get_ward_incharge_name();   
        $page_data['issue_from_name'] = $this->IndentModel->get_issue_from_name();   
        $page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();   
        $this->load->view('index',$page_data);
	}   

	public function fetch_recept_by_indent_type()
	{
	    $id=$this->input->post('unit_id');
         $this->IndentModel->fetch_recept_by_indent_type($id);	
	}

  public function fetchInvoiceByType()
  {
   $type=$this->input->post('type');
   $this->IndentModel->fetchInvoicesByType($type); 
  }
	public function save_invoice()
	{
		$data = array('receptNumber' => $this->input->post('inv_id'),
					  'unit_id' => $this->input->post('unit_name'),	
					  'InvDate' => $this->input->post('inv_date'),	
					  'unit_incharge' => $this->input->post('cons_specailist'),	
					  'issuing_authority' => $this->input->post('store_keeper'),	
					  'invoice_reciever' => $this->input->post('ward_incharge'),	
					  'issue_from' => $this->input->post('dms'),	
            'indent_type' => $this->input->post('indent_type')
                  );
		$item_batch = $this->db->escape_str($this->input->post('item_batch'));
		$item_batch = str_replace(" ",'',$item_batch);
    $batch='';
    $expiry='';
		$item_name = $this->input->post('item_name');	
    // var_dump($item_name);exit;
		$item_qty= $this->input->post('item_qty');
		$item_expiry = $this->input->post('item_expiry');	
		$item_comment = $this->input->post('item_comment');
	   if(empty($item_batch))
    {
      $batch='0';
    }
    else{
      $batch=$item_batch;
    }
    if(empty($item_expiry))
    {
      $expiry='0000-00-00';
    } 	 
    else{
      $expiry=$item_expiry;
    }

		 $this->IndentModel->save_invoice($data,$item_name,$item_qty,$batch,$expiry,$item_comment);
	}

   public function show_IndentInvoices()
    {
          $page_data['page_name1'] = 'show-IndentInvoices';
        $page_data['page_name'] = 'pharmacy/show-IndentInvoices';
        $page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();
        $page_data['data'] = $this->IndentModel->show_IndentInvoices();
        $this->load->view('index',$page_data);    
    }

   public function EditIndentInvoice()
   {
    $id = $this->uri->segment(3); // for getting the id

            $query = $this->db->query("select * from unit_indent_invoice where id=".$id);
            // echo $query;exit;
            $page_data['record'] = $query->result_array();

            $query = $this->db->query("select * from unit_indent_invoice_detail where inv_id=".$id);
            // echo $query;exit;
            $page_data['record2'] = $query->result();

            $page_data['id']=$id;
            $this->load->model('ProductModel');
            $this->load->model('IndentModel');
            $page_data['items'] = $this->ProductModel->get_items();   
            $page_data['unit_name'] = $this->IndentModel->get_unit_name();   
            $page_data['consult_name'] = $this->IndentModel->get_consult_name();   
            $page_data['storkeeper_name'] = $this->IndentModel->get_storkeeper_name();   
            $page_data['ward_incharge_name'] = $this->IndentModel->get_ward_incharge_name();   
            $page_data['issue_from_name'] = $this->IndentModel->get_issue_from_name();   
            $page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();   
            $page_data['page_name1'] = 'edit_IndentInvoice';
            $page_data['page_name'] = 'pharmacy/edit_IndentInvoice';
            $this->load->view('index', $page_data);
   }

   public function updateIndentInvoice()
   {
        $data = array('receptNumber' => $this->input->post('inv_id'),
            'unit_id' => $this->input->post('unit_name'), 
            'InvDate' => $this->input->post('inv_date'),  
            'unit_incharge' => $this->input->post('cons_specailist'), 
            'issuing_authority' => $this->input->post('store_keeper'),  
            'invoice_reciever' => $this->input->post('ward_incharge'),  
            'issue_from' => $this->input->post('dms'),  
            'indent_type' => $this->input->post('indent_type')
                  );
    $item_batch = $this->db->escape_str($this->input->post('item_batch'));
    $item_batch = str_replace(" ",'',$item_batch);
    $batch='';
    $expiry='';
    $id=$this->input->post('edit_invid');    
    $item_name = $this->input->post('item_name'); 
    $item_qty= $this->input->post('item_qty');
    $item_expiry = $this->input->post('item_expiry'); 
    $item_comment = $this->input->post('item_comment');
      if(empty($item_batch))
    {
      $batch='0';
    }
    else{
      $batch=$item_batch;
    }
    if(empty($item_expiry))
    {
      $expiry='0000-00-00';
    }    
    else{
      $expiry=$item_expiry;
    } 
     $this->IndentModel->updateIndentInvoice($data,$item_name,$item_qty,$item_batch,$item_expiry,$item_comment,$id);
   }

   public function deleteIndentInvoice($id)
   {
      $exe="UPDATE unit_indent_invoice SET is_deleted=1 WHERE id='$id'";
    $run=$this->db->query($exe);
     $result=$run->result();       
        if($result)
            {
                  $exe="UPDATE unit_indent_invoice_detail SET is_deleted=1 WHERE inv_id='$id'";
                  $this->db->query($exe);

                $this->session->set_flashdata('message', 'Invoice Deleted Successfully');
                redirect('UnitIndent/show_IndentInvoices');   
            }
            else
            {
                $this->session->set_flashdata('message', 'Error While Deleting Invoice');
                redirect('UnitIndent/show_IndentInvoices');
            }
   }  

public function add_unit()
{
  $name=$this->input->post('value');
  $type=$this->input->post('type');
    $data = array('name' => $name,'type'=>$type );
  $exe='';
    $this->db->select('*');
        $this->db->where('name', $name);
        $this->db->from('groups');
        $query = $this->db->get();
       if($query->num_rows() >0){
         $exe=false;
        }
     else{
         $exe=$this->db->insert('groups',$data);
         $exe=true;
        }
      echo $exe;  
    return $exe;
}

	public function print_suplier_invoice()
	{
    $inv_id=$this->input->post('inv_id');
    $det= $this->IndentModel->print_indent_detail($inv_id);
        $inv= $this->IndentModel->print_indent($inv_id);
		?>
<!DOCTYPE html>

<html lang="en">
    
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Print</title>

<link rel="stylesheet" type="text/css" href="assets/css/print.css"/>





<style type="text/css">
  body{
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
  }


</style>

</head>

<body>
<?php 

?>
<div id="container" style="width:750px;">
<form name="form" method="post" action="" id="form">
       <header style="height:auto; width:750px;">
        <table width="100%" height="80" border="0" cellpadding="5" cellspacing="0" style="border-bottom:2px solid #666; border:0px;">
        <tr>
         <td>
             <img src="<?php echo base_url('images/logo.png') ?>" height="120" width="120" />
         </td>
        <td style="text-align:center;">
            <p style="font-size:26px; font-weight:bold; word-spacing: 4px;">
            DISTRICT HEAD QUARTER HOSPITAL UPPER DIR
            </p>  
            <?php 
            $id=$inv->indent_type;
            
            $sql="SELECT * from departments WHERE id='$id' ";
              $query=$this->db->query($sql);

            $result=$query->row_array();
             ?>
            <p style="margin-top:-20px;"><strong>S.no :  <?php echo $inv->receptNumber; ?> / Date :  <?php echo date('y-m-d'); ?> / INDENT FOR :  <?php echo $result['dep_name'] ?></strong></p>
            
        </td>
     </tr>
     
     </table>
     
     <table style="border-collapse: collapse; width:100%;">
        <thead>
            <tr>
                <th style="border: 1px solid black;  text-align:left;">S.No</th>
                <th style="border: 1px solid black;  text-align:left;">Medicines Name</th>
                <th style="border: 1px solid black;  text-align:left;">Quantity</th>
                <th style="border: 1px solid black;  text-align:left;">Deliver Qty</th>
                <th style="border: 1px solid black;  text-align:left;">Comment</th>
            </tr>
        </thead>

        <tbody>
                <?php $count=0; foreach($det as $row){

             $count++; ?>
            <tr>
                <td style="border: 1px solid black;"><?php echo $count; ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->name ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->deliver_quantity ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->deliver_quantity ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->comment ?></td>
            </tr>
            <?php } ?>
        </tbody>
     </table>



<div style="width:100%; float:left; margin-top:20px;">
    <div style="width:77%; float:left;">Name Here <br> DHQ Hospital Dir Upper</div>
    <div style="width:23%; float:left;">Name Here <br> DHQ Hospital Dir Upper</div>
</div>


<div style="width:100%; float:left; margin-top:50px;">
    <div style="width:77%; float:left;">Name Here <br> DHQ Hospital Dir Upper</div>
    <div style="width:23%; float:left;">Name Here <br> DHQ Hospital Dir Upper</div>
</div>



<div style="width:100%; float:left;">
<a style="background-color:#FFF; color:#FFF; border:0px; height:30px; width:100%;" >======================================================================</a>
</div>

  </header>



</form>
 
</div>


<script type="text/javascript" src="js/jquery.js"></script>



<script src="include/jquery_updown.min.js"></script>

</body>
</html>
<?php 
	}
}
?>