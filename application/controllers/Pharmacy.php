<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacy extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('PharmacyModel');
        }


	public function index()
	{
		$page_data['page_name1'] = 'pharmacy-dashboard';
		$page_data['page_name'] = 'pharmacy/pharmacy-dashboard';
		// $page_data['data'] = $this->PharmacyModel->get_patient_indent_invoice();
		$this->load->view('index',$page_data);
	}   

	

	public function patient_indent()
	{
		$this->load->model('ProductModel');
		$page_data['page_name1'] = 'patient-indent';
		$page_data['page_name'] = 'pharmacy/patient-indent';
		$page_data['inv_no'] = $this->PharmacyModel->get_patient_indent_invoice();
		$page_data['items'] = $this->ProductModel->get_items();
        $page_data['getTypes'] = $this->ProductModel->get_type();
		// $page_data['data'] = $this->Users->show();
		$this->load->view('index',$page_data);
	}

    
    public function show_patientInvoices()
    {
          $page_data['page_name1'] = 'show-patientInvoices';
        $page_data['page_name'] = 'pharmacy/show-patientInvoices';
        $page_data['data'] = $this->PharmacyModel->show_patientInvoices();
        $this->load->view('index',$page_data);    
    }

    public function fetch_recept_by_type()
    {
        $id=$this->input->post('med_id');
         $this->PharmacyModel->fetch_recept_by_type($id);
    }
	
	public function save_invoice()
	{
         $med_id='';   
        $med=$this->input->post('med_type');
        if($med !='')
        {
            $med_id=$med;
        }
        else{
            $med_id='0';   
        }
		$data = array('receptNumber' => $this->input->post('inv_id'),
					  'type' => $med_id,	
					  'name' => $this->input->post('patient_name'),	
					  'f_name' => $this->input->post('father_name'),	
					  'id_card' => $this->input->post('card'),	
					  'mobile_no' => $this->input->post('mobile'),	
                      'address' => $this->input->post('distric'),  
					  'sex' => $this->input->post('gander'),
					  'pcr' => '',
					  'last_pcr' => '',
					  'us' => '',
					  'date' => $this->input->post('inv_date')
		 );
		$item_batch = $this->db->escape_str($this->input->post('item_batch'));
		$item_batch = str_replace(" ",'',$item_batch);
         $batch='';
        $expiry='';
		$item_name = $this->input->post('item_name');	
		$item_qty= $this->input->post('item_qty');
		$item_expiry = $this->input->post('item_expiry');	
		$item_comment = $this->input->post('item_comment');	
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
		 $this->PharmacyModel->save_invoice($data,$item_name,$item_qty,$batch,$expiry,$item_comment,$date);
	}

     public function deletePatientInvoice($id)
    {
         $exe="UPDATE patient_indent_invoice SET is_deleted=1 WHERE id='$id'";
          $run=$this->db->query($exe);
         $result=$run->result();    
        if($result)
            {
                $exe="UPDATE patient_invoice_detail SET is_deleted=1 WHERE inv_id='$id'";
                  $this->db->query($exe);
                $this->session->set_flashdata('message', 'Patient Indent Invoice Deleted Successfully');
                redirect('Pharmacy/show_patientInvoices');   
            }
            else
            {
                $this->session->set_flashdata('message', 'Error While Deleting Patient Indent Invoice');
                redirect('Pharmacy/show_patientInvoices');
            }
               
    }

     public function edit_PatientInvoice()
    {
        $id = $this->uri->segment(3); // for getting the id

            $query = $this->db->query("select * from patient_indent_invoice where invoice_id=".$id);
            // echo $query;exit;
            $page_data['record'] = $query->result_array();

            $query = $this->db->query("select * from patient_invoice_detail where inv_id=".$id);
            // echo $query;exit;
            $page_data['record2'] = $query->result();

            // $page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
            //$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

            $page_data['id']=$id;
            $this->load->model('ProductModel');
            $this->load->model('IndentModel');
               $page_data['items'] = $this->ProductModel->get_items();  
        $page_data['getTypes'] = $this->ProductModel->get_type();
            $page_data['page_name1'] = 'edit_PatientInvoice';
            $page_data['page_name'] = 'pharmacy/edit_PatientInvoice';
            $this->load->view('index', $page_data);
    }

     public function update_patientInvoice()
    {
         $med_id='';   
        $med=$this->input->post('med_type');
        if($med !='')
        {
            $med_id=$med;
        }
        else{
            $med_id='0';   
        }
       $data = array('receptNumber' => $this->input->post('inv_id'),
                      'type' => $med_id, 
                      'advoice_by' => $this->input->post('advisor'),    
                      'name' => $this->input->post('patient_name'), 
                      'f_name' => $this->input->post('father_name'),    
                      'id_card' => $this->input->post('card'),  
                      'mobile_no' => $this->input->post('mobile'),  
                      'address' => $this->input->post('distric'),  
                      'sex' => $this->input->post('gander'),
                      'pcr' => '',
                      'last_pcr' => '',
                      'us' => '',
                      'date' => $this->input->post('inv_date')
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
        $date = $this->input->post('date');
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
         $this->PharmacyModel->update_patient_invoice($data,$item_name,$item_qty,$batch,$expiry,$item_comment,$id,$date);
    }

    public function show_advisor()
    {
        $page_data['page_name1'] = 'show-advisor';
        $page_data['page_name'] = 'pharmacy/show-advisor';
        $page_data['data'] = $this->PharmacyModel->get_advisor();
        $this->load->view('index',$page_data);
    }
    public function add_advisor()
    {
        $this->load->model('ProductModel');
          $page_data['page_name1'] = 'add_advisor';
        $page_data['page_name'] = 'pharmacy/add_advisor';
         $this->load->view('index',$page_data);
         if(isset($_POST['save_advisor']))
        {
            // echo 'Ok';exit;
            $name = $this->input->post('advisor_name');
            $type = "Advisor";

            $array = array(

                    'name'=>$name,
                    'type'=>$type
                    
                );

            $model = $this->ProductModel->insert_unit($array);

            if($model)
            {
                $this->session->set_flashdata('message', 'Advisor Added Successfully');
                redirect('Pharmacy/show_advisor');
            }
            else
            {
                $this->session->set_flashdata('message', 'Error While Adding Advisor');
                redirect('Pharmacy/show_advisor');
            }
        }
    }
    public function delete_advisor($id)
    {
        $this->db->where('id',$id);

        $result =$this->db->delete('groups');
            
        if($result)
            {
                $this->session->set_flashdata('message', 'Advisor Deleted Successfully');
                redirect('Pharmacy/show_advisor');  
            }
            else
            {
                $this->session->set_flashdata('message', 'Error While Deleting Advisor');
                redirect('Pharmacy/show_advisor');
            }
    }

    public function edit_advisor($id)
    {
        if(isset($_POST['update_advisor']))
        {
                $name = $this->input->post('name');
                $type = "Advisor";

                $array = array(

                        'name'=>$name,
                        'type'=>$type
                        
                    );

                $page_data['record'] = $this->db->where('id', $id);
            $page_data['record'] = $this->db->update('groups', $array);
            $page_data['id']=$id;

            // $page_data['page_name'] = 'pharmacy/edit_type';
            $this->load->view('index', $page_data);
            $this->session->set_flashdata('message', 'Update Successfully');
            redirect('Pharmacy/show_advisor');
        }
        else
        {

            $id = $this->uri->segment(3); // for getting the id

            $query = $this->db->query("select * from groups where id=".$id);
            $page_data['record'] = $query->result_array();
            // $this->load->model('IndentModel');
            // $page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
            //$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

            $page_data['id']=$id;
            $page_data['page_name1'] = 'edit_advisor';
            $page_data['page_name'] = 'pharmacy/edit_advisor';
            $this->load->view('index', $page_data);
        }
    }


	public function print_invoice()
	{
		 $inv_id=$this->input->post('inv_id');
		$det= $this->PharmacyModel->print_invoice_detail($inv_id);
        $inv= $this->PharmacyModel->print_invoice($inv_id);
?>
	

<!DOCTYPE html>

<html lang="en">
  
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Print</title>

<!-- <link rel="stylesheet" type="text/css" href="assets/css/print.css"/> -->





<style type="text/css">
  body{
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
  }


</style>

</head>

<body>

<div id="container" style="width:850px;margin-left: 100px;">
<form name="form" method="post" action="" id="form">
       <header style="height:auto; width:750px;">
        <table width="100%" height="80" border="0" cellpadding="5" cellspacing="0" style="border-bottom:2px solid #666; border:0px;">
        <tr>
         <td>
             <img src="../images/logo.png" height="120" width="120" />
         </td>
        <td style="text-align:center;">
            <p style="font-size:26px; font-weight:bold; word-spacing: 4px;">
            DISTRICT HEAD QUARTER HOSPITAL UPPER DIR
            </p>  
            <!-- -->
            
        </td>
     </tr>
     
     </table>
     <table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-bottom:2px solid #666; border:1px solid #999; margin-top:5px;margin-bottom:10px;">

        <thead>

            <tr>
                
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Patient Name : </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"> <?php  echo $inv->name; ?></th>
                
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Father Name &nbsp;: </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"> <?php  echo $inv->f_name; ?></th>
                </tr>
                <tr>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">ID Card &nbsp;&nbsp;&nbsp;&nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;"> <?php  echo $inv->id_card; ?></th>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Mobile # &nbsp;&nbsp;&nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"> <?php echo $inv->mobile_no ?></th>
                </tr>
                <tr>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Date &nbsp; &nbsp; &nbsp; &nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;"><?php echo date('Y-m-d') ?></th>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Slip # &nbsp; &nbsp; &nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"> <?php  echo $inv->receptNumber; ?></th>
                </tr>
                
                <tr>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Type &nbsp; &nbsp; &nbsp; &nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;">General</th>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Date &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;: </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"><?php echo date('Y-m-d') ?></th>    

                </tr>
            
               
        </thead>
         </table>
     <table style="border-collapse: collapse; width:100%;">
        <thead>
            <tr>
                <th style="border: 1px solid black;  text-align:left;">S.No</th>
                <th style="border: 1px solid black;  text-align:left;">Medicines Name</th>
                <th style="border: 1px solid black;  text-align:left;">Quantity</th>
                <th style="border: 1px solid black;  text-align:left;">Comment</th>
                <th style="border: 1px solid black;  text-align:left;">Date</th>
            </tr>
        </thead>

        <tbody>
        	<?php $count=0; foreach($det as $row){

             $count++; ?>
    <tr>
                <td style="border: 1px solid black;"><?php echo $count; ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->name; ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->quantity; ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->comment; ?></td>
                <td  style="border: 1px solid black;"><?php echo $row->date; ?></td>
            </tr>
			<?php } ?>
        </tbody>
     </table>







<div style="width:100%; float:left;margin-top: 20px;" >
<a style="background-color:#FFF; color:#FFF; border:0px; height:30px; width:100%;" href="patient_invoice.php">=====================================================================</a>
</div>

  </header>



</form>
 
</div>


</body>
</html>
	<?php 
}
		
}