<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OPD_Report extends CI_Controller {
public function __construct()
	{
            parent::__construct();
            date_default_timezone_set('Asia/Karachi');
			$this->load->model('OPD_Mdl_report');
			$this->load->model('OpdModel');
			$this->load->helper('file');
        }
public function index()
	{
		$search=$this->input->post('search');

		$recept=$this->input->post('recept');
		$p_name=$this->input->post('p_name');
		$shift=$this->input->post('shift');
		$gendar=$this->input->post('gander');
		$search_dept_report = $this->input->post('search_dept_report');
		$type=$this->input->post('type');
		

		$data['getDept']=$this->OPD_Mdl_report->getDept();
		$data['query']=$this->OPD_Mdl_report->get_today_record($search,$recept,$p_name,$shift,$gendar,$search_dept_report,$type);

		$data['search']=$search;

		$data['page_name1'] = 'today_OPD_report';
		$data['page_name'] = 'today_OPD_report';

		
		$this->load->view('index',$data);
	}

public function dailly_summary_report()
	{
		
		$data['getDept']=$this->OPD_Mdl_report->getDept();
		$data['page_name1'] = 'dailly_OPD_summary_report';
		$data['page_name'] = 'dailly_OPD_summary_report';
		$this->load->view('index',$data);
	}
public function all_report()
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

		$gendar=$this->input->post('gander');
		$shift=$this->input->post('shift');
		$type=$this->input->post('type');
		$dept_id = $this->input->post('dept_id');
		$data['getDept']=$this->OPD_Mdl_report->getDept();
		$data['query'] =$this->OPD_Mdl_report->all_opd_report($search,$from,$to,$gendar,$shift,$dept_id,$type);

		$data['page_name1'] = 'OPD_report';
		$data['page_name'] = 'OPD_report';
		$this->load->view('index',$data);
	}
public function shift_gender()
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
		
		$type=$this->input->post('type');
		$dept_id = $this->input->post('dept_id');
		$data['getDept']=$this->OPD_Mdl_report->getDept();
		$data['query'] = $this->OPD_Mdl_report->shift_gender($search,$from,$to,$type,$dept_id);

		$data['page_name1'] = 'opd_shift_gender_report';
		$data['page_name'] = 'opd_shift_gender_report';
		$this->load->view('index',$data);
	}
public function opd_print_report($dept_id,$receptNumber,$yearly_no)
	{
		date_default_timezone_set('Asia/Karachi');
		$data['nick'] = $this->OpdModel->get_dep_nick($dept_id);
		$data['query']=$this->OpdModel->get_opd_invoice_by_id($receptNumber,$yearly_no,$dept_id);
		$this->load->view('opd_print',$data);
	}
public function revinew_invoice()
	{
		$data['result_array'] = array();
		$data['getDept']=$this->OPD_Mdl_report->getDept();

		$search = $this->input->post('search');
		if (isset($search)) {
			$date = date("Y-m-d", strtotime($this->input->post('date')));
			$shift = $this->input->post('shift');
			$dept_id=$this->input->post('dept_id');
			$data['getDeptPrice']=$this->OPD_Mdl_report->getDeptPrice($dept_id); 
			$data['dept_name'] = $data['getDeptPrice'][0]->dep_name;
			$data['dept_price'] = $data['getDeptPrice'][0]->dept_price;
			$data['dept_id'] = $dept_id; 		
			$data['result_array']  = $this->OPD_Mdl_report->revinew_invoice($dept_id,$date,$shift);
		}
		$data['page_name1'] = 'opd_revinew_invoice_report';
		$data['page_name'] = 'opd_revinew_invoice_report';

		$this->load->view('index',$data);
	}
public function opd_revinew_invoice_print_report($date,$dept_id,$shift)
	{

	     $data['getDeptPrice']=$this->OPD_Mdl_report->getDeptPrice($dept_id); 
		 $data['dept_name'] = $data['getDeptPrice'][0]->dep_name;
		 $data['dept_price'] = $data['getDeptPrice'][0]->dept_price;
		 $data['result_array'] = $this->OPD_Mdl_report->revinew_invoice($dept_id,$date,$shift);
		 $data['date'] = $date;
		 $data['shift'] = $shift;

		 $this->load->view('opd_revinew_print',$data);
	}


	public function opd_delete_report($idss,$id)
	{
		$query=$this->OPD_Mdl_report->opd_delete_report($idss,$id);
		redirect('OPD_Report/');
	}

	public function opd_delete_report_all($dept_id,$receptNumber,$yearly_no)
	{
		$query=$this->OPD_Mdl_report->opd_delete_report($dept_id,$receptNumber,$yearly_no);
		redirect('OPD_Report/all_report');
	}
}
