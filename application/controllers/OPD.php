<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OPD extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('OpdModel');
			$this->load->model('OPD_Mdl_report');
        }


	public function index($dept_id)
	{
		date_default_timezone_set('Asia/Karachi');
		$page_data['page_name1'] = 'opd_entry';
		$page_data['page_name'] = 'opd_entry';
		$page_data['nick'] = $this->OpdModel->get_nick($dept_id);
		$page_data['inv_no'] = $this->OpdModel->get_opd_invoice($dept_id);
		$page_data['districts'] = $this->OpdModel->get_districts();
		$page_data['query'] =$this->OPD_Mdl_report->today_opd_report($dept_id);
		$this->load->view('index',$page_data);	
	}

	public function add()
	{
		date_default_timezone_set('Asia/Karachi');
		$receptNumber=explode('-',$this->input->post('receptNumber'));
		$data = array('receptNumber' =>$receptNumber[2],
					  'yearly_no'=>$receptNumber[1],	
					  'type' => $this->input->post('type'),
					  'patient_name' => $this->input->post('name'),	
					  'age' => $this->input->post('age'),	
					  'gander' => $this->input->post('gander'),		
					  'address' => $this->input->post('address'),	
					  'date' => date('Y-m-d H:i:s'),
					  'dated' => date('Y-m-d'),	
					  'dept_id' => $this->input->post('dept_id'),	
					  'user_id' => $this->session->userdata('user_id'),	
					  'shift' => $this->input->post('shift'),	
					  'price' => $this->input->post('price'),	
						);

		$this->session->set_userdata('receptNumber',$receptNumber[2]);
		$this->session->set_userdata('yearly_no',$receptNumber[1]);
		$query=$this->OpdModel->insert_opd($data);
	}

	public function opd_print($dept_id)
	{
		date_default_timezone_set('Asia/Karachi');
		$receptNumber=$this->session->userdata('receptNumber');
		$yearly_no=$this->session->userdata('yearly_no');
		$data['nick'] = $this->OpdModel->get_dep_nick($dept_id);
		$data['query']=$this->OpdModel->get_opd_invoice_by_id($receptNumber,$yearly_no,$dept_id);
		$this->load->view('opd_print',$data);
	}
}
