<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_report extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('All_reportModel');
			date_default_timezone_set('Asia/Karachi');
        }

	public function index()
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
		$page_data['page_name1'] = 'all_report';
		$page_data['page_name'] = 'all_report';
		$page_data['opddata'] = $this->All_reportModel->show($search,$from,$to);
		$page_data['otherdata'] = $this->All_reportModel->show_other($search,$from,$to);
		$page_data['xraydata'] = $this->All_reportModel->show_xray($search,$from,$to);
		$page_data['labdata'] = $this->All_reportModel->show_lab($search,$from,$to);
		$this->load->view('index',$page_data);
	}
public function all_dept_summary()
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
		$type = $this->input->post('type');
		$page_data['page_name1'] = 'all_dept_summary_report';
		$page_data['page_name'] = 'all_dept_summary_report';
		$page_data['opddata'] = $this->All_reportModel->show_summary($search,$from,$to,$type);
		$page_data['otherdata'] = $this->All_reportModel->show_other_summary($search,$from,$to,$type);
		$page_data['xraydata'] = $this->All_reportModel->show_xray_summary($search,$from,$to,$type);
		$page_data['labdata'] = $this->All_reportModel->show_lab_summary($search,$from,$to,$type);
		$this->load->view('index',$page_data);
	}
public function monthly_yearly_report()
	{
		$search=$this->input->post('search');
		$year = $this->input->post('year');


		$January_no = '01';
		$January_name = 'January';
		$page_data['January'] = $this->get_date($year,$January_no,$January_name);

		$February_no = '02';
		$February_name = 'February';
		$page_data['February'] = $this->get_date($year,$February_no,$February_name);

		$March_no = '03';
		$March_name = 'March';
		$page_data['March'] = $this->get_date($year,$March_no,$March_name);

		$April_no = '04';
		$April_name = 'April';
		$page_data['April'] = $this->get_date($year,$April_no,$April_name);

		$May_no = '05';
		$May_name = 'May';
		$page_data['May'] = $this->get_date($year,$May_no,$May_name);

		$June_no = '06';
		$June_name = 'June';
		$page_data['June'] = $this->get_date($year,$June_no,$June_name);

		$July_no = '07';
		$July_name = 'July';
		$page_data['July'] = $this->get_date($year,$July_no,$July_name);

		$August_no = '08';
		$August_name = 'August';
		$page_data['August'] = $this->get_date($year,$August_no,$August_name);

		$September_no = '09';
		$September_name = 'September';
		$page_data['September'] = $this->get_date($year,$September_no,$September_name);

		$October_no = '10';
		$October_name = 'October';
		$page_data['October'] = $this->get_date($year,$October_no,$October_name);

		$November_no = '11';
		$November_name = 'November';
		$page_data['November'] = $this->get_date($year,$November_no,$November_name);

		$December_no = '12';
		$December_name = 'December';
		$page_data['December'] = $this->get_date($year,$December_no,$December_name);

		
		$page_data['dept'] = $this->All_reportModel->showDept();
		$page_data['page_name1'] = 'monthly_yearly_report';
		$page_data['page_name'] = 'monthly_yearly_report';
		$this->load->view('index',$page_data);
}

public function get_date($year,$month_no,$month_name)
{

		$from = date($year.'-'.$month_no.'-01', strtotime($month_name));
        $to =  date($year.'-'.$month_no.'-t', strtotime($month_name));

         
         $from=date_create($from);
         date_add($from,date_interval_create_from_date_string("+8 HOUR"));
         $from =  date_format($from,"Y-m-d H:i:s");



         $to=date_create($to);
         date_add($to,date_interval_create_from_date_string("+32 HOUR"));
         $to = date_format($to,"Y-m-d H:i:s");

        
        return array("from_date"=>$from, "to_date"=>$to);
         
}

}

