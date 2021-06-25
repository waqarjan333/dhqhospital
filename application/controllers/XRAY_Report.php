<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class XRAY_Report extends CI_Controller {
public function __construct()
        {
            parent::__construct();
			$this->load->model('XRAY_Mdl_report');
			$this->load->model('XrayModel');

        }
public function index()
	{
		date_default_timezone_set('Asia/Karachi');
		$this->load->model('XRAY_Mdl_report');
		$search=$this->input->post('search');

		$recept=$this->input->post('recept');
		$p_name=$this->input->post('p_name');
		$gendar=$this->input->post('gander');
		$shift=$this->input->post('shift');
		$type=$this->input->post('type');
		$search_dept_report = $this->input->post('search_dept_report');
		$data['getDept']=$this->XRAY_Mdl_report->getDept();
		$data['query']=$this->XRAY_Mdl_report->get_today_record($search,$recept,$p_name,$gendar,$shift,$search_dept_report,$type);

		$data['search']=$search;

		$data['page_name1'] = 'today_XRAY_report';
		$data['page_name'] = 'today_XRAY_report';
		$this->load->view('index',$data);
	}

public function dailly_summary_report()
	{

		date_default_timezone_set('Asia/Karachi');
		
		$data['page_name1'] = 'dailly_XRAY_summary_report';
		$data['page_name'] = 'dailly_XRAY_summary_report';
		$this->load->view('index',$data);
	}
	
	public function all_report()
	{
		date_default_timezone_set('Asia/Karachi');
		$this->load->model('XRAY_Mdl_report');
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
		$shift=$this->input->post('shift');
		$gander=$this->input->post('gander');
		$type=$this->input->post('type');
		$data['getDept']=$this->XRAY_Mdl_report->getDept();
		$data['query'] = $this->XRAY_Mdl_report->all_xray_report($search,$from,$to,$gander,$shift,$type);

		$data['page_name1'] = 'XRAY_report';
		$data['page_name'] = 'XRAY_report';
		$this->load->view('index',$data);
	}
	public function xray_types()
	{
		date_default_timezone_set('Asia/Karachi');
		$this->load->model('XRAY_Mdl_report');
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
		$search=$this->input->post('search');
		$shift=$this->input->post('shift');
		$gander=$this->input->post('gander');
		$xray_type=$this->input->post('xray_type');

		$data['searchDateFrom'] = $from;
		$data['searchDateTo'] = $to;
		$data['searchDateshift'] = $shift;
		$data['searchDategander'] = $gander;
		$data['xray_types'] = $this->XrayModel->get_xray_types();
		$data['xray_report'] = $this->XRAY_Mdl_report->get_report_xray($search,$from,$to,$shift,$gander,$xray_type);
		
		$data['page_name1'] = 'xray_type_report';
		$data['page_name'] = 'xray_type_report';
		$this->load->view('index',$data);
	}
	public function get_invoice()
	{
		$entryid=$this->input->post('entryid');
		$yearly_no=$this->input->post('yearly_no');

		$query_xray_entry = $this->db->query("select * from xray_entry where receptNumber=".$entryid." AND yearly_no=".$yearly_no);
		$res_xray_entry =  $query_xray_entry->result_array();

		$query_xray_districts = $this->db->query("select * from districts where id=".$res_xray_entry[0]['address']);
		$res_xray_districts =  $query_xray_districts->result_array();

	$query_xray_details = $this->db->query("select * from xray_entry_details where entry_id=".$entryid." AND year_no=".$yearly_no);
	$res_xray_details =  $query_xray_details->result();

	$get_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$res_xray_entry[0]['dept_id'])->get()->result_array();  


		$html = '';
		$total_films = 0;
		$sub_total = 0;		
	
		 $html = '<div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          Patient Info
          <address>
            <strong>'. ucfirst($res_xray_entry[0]['patient_name']).'</strong><br>
            <b>Age:</b> '.$res_xray_entry[0]['age'].'<br>
            <b>Gender:</b> '.$res_xray_entry[0]['gander'].'<br>
            <b>Address:</b> '.$res_xray_districts[0]['name'].'<br>
          </address> 	
        </div>
        <div class="col-sm-6 invoice-col">
          <b>Receipt Number #'.$get_Dept[0]['dept_nick'].'-'.$res_xray_entry[0]['yearly_no'].'-'.$res_xray_entry[0]['receptNumber'].'</b><br>
          <b>Shift:</b> '.$res_xray_entry[0]['shift'].'<br>
          <b>Date And Time:</b> '.date('d/m/Y h:i:A',strtotime($res_xray_entry[0]['date'])).'<br>
          <b>Ref # : </b> '.$res_xray_entry[0]['refrence'].'<br>
        </div>
      </div>
                <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Type</th>
            </tr>
            </thead>
            <tbody>';
            foreach($res_xray_details as $value) {

    $query_xray_type = $this->db->query("select * from xray_type where id=".$value->xray_type_id);
	$res_xray_type =  $query_xray_type->result_array();

	// $total_films += $value->quantity;
	$sub_total = $res_xray_entry[0]['price'];




 			$html .='<tr>
			<td>'.$res_xray_type[0]['name'].'</td>
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
                <th style="width:50%">Total Films:</th>
                <td>'.$res_xray_entry[0]['quantity'].'</td>
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
          <a href="'.base_url('XRAY_Report/xray_print_report/'.$get_Dept[0]['id'].'/'.$res_xray_entry[0]['receptNumber'].'/'.$res_xray_entry[0]['yearly_no']).'" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>';
      echo $html;
	}


	public function xray_print_report($dept_id,$receptNumber,$yearly_no)
	{
		date_default_timezone_set('Asia/Karachi');
		$data['query']=$this->XRAY_Mdl_report->get_xray_invoice_by_id($dept_id,$receptNumber,$yearly_no);
		$this->load->view('xray_print',$data);
	}


	public function xray_print_report_delete($id)
	{
		$this->XRAY_Mdl_report->xray_print_report_delete($id);
		redirect('XRAY_Report/');
	}

	public function xray_print_report_delete_all($receptNumber,$yearly_no)
	{
		$this->XRAY_Mdl_report->xray_print_report_delete($receptNumber,$yearly_no);
		redirect('XRAY_Report/all_report');
	}

	public function xray_revinew_invoice_print_report($date,$dept_id,$shift)
	{
		date_default_timezone_set('Asia/Karachi');
		$this->load->model('XRAY_Mdl_report');

		 $data['getDeptPrice']=$this->XRAY_Mdl_report->getDeptPrice($dept_id); 
		 $data['dept_name'] = $data['getDeptPrice'][0]->dep_name;
		 $data['dept_price'] = $data['getDeptPrice'][0]->dept_price;
		 
		 $data['result_array']  = $this->XRAY_Mdl_report->revinew_invoice($dept_id,$date,$shift);
		 $data['date'] = $date;
		 $data['shift'] = $shift;
		$this->load->view('xray_revinew_invoice_print',$data);
	}

	public function revinew_invoice()
	{
		$data['result_array'] = array();
		date_default_timezone_set('Asia/Karachi');
		$data['getDept']=$this->XRAY_Mdl_report->getDept();

		$search = $this->input->post('search');

		if (isset($search)) {

		$date = date("Y-m-d", strtotime($this->input->post('date')));
		$shift = $this->input->post('shift');
		$dept_id=$this->input->post('dept_id');
		$data['getDeptPrice']=$this->XRAY_Mdl_report->getDeptPrice($dept_id); 
		$data['dept_name'] = $data['getDeptPrice'][0]->dep_name;
		$data['dept_price'] = $data['getDeptPrice'][0]->dept_price;
	    $data['result_array']  = $this->XRAY_Mdl_report->revinew_invoice($dept_id,$date,$shift);
	    }
		
		$data['page_name1'] = 'xray_revinew_invoice_report';
		$data['page_name'] = 'xray_revinew_invoice_report';


		$this->load->view('index',$data);
	}
}
