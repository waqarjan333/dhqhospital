<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierInvoice extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('SupplierModel');
        }

        public function index()
        {
        	$this->load->model('ProductModel');
            $this->load->model('IndentModel');
            $page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();
        $page_data['page_name1'] = 'supplier-invoice';
        $page_data['page_name'] = 'pharmacy/supplier-invoice';
        $page_data['items'] = $this->ProductModel->get_items();  
        $page_data['inv_no'] = $this->SupplierModel->get_supplier_invoice();
        $page_data['getTypes'] = $this->ProductModel->get_type();
        $page_data['vendor'] = $this->SupplierModel->get_vendor();
        $page_data['supplier']=$this->SupplierModel->getSupplier();
        $this->load->view('index',$page_data);
        }


        public function add_supplier()
        {
            $this->load->model('ProductModel');
               $page_data['page_name1'] = 'add_supplier';
        $page_data['page_name'] = 'pharmacy/add_supplier';
        $page_data['supplier']=$this->SupplierModel->getSupplier();
            $this->load->view('index',$page_data);

            if(isset($_POST['save']))
            {
                    $data = array('name' => $this->input->post('supplier'),
                                  'type' => "Supplier" );
                $model = $this->ProductModel->insert_unit($data);

            if($model)
            {?>
                    <script>
                        alert('Supplier Added');
                    </script>
            <?php }

            }

            if(isset($_POST['save_vendor']))
            {
                  $data = array('name' => $this->input->post('vendor_name'),
                                  'vendor_type' => $this->input->post('supplier_type') );
                $model = $this->SupplierModel->insert_vendor($data);

                if($model)
            {
                $this->session->set_flashdata('message', 'Vendor Added Successfully');
                redirect('SupplierInvoice/show_vendor');
            }
            else
            {
                $this->session->set_flashdata('message', 'Error While Adding Vendor');
                redirect('SupplierInvoice/add_product');
            }
            } 
           
        }


        public function add_vendor()
        {
            $vendor_name=$this->input->post('vendor_name');
            $vendor_type=$this->input->post('vendor_type');
    $data = array('name' => $vendor_name,'vendor_type'=>$vendor_type );
  $exe='';
    $this->db->select('*');
        $this->db->where('name', $vendor_name);
        $this->db->from('vendors');
        $query = $this->db->get();
       if($query->num_rows() >0){
         $exe=false;
        }
     else{
         $exe=$this->db->insert('vendors',$data);
         $exe=true;
        }
        echo $exe;  
         return $exe;
        }


        public function show_vendor()
        {
            $page_data['page_name1'] = 'show-vendor';
        $page_data['page_name'] = 'pharmacy/show-vendor';
        $page_data['data'] = $this->SupplierModel->get_vendor();
        $this->load->view('index',$page_data);
    }  

    public function fetchVendor()
    {
       $id=$this->input->post('unit_id'); 
    $this->SupplierModel->fetch_vendor($id);  
    } 

    public function editVendor($id)
    {
                if(isset($_POST['save_vendor']))
        {
            // echo 'ok';exit;
                $name = $this->input->post('vendor_name');
                $type = $this->input->post('supplier_type');

            $array = array(

                    'name'=>$name,
                    'vendor_type'=>$type
                    
                );
                $page_data['record'] = $this->db->where('id', $id);
            $page_data['record'] = $this->db->update('vendors', $array);
            $page_data['id']=$id;

            $page_data['page_name'] = 'pharmacy/edit_supplier';
            $this->load->view('index', $page_data);
            $this->session->set_flashdata('message', 'Update Successfully');
            redirect('SupplierInvoice/show_vendor');
        }
        else{
              $page_data['page_name1'] = 'edit_supplier';
        $page_data['page_name'] = 'pharmacy/edit_supplier';
        // $page_data['data'] = $this->SupplierModel->get_vendor();
         $page_data['supplier']=$this->SupplierModel->getSupplier();
        $id = $this->uri->segment(3); // for getting the id

            $page_data['id']=$id;
            $query = $this->db->query("select * from vendors where id=".$id);
            $page_data['record'] = $query->result_array();
        $this->load->view('index',$page_data);             
        }
     
    }
       
       public function delete_vendor($id)
       {
        $this->db->where('id',$id);

        $result =$this->db->delete('vendors');
            
        if($result)
            {
                $this->session->set_flashdata('message', 'Vendor Deleted Successfully');
                redirect('SupplierInvoice/show_vendor');   
            }
            else
            {
                $this->session->set_flashdata('message', 'Error While Deleting Vendor');
                redirect('Product/show_vendor');
            }
       } 


        public function save_supplier_invoice()
	{
		$data = array('receptNumber' => $this->input->post('inv_id'),
					  'supplier' => $this->input->post('supplier_type'),	
                      'vendor_id' => $this->input->post('vendor'),    
                      'product_type' => $this->input->post('product_cat'),    
					  'sub_memo' => $this->input->post('subject_memo'),	
					  'statement' => $this->input->post('statement'),	
					  'dated' => $this->input->post('inv_date')
		 );
		$item_batch = $this->db->escape_str($this->input->post('item_batch'));
		$item_batch = str_replace(" ",'',$item_batch);
        $batch='';
        $expiry='';
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
		 $this->SupplierModel->save_supplier_invoice($data,$item_name,$item_qty,$batch,$expiry,$item_comment);
	}

    public function save_supplierOrder_invoice()
    {
        $date=date('yy-m-d');
     $data = array('receptNumber' => $this->input->post('inv_id'),
                   'supplier' => $this->input->post('supplier_type'),    
                   'vendor_id' => $this->input->post('vendor'),    
                   'product_type' => $this->input->post('product_cat'),    
                   'sub_memo' => $this->input->post('subject_memo'), 
                   'statement' => $this->input->post('statement'),   
                   'dated' => $date,
                   'date' => $date,
                   'inv_status' => '1'
         );
        $item_name = $this->input->post('item_name');   
        $item_qty= $this->input->post('item_qty');
        $sub_total = $this->input->post('sub_total');   
        $discount = $this->input->post('discount'); 
        $amount = $this->input->post('amount'); 
        
         $this->SupplierModel->save_supplierOrder_invoice($data,$item_name,$item_qty,$sub_total,$discount,$amount);   
    }


    public function ShowSupplierInvoice()
    {
         $page_data['page_name1'] = 'show-supplierInvoice';
        $page_data['page_name'] = 'pharmacy/show-supplierInvoice';
        $page_data['data'] = $this->SupplierModel->show_supplier();
        $this->load->view('index',$page_data);
    }

    public function deleteSupplierInvoice($id)
    {
        $exe="UPDATE supplier_invoice SET is_deleted=1 WHERE id='$id'";
    $run=$this->db->query($exe);
     $result=$run->result();     
        if($result)
            {
                $exe="UPDATE supplier_invoice_detail SET is_deleted=1 WHERE inv_id='$id'";
                  $this->db->query($exe);

                $this->session->set_flashdata('message', 'Supplier Invoice Deleted Successfully');
                redirect('SupplierInvoice/ShowSupplierInvoice');   
            }
            else
            {
                $this->session->set_flashdata('message', 'Error While Deleting Supplier Invoice');
                redirect('Product/ShowSupplierInvoice');
            }
               
    }

    public function edit_invoice()
    {
        $id = $this->uri->segment(3); // for getting the id

            $query = $this->db->query("select * from supplier_invoice where id=".$id);
            // echo $query;exit;
            $page_data['record'] = $query->result_array();

            $query = $this->db->query("select * from supplier_invoice_detail where inv_id=".$id);
            // echo $query;exit;
            $page_data['record2'] = $query->result();

            // $page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
            //$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

            $page_data['id']=$id;
            $this->load->model('ProductModel');
            $this->load->model('IndentModel');
            $page_data['supplier']=$this->SupplierModel->getSupplier();
               $page_data['items'] = $this->ProductModel->get_items();  
        $page_data['inv_no'] = $this->SupplierModel->get_supplier_invoice();
        $page_data['getTypes'] = $this->ProductModel->get_type();
        $page_data['vendor'] = $this->SupplierModel->get_vendor();
            $page_data['page_name1'] = 'show-departments';
            $page_data['page_name'] = 'pharmacy/edit-supplierInvoice';
            $this->load->view('index', $page_data);
    }

    public function edit_supplier_invoice()
    {
        $data = array('receptNumber' => $this->input->post('inv_id'),
                      'supplier' => $this->input->post('supplier_type'),    
                      'vendor_id' => $this->input->post('vendor'),    
                      'product_type' => $this->input->post('product_cat'),    
                      'sub_memo' => $this->input->post('subject_memo'), 
                      'statement' => $this->input->post('statement'),   
                      'dated' => $this->input->post('inv_date'),
                      'date' => $this->input->post('inv_date'),
                      'inv_status' => $this->input->post('inv_status_id')
         );
        $id=$this->input->post('edit_invid');
        $item_batch = $this->db->escape_str($this->input->post('item_batch'));
        $item_batch = str_replace(" ",'',$item_batch);
         $batch='';
        $expiry='';
        $item_name = $this->input->post('item_name');   
        $item_qty= $this->input->post('item_qty');
        $item_expiry = $this->input->post('item_expiry');   
        $item_comment = $this->input->post('item_comment');
        $sub_total = $this->input->post('sub_total');   
        $discount = $this->input->post('discount'); 
        $amount = $this->input->post('amount');  
        $date = $this->input->post('inv_date');  
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
         $this->SupplierModel->update_supplier_invoice($data,$item_name,$item_qty,$item_batch,$item_expiry,$item_comment,$id,$sub_total,$discount,$amount,$date);
    }
	public function fetch_recept_by_supplier_type()
	{
		$id=$this->input->post('unit_id');
         $this->SupplierModel->fetch_recept_by_supplier_type($id);	
	}

    public function StockAdjustements()
    {
        $this->load->model('ProductModel');
            $page_data['product']=$this->ProductModel->get_items();
        $page_data['category']=$this->ProductModel->get_type();
              $page_data['page_name1'] = 'stock_adjust';
            $page_data['page_name'] = 'pharmacy/stock_adjust';
        $this->load->view('index', $page_data);       
    }

    public function supplierOrder()
    {
       $this->load->model('ProductModel');
          $this->load->model('IndentModel');
        $page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();
        $page_data['items'] = $this->ProductModel->get_items();  
        $page_data['inv_no'] = $this->SupplierModel->get_supplier_invoice();
        $page_data['getTypes'] = $this->ProductModel->get_type();
        $page_data['vendor'] = $this->SupplierModel->get_vendor();
        $page_data['supplier']=$this->SupplierModel->getSupplier();
        
              $page_data['page_name1'] = 'SupplierOrder';
            $page_data['page_name'] = 'pharmacy/SupplierOrder';
        $this->load->view('index', $page_data);   
    }

        
	public function print_suplier_invoice()
	{

         $inv_id=$this->input->post('inv_id');
        $det= $this->SupplierModel->print_SupplierInvoice_detail($inv_id);
        $inv= $this->SupplierModel->print_SupplierInvoice($inv_id);
?>
<!DOCTYPE html>

<html lang="en">
	
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Print</title>






<style type="text/css">
  body{
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
  }


</style>

</head>

<body>

<center>
<div id="container" style="width:750px;">
<form name="form" method="post" action="" id="form">
       <header style="height:auto; width:750px;">
        <table width="100%" height="80" border="0" cellpadding="5" cellspacing="0" style="border-bottom:2px solid #666; border:0px;">
        <tr>
         <td>
             <img src="<?php echo base_url('images/logo.png') ?>" height="120" width="120" />
         </td>
        <td style="text-align:center;">
            <p style="font-size:26px; word-spacing: 10px;">
            OFFICE OF THE MEDICAL SUPERINTENDENT DHQ HOSPITAL UPPER DIR
            </p>  
            <p style="margin-top:-20px;"><strong>Office : </strong> 0944-881012 && 881455 / <strong>Fax : </strong> : 0944-881012</p>
            <p style="margin-top:-10px; margin-left:-130px;"><strong>Email : </strong> msdhqupperdir@yahoo.com</p>
            <p style=" margin-left:300px;">No -------- / MS, Dated : <?php echo date('m') ?> / <?php echo date('Y') ?></p>  
        </td>
     </tr>
     
     </table>
    <div style="width:100%; float:left;">
        <div style="width:20%; float:left; padding-left:10px; text-align:left;">
            To,
        </div> 
       <div class="" style=" float: left; font-size:16px; font-family: monospace; text-transform:uppercase;"><?php echo $inv['supplier'] ?></div>
    </div>

    <div style="width:100%;margin-top:30px; float:left; text-align:left;">
        <div style="width:20%; float:left; padding-left:10px;">
            Subject Memo : 
        </div>
        <div style="width:78%; float:left; font-size:16px; font-family: monospace; text-transform:uppercase; text-decoration:underline;">
       <?php echo $inv['sub_memo'] ?>
        </div>
    </div>


    <div style="width:100%;margin-top:30px; float:left; margin-bottom:30px; text-align:left;">
        
        <div style="width:100%; float:left; font-size:16px; font-family: monospace; padding-left:10px;">
      <?php echo $inv['statement'] ?>
        </div>
    </div>
     
     <table style="border-collapse: collapse; width:100%;">
        <thead>
            <tr>
                <th style="border: 1px solid black;  text-align:left;">S.No</th>
                <th style="border: 1px solid black;  text-align:left;">Item Name</th>
                <th style="border: 1px solid black;  text-align:left;">Trade Name</th>
                <th style="border: 1px solid black;  text-align:left;">Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; $b=''; foreach ($det as $row) { $i++; 
                    $brand=explode('/',$row->name);
                    if(isset($brand[3]))
                    {
                        $b=$brand[3];
                    }
                    else{
                        $b='---';
                    }
                ?>
                
                
        	 <tr>
                <td style="border: 1px solid black;"><?php echo $i; ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->name ?></td>
                <td  style="border: 1px solid black;"><?php echo $b ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->quantity ?></td>
            </tr>
        <?php } ?>
        </tbody>
</table>
       
<div style="float: left;font-size:16px; font-family: monospace; text-transform:uppercase; text-decoration:underline;margin-top: 25px">
	<strong>Note : </strong> Supply order must be treated most urgently.
</div>
<div style="  margin-top:30px;">

</div>

<div style="width:100%; float:left;">
    <div style="width:77%; float:left;">&nbsp;</div>
    <div style="width:23%; float:left;">Medical Superintendent <br> DHQ Hospital Dir Upper</div>
</div>


<div style="width:290; float:left; font-size:16px; font-family: monospace;">
    Copy to the : -------------------
</div>


<div style="width:190; float:left; font-size:16px; font-family: monospace;  clear:both;  margin-top:30px;">
01 : Office Record. 
</div>


<div style="width:100%; float:left;">
    <div style="width:77%; float:left;">&nbsp;</div>
    <div style="width:23%; float:left;">Medical Superintendent <br> DHQ Hospital Dir Upper</div>
</div>


<div style="width:100%; float:left;">
<p style="background-color:#FFF; color:#FFF; border:0px; height:30px; width:100%;" >====================================================</p>
</div>

  </header>



</form>
 
</div>

</center>

</body>
</html>	
<?php 
	}

    public function print_Ordernvoice()
    {
$inv_id=$this->input->post('inv_id');
        $det= $this->SupplierModel->print_SupplierInvoice_detail($inv_id);
        $inv= $this->SupplierModel->print_SupplierInvoice($inv_id);
?>
<!DOCTYPE html>

<html lang="en">
    
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Print</title>






<style type="text/css">
  body{
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
  }


</style>

</head>

<body>

<center>
<div id="container" style="width:750px;">
<form name="form" method="post" action="" id="form">
       <header style="height:auto; width:750px;">
        <table width="100%" height="80" border="0" cellpadding="5" cellspacing="0" style="border-bottom:2px solid #666; border:0px;">
        <tr>
         <td>
             <img src="<?php echo base_url('images/logo.png') ?>" height="120" width="120" />
         </td>
        <td style="text-align:center;">
            <p style="font-size:26px; word-spacing: 10px;">
            OFFICE OF THE MEDICAL SUPERINTENDENT DHQ HOSPITAL UPPER DIR
            </p>  
            <p style="margin-top:-20px;"><strong>Office : </strong> 0944-881012 && 881455 / <strong>Fax : </strong> : 0944-881012</p>
            <p style="margin-top:-10px; margin-left:-130px;"><strong>Email : </strong> msdhqupperdir@yahoo.com</p>
            <p style=" margin-left:300px;">No -------- / MS, Dated : <?php echo date('m') ?> / <?php echo date('Y') ?></p>  
        </td>
     </tr>
     
     </table>
    <div style="width:100%; float:left;">
        <div style="width:20%; float:left; padding-left:10px; text-align:left;">
            To,
        </div> 
       <div class="" style=" float: left; font-size:16px; font-family: monospace; text-transform:uppercase;"><?php echo $inv['supplier'] ?></div>
    </div>

    <div style="width:100%;margin-top:30px; float:left; text-align:left;">
        <div style="width:20%; float:left; padding-left:10px;">
            Subject Memo : 
        </div>
        <div style="width:78%; float:left; font-size:16px; font-family: monospace; text-transform:uppercase; text-decoration:underline;">
       <?php echo $inv['sub_memo'] ?>
        </div>
    </div>


    <div style="width:100%;margin-top:30px; float:left; margin-bottom:30px; text-align:left;">
        
        <div style="width:100%; float:left; font-size:16px; font-family: monospace; padding-left:10px;">
      <?php echo $inv['statement'] ?>
        </div>
    </div>
     
     <table style="border-collapse: collapse; width:100%;">
        <thead>
            <tr>
                <th style="border: 1px solid black;  text-align:left;">S.No</th>
                <th style="border: 1px solid black;  text-align:left;">Item Name</th>
                <th style="border: 1px solid black;  text-align:left;">Trade Name</th>
                <th style="border: 1px solid black;  text-align:left;">Quantity</th>
                <th style="border: 1px solid black;  text-align:left;">Amount</th>
                <th style="border: 1px solid black;  text-align:left;">Discount</th>
                <th style="border: 1px solid black;  text-align:left;">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; $b=''; foreach ($det as $row) { $i++; 
                    $brand=explode('/',$row->name);
                    if(isset($brand[3]))
                    {
                        $b=$brand[3];
                    }
                    else{
                        $b='---';
                    }
                ?>
                
                
             <tr>
                <td style="border: 1px solid black;"><?php echo $i; ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->name ?></td>
                <td  style="border: 1px solid black;"><?php echo $b ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->quantity ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->amount ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->discount." %" ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->sub_total ?></td>
            </tr>
        <?php } ?>
        </tbody>
</table>
       
<div style="float: left;font-size:16px; font-family: monospace; text-transform:uppercase; text-decoration:underline;margin-top: 25px">
    <strong>Note : </strong> Supply order must be treated most urgently.
</div>
<div style="  margin-top:30px;">

</div>

<div style="width:100%; float:left;">
    <div style="width:77%; float:left;">&nbsp;</div>
    <div style="width:23%; float:left;">Medical Superintendent <br> DHQ Hospital Dir Upper</div>
</div>


<div style="width:290; float:left; font-size:16px; font-family: monospace;">
    Copy to the : -------------------
</div>


<div style="width:190; float:left; font-size:16px; font-family: monospace;  clear:both;  margin-top:30px;">
01 : Office Record. 
</div>


<div style="width:100%; float:left;">
    <div style="width:77%; float:left;">&nbsp;</div>
    <div style="width:23%; float:left;">Medical Superintendent <br> DHQ Hospital Dir Upper</div>
</div>


<div style="width:100%; float:left;">
<p style="background-color:#FFF; color:#FFF; border:0px; height:30px; width:100%;" >====================================================</p>
</div>

  </header>



</form>
 
</div>

</center>

</body>
</html> 
<?php     }

}