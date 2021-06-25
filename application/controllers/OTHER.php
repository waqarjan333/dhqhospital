<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OTHER extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('OtModel');
			$this->load->model('OTHER_Mdl_report');
        }


	public function index($dept_id)
	{
		date_default_timezone_set('Asia/Karachi');

		$page_data['page_name1'] = 'other_entry';
		$page_data['page_name'] = 'other_entry';
		$page_data['nick'] = $this->OtModel->get_nick($dept_id);
		$page_data['inv_no'] = $this->OtModel->get_other_invoice($dept_id);
		$page_data['districts'] = $this->OtModel->get_districts();
		$page_data['query']=$this->OTHER_Mdl_report->today_other_report($dept_id);
		$this->load->view('index',$page_data);	
	}

	public function getPriceOFSubDept($id)
	{
		$this->db->select('dept_price');
		$this->db->where('id',$id);
		$price = $this->db->get('departments')->result_array();

		echo $price[0]['dept_price'];
	}

	public function add()
	{
		date_default_timezone_set('Asia/Karachi');
		$receptNumber=explode('-',$this->input->post('receptNumber'));
		$data = array('receptNumber' =>$receptNumber[2],
					  'yearly_no' => $receptNumber[1],
					  'patient_name' => $this->input->post('name'),
					  'refrence' => $this->input->post('refrence'),	
					  'age' => $this->input->post('age'),	
					  'gander' => $this->input->post('gander'),		
					  'address' => $this->input->post('address'),	
					  'date' => date('Y-m-d H:i:s'),
					  'dated' => date('Y-m-d'),
					  'dept_id' => $this->input->post('dept_id'),	
					  'user_id' => $this->session->userdata('user_id'),	
					  'shift' => $this->input->post('shift'),	
					  'price' => $this->input->post('price'),
					  'type' => $this->input->post('type'),
					  'sub_dept_id' => $this->input->post('subdep'),
						);

		$this->session->set_userdata('receptNumber',$receptNumber[2]);
		$this->session->set_userdata('yearly_no',$receptNumber[1]);
		$query=$this->OtModel->insert_other($data);
	}

	public function other_print($dept_id)
	{
		date_default_timezone_set('Asia/Karachi');
		$receptNumber=$this->session->userdata('receptNumber');
		$yearly_no=$this->session->userdata('yearly_no');
		$data['query']=$this->OtModel->get_other_invoice_by_id($receptNumber,$yearly_no,$dept_id);
		$this->load->view('other_print',$data);
	}
}