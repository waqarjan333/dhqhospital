
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PharmacyReport extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('PharmacyReportMdl');
        }
     public function unitIndentReport()
	{
		$this->load->model('IndentModel');
	$page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();	
	$page_data['page_name1'] = 'unitIndentReport';
		$page_data['page_name'] = 'pharmacy/unitIndentReport';
		// $page_data['data'] = $this->Users->show();
		$page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();
		$this->load->view('index',$page_data);		
	}

	public function PatientInvoiceReport()
	{
		
	$page_data['page_name1'] = 'patientIndentReport';
		$page_data['page_name'] = 'pharmacy/patientIndentReport';
		// $page_data['data'] = $this->Users->show();
		$page_data['record'] = $this->PharmacyReportMdl->getPatientInvoiceReport();
		$this->load->view('index',$page_data);	
	}

	public function SupplierReport()
	{
		$page_data['page_name1'] = 'supplierReport';
		$page_data['page_name'] = 'pharmacy/supplierReport';
		// $page_data['data'] = $this->Users->show();
		$page_data['record'] = $this->PharmacyReportMdl->getSupplierReport();
		$this->load->view('index',$page_data);
	}
	public function StockReport()
	{
		$page_data['page_name1'] = 'stockReport';
		$page_data['page_name'] = 'pharmacy/stockReport';
		// $page_data['data'] = $this->Users->show();
		$this->load->model('ProductModel');
		$page_data['getCats'] = $this->ProductModel->get_category();
		$page_data['items'] = $this->ProductModel->get_items();
		$search=$this->input->post('search');

		$product_cat=$this->input->post('category');
		$p_name=$this->input->post('item');
		$page_data['record'] = $this->PharmacyReportMdl->getStockReport($search,$product_cat,$p_name);
		$this->load->view('index',$page_data);	
	}

	public function StockReportByDate()
	{
		$this->load->model('ProductModel');
		$page_data['page_name1'] = 'StockReportByDate';
		$page_data['page_name'] = 'pharmacy/StockReportByDate';
		$search=$this->input->post('search');

		$product_cat=$this->input->post('category');
		$p_name=$this->input->post('item');
		$date=$this->input->post('date');
		// echo $date;exit;
		$page_data['getCats'] = $this->ProductModel->get_category();
		$page_data['items'] = $this->ProductModel->get_items();
		$page_data['record'] = $this->PharmacyReportMdl->getStockReportByDate($search,$product_cat,$p_name,$date);
		// $page_data['record']=$data['sql'];
		// $page_data['indent']=$data['sql1'];
		// var_dump($data['sql1']);exit;
		$this->load->view('index',$page_data);	
	}

	public function InventorySummaryReport()
	{
	$this->load->model('ProductModel');
		$page_data['page_name1'] = 'InventorySummaryReport';
		$page_data['page_name'] = 'pharmacy/InventorySummaryReport';
		$search=$this->input->post('search');

		// $product_cat=$this->input->post('category');
		// $p_name=$this->input->post('item');
		// $date=$this->input->post('date');
		// echo $date;exit;
		$page_data['getCats'] = $this->ProductModel->get_category();
		$page_data['items'] = $this->ProductModel->get_items();
		$page_data['record'] = $this->PharmacyReportMdl->item_summary_report();
		$this->load->view('index',$page_data);		
	}

}