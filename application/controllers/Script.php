<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Script extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('All_ScriptModel');
			date_default_timezone_set('Asia/Karachi');
        }

	public function getLabMissingSerialNumber()
	{
		$page_data['data'] = $this->All_ScriptModel->getLabMissingSerialNumber();
		$this->load->view('script', $page_data);

		
	}


	public function getLabDetailMissingSerialNumber()
	{

		$page_data['data'] = $this->All_ScriptModel->getLabDetailMissingSerialNumber();
		$this->load->view('script', $page_data);
	}



	public function updateTestsCOuntLab()
	{
		$from = '5000';
		$to = '6000';

		$this->All_ScriptModel->updateTestsCOuntLab($from,$to);
	}

	public function findDUplicateRecord(){

		$table = 'lab_entry';
		$column = 'receptNumber';

		$page_data['data'] = $this->All_ScriptModel->findDUplicateRecord($table,$column);
		$this->load->view('script', $page_data);

	}



}

