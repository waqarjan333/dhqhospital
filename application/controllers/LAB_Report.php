<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LAB_Report extends CI_Controller {
public function __construct()
        {
            parent::__construct();
            date_default_timezone_set('Asia/Karachi');
			$this->load->model('LAB_Mdl_report');
			$this->load->model('LabModel');


        }
public function index()
	{
		
		$this->load->model('LAB_Mdl_report');
		$search=$this->input->post('search');

		$recept=$this->input->post('recept');
		$p_name=$this->input->post('p_name');
		$gendar=$this->input->post('gander');
		$shift=$this->input->post('shift');
		$dept_id = $this->input->post('dept_id');
		$search_type = $this->input->post('type');

		$data['getDept']=$this->LAB_Mdl_report->getDept();
		$data['query']=$this->LAB_Mdl_report->get_today_record($search,$recept,$p_name,$gendar,$shift,$dept_id,$search_type);

		$data['search']=$search;

		$data['page_name1'] = 'today_LAB_report';
		$data['page_name'] = 'today_LAB_report';
		$this->load->view('index',$data);
	}

public function dailly_summary_report()
	{

		
		

		$data['getDept']=$this->LAB_Mdl_report->getDept();
		$data['page_name1'] = 'dailly_LAB_summary_report';
		$data['page_name'] = 'dailly_LAB_summary_report';
		$this->load->view('index',$data);
	}
	
	public function all_report()
	{
		
		$this->load->model('LAB_Mdl_report');
		$search=$this->input->post('search');
		$to = $from = "";
		if($this->input->post('from')!=''){
			$from = date("Y-m-d", strtotime($this->input->post('from')));
		} else {
			$from = $this->input->post('from');
		}

		if($this->input->post('to')!=''){
			$to = date("Y-m-d", strtotime($this->input->post('to')));
		} else {
			$to = $this->input->post('to');
		}
		$search_dept_report = $this->input->post('dept_id');
		$gendar=$this->input->post('gander');
		$shift=$this->input->post('shift');
		$type=$this->input->post('type');

		$data['getDept']=$this->LAB_Mdl_report->getDept();
		$data['query'] = $this->LAB_Mdl_report->all_lab_report($search,$from,$to,$gendar,$shift,$type,$search_dept_report);

		$data['page_name1'] = 'LAB_report';
		$data['page_name'] = 'LAB_report';
		$this->load->view('index',$data);
	}

		public function all_report_for_print()
	{
		
		$this->load->model('LAB_Mdl_report');
		$search=$this->input->post('search');
		$to = $from = "";
		if($this->input->post('from')!=''){
			$from = date("Y-m-d", strtotime($this->input->post('from')));
		} else {
			$from = $this->input->post('from');
		}

		if($this->input->post('to')!=''){
			$to = date("Y-m-d", strtotime($this->input->post('to')));
		} else {
			$to = $this->input->post('to');
		}
		$search_dept_report = $this->input->post('search_dept_report');
		$gendar=$this->input->post('gander');
		$shift=$this->input->post('shift');
		$type=$this->input->post('type');

		$data['getDept']=$this->LAB_Mdl_report->getDept();
		$data['query'] = $this->LAB_Mdl_report->all_lab_report($search,$from,$to,$gendar,$shift,$type,$search_dept_report);

		$data['page_name1'] = 'LAB_report_for_print';
		$data['page_name'] = 'LAB_report_for_print';
		$this->load->view('index',$data);
	}

	public function get_invoice()
	{
		$entryid=$this->input->post('entryid');
		$yearly_no=$this->input->post('yearly_no');
		$dept_id=$this->input->post('dept_id');
		$query_lab_entry = $this->db->query("select * from lab_entry where is_deleted=0 AND dept_id='$dept_id' AND yearly_no='$yearly_no' AND receptNumber=".$entryid);
		$res_lab_entry =  $query_lab_entry->result_array();

		$query_lab_districts = $this->db->query("select * from districts where id=".$res_lab_entry[0]['address']);
		$res_lab_districts =  $query_lab_districts->result_array();

	$query_lab_details = $this->db->query("select * from lab_entry_details where is_deleted=0 AND dept_id='$dept_id' AND yearly='$yearly_no' AND entry_id=".$entryid);
	$res_lab_details =  $query_lab_details->result();

	$get_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$res_lab_entry[0]['dept_id'])->get()->result_array();  
		$html = '';
		$total_test = 0;
		$sub_total = 0;		
	
		 $html = '<div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          <address>
            <strong>Patient Name : '. ucfirst($res_lab_entry[0]['patient_name']).'</strong><br>
            <b>Age:</b> '.$res_lab_entry[0]['age'].'<br>
            <b>Gender:</b> '.$res_lab_entry[0]['gander'].'<br>
            <b>Address:</b> '.$res_lab_districts[0]['name'].'<br>
          </address> 	
        </div>
        <div class="col-sm-6 invoice-col">
          <b>Receipt Number # '.$get_Dept[0]['dept_nick'].'-'.$res_lab_entry[0]['yearly_no'].'-'.$res_lab_entry[0]['receptNumber'].'</b><br>
          <b>Shift:</b> '.$res_lab_entry[0]['shift'].'<br>
          <b>Date And Time:</b> '.date('d/m/Y h:i:A',strtotime($res_lab_entry[0]['date'])).'<br>
          <b>Refrence #:</b> '.$res_lab_entry[0]['refrence'].'<br>
          <b>Department :</b> '.$get_Dept[0]['dep_name'].'<br>
        </div>
      </div>
                <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Test</th>
              <th>Price</th>
            </tr>
            </thead>
            <tbody>';
            foreach($res_lab_details as $value) {

    $query_lab_type = $this->db->query("select * from testcategories where id=".$value->test_id);
	$res_lab_type =  $query_lab_type->result_array();

	$sub_total += $res_lab_type[0]['price'];
	$total_test++;




 			$html .='<tr>
			<td>'.$res_lab_type[0]['name'].'</td>
			<td>'.$res_lab_type[0]['price'].'</td>
			</tr>';          			
             }
            $html .='</tbody>
          </table>
        </div>
      </div>
                <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total Test:</th>
                <td>'.$total_test.'</td>
              </tr>
              <tr>
                <th>Total Amount:</th>
                <td>'.$sub_total.'/=</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
                 <div class="row no-print">
        <div class="col-xs-12">
          <a href="'.base_url('LAB_Report/lab_print_report/'.$get_Dept[0]['id'].'/'.$res_lab_entry[0]['receptNumber'].'/'.$res_lab_entry[0]['yearly_no']).'" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>';
      echo $html;
	}

	public function getPrintTest()
	{
		$test=$this->input->post('test_id');
		$yearly_no=$this->input->post('yearly_no');
		$html='';
	 $html = '<table class="table table-striped">
            <thead>
            <tr>
              <th>Select</th>	
              <th>Test</th>
              <th></th>
            </tr>
            </thead>
            <tbody>';
   $sql_lab_test = "SELECT * FROM `lab_entry_details` INNER JOIN testcategories On(lab_entry_details.test_id = testcategories.id) AND lab_entry_details.entry_id= '$test' WHERE lab_entry_details.is_deleted=0 AND lab_entry_details.yearly=".$yearly_no;
            $query_lab_test = $this->db->query($sql_lab_test);
foreach($query_lab_test->result() as $row_lab_test){
 			$html .='<tr>
 			<td><input type="checkbox" class="checkhour" id="test" value="'.$row_lab_test->test_id.'" name="test"></td>
			<td>'.$row_lab_test->name.'</td>
			<td><button class="btn btn-primary" data-id="'.$row_lab_test->test_id.'" id="printSpecificTest">Print</button></td>
			</tr>'; 
			}         			
            $html .='</tbody>
            <tfoot>
			<tr>
			<td><button class="btn btn-info" id="PrintMultiple">Specific Print</button></td>
			<td><button class="btn btn-success" id="PrintAll">Print All</button></td>
			</tr>		
            </tfoot>
          </table>
        </div>
      </div>
       <div >
      </div>';
      echo $html;	
	}
	public function lab_print_report($dept_id,$receptNumber,$yearly_no)
	{
		
		$data['query']=$this->LAB_Mdl_report->get_lab_invoice_by_id($dept_id,$receptNumber,$yearly_no);
		$this->load->view('lab_print',$data);
	}

	public function lab_print_report_delete($id)
	{
		$this->LAB_Mdl_report->lab_print_report_delete($id);
		redirect('LAB_Report/');
	}

	public function lab_print_report_delete_all($receptNumber,$yearly_no)
	{
		$this->LAB_Mdl_report->lab_print_report_delete($receptNumber,$yearly_no);
		redirect('LAB_Report/all_report');
	}
	
	public function test_wise_report()
	{
		$search=$this->input->post('search');
		$to = $from = "";
		if($this->input->post('from')!=''){
			$from = date("Y-m-d", strtotime($this->input->post('from')));
		} else {
			$from = $this->input->post('from');
		}

		if($this->input->post('to')!=''){
			$to = date("Y-m-d", strtotime($this->input->post('to')));
		} else {
			$to = $this->input->post('to');
		}
		$test_id=$this->input->post('test_id');
		$dept_id=$this->input->post('dept_id');
		$data['from_date'] = $from;
		$data['to_date'] = $to;
		$data['dept_id'] = $dept_id;
		$data['query'] = $this->LAB_Mdl_report->test_wise_report($search,$from,$to,$test_id,$dept_id);
		$data['tests'] = $this->LabModel->get_tests();
		$data['getDept']=$this->LAB_Mdl_report->getDept();
		$data['page_name1'] = 'test_wise_report';
		$data['page_name'] = 'test_wise_report';
		$this->load->view('index',$data);
	}

	public function revinew_invoice()
	{
		$data['result_array'] = array();
		
		$this->load->model('LAB_Mdl_report');
		$data['getDept']=$this->LAB_Mdl_report->getDept();

		$search = $this->input->post('search');

		if (isset($search)) {
			$date = date("Y-m-d", strtotime($this->input->post('date')));
			$shift = $this->input->post('shift');
			$dept_id=$this->input->post('dept_id');
			$data['getDeptPrice']=$this->LAB_Mdl_report->getDeptPrice($dept_id); 
			$data['dept_name'] = $data['getDeptPrice'][0]->dep_name;
			$data['dept_price'] = $data['getDeptPrice'][0]->dept_price;
		    $data['result_array']  = $this->LAB_Mdl_report->revinew_invoice($dept_id,$date,$shift);
	    }
		
		$data['page_name1'] = 'lab_revinew_invoice_report';
		$data['page_name'] = 'lab_revinew_invoice_report';


		$this->load->view('index',$data);
	}
	public function lab_revinew_invoice_print_report($date,$dept_id,$shift)
	{
		
		$this->load->model('LAB_Mdl_report');

		 $data['getDeptPrice']=$this->LAB_Mdl_report->getDeptPrice($dept_id); 
		 $data['dept_name'] = $data['getDeptPrice'][0]->dep_name;
		 $data['dept_price'] = $data['getDeptPrice'][0]->dept_price;
		 
		 $data['result_array']  = $this->LAB_Mdl_report->revinew_invoice($dept_id,$date,$shift);
		 $data['date'] = $date;
		 $data['shift'] = $shift;
		$this->load->view('lab_revinew_invoice_print',$data);
	}
	public function opd_print_report($idss,$id)
	{
		
		$user_id=$this->session->userdata('user_id');
		$data['nick'] = $this->LAB_Mdl_report->get_dep_nick($idss);
		$data['query']=$this->LAB_Mdl_report->get_opd_invoice_by_id($id,$user_id,$idss);
		$this->load->view('opd_print',$data);
	}

	public function patient_test_report()
	{
		
		$this->load->model('LAB_Mdl_report');
		$search=$this->input->post('search');
		$to = $from = "";
		if($this->input->post('from')!=''){
			$from = date("Y-m-d", strtotime($this->input->post('from')));
		} else {
			$from = $this->input->post('from');
		}

		if($this->input->post('to')!=''){
			$to = date("Y-m-d", strtotime($this->input->post('to')));
		} else {
			$to = $this->input->post('to');
		}
		$gendar=$this->input->post('gander');
		$shift=$this->input->post('shift');
		$type=$this->input->post('type');
		$test=$this->input->post('test');

		$data['getDept']=$this->LAB_Mdl_report->getDept();
		$data['tests'] = $this->LabModel->get_tests();
		$data['query'] = $this->LAB_Mdl_report->patient_test_report($search,$from,$to,$gendar,$shift,$type,$test);

		$data['page_name1'] = 'patient_test_report';
		$data['page_name'] = 'patient_test_report';
		$this->load->view('index',$data);
	}
}
