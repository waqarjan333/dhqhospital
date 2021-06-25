<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class XRAY extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            date_default_timezone_set('Asia/Karachi');
			$this->load->model('XrayModel');
			$this->load->model('XRAY_Mdl_report');
        }

	public function index($dept_id)
	{
		
		
		$page_data['page_name1'] = 'xray_entry';
		$page_data['page_name'] = 'xray_entry';
		$page_data['nick'] = $this->XrayModel->get_nick($dept_id);
		$page_data['inv_no'] = $this->XrayModel->get_xray_invoice($dept_id);
		$page_data['districts'] = $this->XrayModel->get_districts();
		$page_data['xray_types'] = $this->XrayModel->get_xray_types();
		$page_data['query'] = $this->XRAY_Mdl_report->today_xray_report($dept_id);
		$this->load->view('index',$page_data);	
	}

	public function add()
	{
		
		
		$receptNumber=explode('-',$this->input->post('receptNumber'));
		$data = array('receptNumber' =>$receptNumber[2],
					  'patient_name' => $this->input->post('name'),
					  'yearly_no' => $receptNumber[1],
					  'refrence' => $this->input->post('refrence'),	
					  'age' => $this->input->post('age'),	
					  'gander' => $this->input->post('gander'),		
					  'address' => $this->input->post('address'),	
					  'date' => date('Y-m-d H:i:s'),
					  'dated' => date('Y-m-d'),	
					  'dept_id' => $this->input->post('dept_id'),	
					  'user_id' => $this->session->userdata('user_id'),	
					  'shift' => $this->input->post('shift'),	
					  'quantity' => $this->input->post('quantity'),	
					  'price' => $this->input->post('quantity')*150,
					  'sync_status' =>0,
					  'type' => $this->input->post('type'),
					  'print' =>1
						);
		$dept_id = $this->input->post('dept_id');
		$this->session->set_userdata('receptNumber',$receptNumber[2]);
		$this->session->set_userdata('yearly_no',$receptNumber[1]);
		$this->session->set_userdata('dept_id',$this->input->post('dept_id'));
	 
	    $this->db->query("DELETE FROM xray_entry WHERE receptNumber='$receptNumber[2]' AND dept_id='$dept_id' AND yearly_no='$receptNumber[1]'");


		$query=$this->XrayModel->insert_xray($data);

		$this->db->query("DELETE FROM xray_entry_details WHERE entry_id='$receptNumber[2]' AND yearly='$receptNumber[1]'");
		$xray_types = $this->input->post('xray_types');

		$xray_details = array();
		foreach ($xray_types as $key => $value) {
			 $xray_details['entry_id']=$receptNumber[2];
			 $xray_details['xray_type_id']=$value;
			 $xray_details['year_no']=$receptNumber[1];
			 $xray_details['is_deleted']=0;

			$query=$this->XrayModel->insert_xray_details($xray_details);

		}
	}

	

	public function xray_print()
	{
		
		$receptNumber=$this->session->userdata('receptNumber');
		$yearly_no=$this->session->userdata('yearly_no');
		$dept_id=$this->session->userdata('dept_id');
		$data['query']=$this->XrayModel->get_xray_invoice_by_id($receptNumber,$yearly_no,$dept_id);
		$this->load->view('xray_print',$data);
	}

	public function xray_opd_edit()
	{
       	$page_data['page_name1'] = 'edit_xray';
		$page_data['page_name'] = 'edit_xray';
       	$this->load->view('index',$page_data);
	}

		public function update()
	{
		$date=$this->input->post('testDate');
		
		$receptNumber=explode('-',$this->input->post('receptNumber'));
		$data = array(
					  'receptNumber' => $receptNumber[2],
					  'yearly_no' => $receptNumber[1],
					  'refrence' => $this->input->post('refrence'),	
					  'patient_name' => $this->input->post('name'),	
					  'age' => $this->input->post('age'),	
					  'gander' => $this->input->post('gander'),		
					  'address' => $this->input->post('address'),	
					  'quantity' => $this->input->post('quantity'),	
					  'price' => $this->input->post('quantity')*150,
					  'type' => $this->input->post('type')
					 );

		$query=$this->XrayModel->update_xray($data);

		$this->db->query("DELETE FROM xray_entry_details WHERE entry_id='$receptNumber[2]' AND year_no='$receptNumber[1]'");
		

		$xray_types = $this->input->post('xray_types');

		$xray_details = array();
		foreach ($xray_types as $key => $value) {
			 $xray_details['entry_id']=$receptNumber[2];
			 $xray_details['xray_type_id']=$value;
			 $xray_details['year_no']=$receptNumber[1];
			 $xray_details['is_deleted']=0;

			$query=$this->XrayModel->insert_xray_details($xray_details);

		}
	}

}
