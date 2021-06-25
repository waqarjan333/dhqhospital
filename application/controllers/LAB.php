<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LAB extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('LabModel');
			$this->load->model('LAB_Mdl_report');
        }

	public function index($dept_id)
	{
		date_default_timezone_set('Asia/Karachi');
		$page_data['page_name1'] = 'lab_entry';
		$page_data['page_name'] = 'lab_entry';
		$page_data['nick'] = $this->LabModel->get_nick($dept_id);
		$page_data['inv_no'] = $this->LabModel->get_lab_invoice($dept_id);
		$page_data['districts'] = $this->LabModel->get_districts();
		$page_data['tests'] = $this->LabModel->get_tests();
		$page_data['query'] = $this->LAB_Mdl_report->today_lab_report($dept_id);
		$this->load->view('index',$page_data);	
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
					  'tests' => count($this->input->post('test_id')),
					  'sync_status' => 0,
					  'type' => $this->input->post('type'),
					  'print' => 0,
					  'is_deleted' => 0
						);
		$dept_id = $this->input->post('dept_id');
		$this->session->set_userdata('receptNumber',$receptNumber[2]);
		$this->session->set_userdata('yearly_no',$receptNumber[1]);
		$this->session->set_userdata('dept_id',$this->input->post('dept_id'));
	 	
	 	$this->db->query("DELETE FROM lab_entry WHERE receptNumber='$receptNumber[2]' AND dept_id='$dept_id' AND yearly_no='$receptNumber[1]'");

		$this->LabModel->insert_lab($data);
		
		$this->db->query("DELETE FROM lab_entry_details WHERE entry_id='$receptNumber[2]' AND dept_id='$dept_id' AND yearly='$receptNumber[1]'");
		

		$lab_details = array();
		$test_ids = $this->input->post('test_id');
		foreach ($test_ids as $key => $value) {
			 $lab_details['entry_id']=$receptNumber[2];
			 $lab_details['test_id']=$value;
			 $lab_details['yearly']=$receptNumber[1];
			 $lab_details['is_deleted']=0;
			 $lab_details['date']=date('Y-m-d H:i:s');
			 $lab_details['types']=$this->input->post('type');
			 $lab_details['dept_id']=$dept_id;

			$query=$this->LabModel->insert_lab_details($lab_details);

		}

	}


	public function lab_print()
	{
		date_default_timezone_set('Asia/Karachi');
		$receptNumber=$this->session->userdata('receptNumber');
		$yearly_no=$this->session->userdata('yearly_no');
		$dept_id=$this->session->userdata('dept_id');
		$data['query']=$this->LabModel->get_lab_invoice_by_id($receptNumber,$yearly_no,$dept_id);
		$this->load->view('lab_print',$data);
	}

	public function get_lab_price()
	{
		$total = 0;
		$tests_ids = $this->input->post('values');
		foreach ($tests_ids as $test_id) { 
			$test = $this->LabModel->get_tests_by_id($test_id);
			$total += $test[0]['price'];
		}
		echo ($total);
	}

	public function getTestResultEntry()
	{
		
			$id = $this->uri->segment(3);

		
		$page_data['page_name1'] = 'TestResultEntry';
		$page_data['page_name'] = 'TestResultEntry';
		$page_data['TestID'] = $id;
		$this->load->view('index',$page_data);			
	}		

	
}