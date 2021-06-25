<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OTHER_Report extends CI_Controller {
	public function __construct()
    {
            parent::__construct();
            date_default_timezone_set('Asia/Karachi');
			$this->load->model('OTHER_Mdl_report');
			$this->load->model('OtModel');
    }
	public function index()
	{
		
		
		$search=$this->input->post('search');
		$recept=$this->input->post('recept');
		$p_name=$this->input->post('p_name');
		$shift=$this->input->post('shift');
		$gendar=$this->input->post('gander');
		$dept_id = $this->input->post('dept_id');
		$type=$this->input->post('type');

		if($this->input->post('sub_dept_id')!=''){
		$sub_dept_id=$this->input->post('sub_dept_id');
		$data['getSubDept']=$this->OTHER_Mdl_report->getSubDept($dept_id);
		}
		else
		{
		$sub_dept_id='';
		}

		
		$data['query']=$this->OTHER_Mdl_report->get_today_record($search,$recept,$p_name,$gendar,$shift,$dept_id,$type,$sub_dept_id);

		$data['getDept']=$this->OTHER_Mdl_report->getDept();

		$data['search']=$search;

		$data['page_name1'] = 'today_OTHER_report';
		$data['page_name'] = 'today_OTHER_report';
		$this->load->view('index',$data);
	}
	public function dailly_summary_report()
	{
		
		
		$data['getDept']=$this->OTHER_Mdl_report->getDept();
		$data['page_name1'] = 'dailly_OTHER_summary_report';
		$data['page_name'] = 'dailly_OTHER_summary_report';
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


		if($this->input->post('sub_dept_id')!=''){
		$sub_dept_id=$this->input->post('sub_dept_id');
		$data['getSubDept']=$this->OTHER_Mdl_report->getSubDept($dept_id);
		}
		else
		{
		$sub_dept_id='';
		}

		$data['getDept']=$this->OTHER_Mdl_report->getDept();
		$data['query']=$this->OTHER_Mdl_report->all_other_report($search,$from,$to,$gendar,$shift,$dept_id,$type,$sub_dept_id);

		$data['search']=$search;
		$data['page_name1'] = 'OTHER_report';
		$data['page_name'] = 'OTHER_report';
		$this->load->view('index',$data);
	}
	public function shift_gender()
	{
		$from ='';
		$to = '';
		
		
		$search=$this->input->post('search');
		$dept_id=$this->input->post('dept_id');
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

		if($this->input->post('sub_dept_id')!=''){
		$sub_dept_id=$this->input->post('sub_dept_id');
		$data['getSubDept']=$this->OTHER_Mdl_report->getSubDept($dept_id);
		}
		else
		{
		$sub_dept_id='';
		}
		
		$type=$this->input->post('type');
	   

		$data['query'] = $this->OTHER_Mdl_report->shift_gender($search,$from,$to,$dept_id,$type,$sub_dept_id);

		$data['getDept']=$this->OTHER_Mdl_report->getDept();

		$data['page_name1'] = 'other_shift_gender_report';
		$data['page_name'] = 'other_shift_gender_report';
		$this->load->view('index',$data);
}
	public function other_print_report($dept_id,$receptNumber,$yearly_no)
	{
		
		$data['nick'] = $this->OtModel->get_dep_nick($dept_id);
		$data['query']=$this->OtModel->get_other_invoice_by_id($receptNumber,$yearly_no,$dept_id);
		$this->load->view('other_print',$data);
	}
	public function other_print_report_delete($idss,$id)
	{
		$query=$this->OTHER_Mdl_report->other_print_report_delete($idss,$id);
		redirect('OTHER_Report/');
	}
	public function other_print_report_delete_all($dept_id,$receptNumber,$yearly_no)
	{
		$query=$this->OTHER_Mdl_report->other_print_report_delete($dept_id,$receptNumber,$yearly_no);
		redirect('OTHER_Report/all_report');
	}
	public function revinew_invoice()
	{
		$data['result_array'] = array();
		
		
		$data['getDept']=$this->OTHER_Mdl_report->getDept();

		$search = $this->input->post('search');
		if (isset($search)) {
			$date = date("Y-m-d", strtotime($this->input->post('date')));				
			$shift = $this->input->post('shift');
			$dept_id=$this->input->post('dept_id');
			$data['getDeptPrice']=$this->OTHER_Mdl_report->getDeptPrice($dept_id); 
			$data['dept_name'] = $data['getDeptPrice'][0]->dep_name;
			$data['dept_price'] = $data['getDeptPrice'][0]->dept_price;
			$data['result_array']  = $this->OTHER_Mdl_report->revinew_invoice($dept_id,$date,$shift);
		}	
		

		
		$data['page_name1'] = 'other_revinew_invoice_report';
		$data['page_name'] = 'other_revinew_invoice_report';

		$this->load->view('index',$data);
	}
	public function other_revinew_invoice_print_report($date,$dept_id,$shift)
	{

		
		

		$data['getDeptPrice']=$this->OTHER_Mdl_report->getDeptPrice($dept_id); 
		$data['dept_name'] = $data['getDeptPrice'][0]->dep_name;
		$data['dept_price'] = $data['getDeptPrice'][0]->dept_price;

		 $data['result_array']  = $this->OTHER_Mdl_report->revinew_invoice($dept_id,$date,$shift);
		 $data['date'] = $date;
		 $data['shift'] = $shift;
		$this->load->view('other_revinew_invoice_print',$data);
	}
	public function getsubDept()
	{
		$html = '';
		$dept_id = $this->input->post('dept_id');	
		$sub_dept_id = $this->input->post('sub_dept_id');
		$this->db->select('*');
		$this->db->where('parent_id',$dept_id);
		$sub_departments = $this->db->get('departments')->result();
		if(count($sub_departments)>0){
		$html .= '<label>Sub Department:</label>
            <select class="form-control" name="sub_dept_id" id="sub_dept_id">
                <label>Report Filter</label>
                <option value="">Select Sub Departments</option>';
                    foreach ($sub_departments as $value) 
                    {
                    	if($sub_dept_id == $value->id)
                    	 $selected = 'selected';
                    	else
                    	$selected ='';

                     $html .='<option value='.$value->id.' '.$selected.' >'.$value->dep_name.'</option>';
        
                    }
               $html .='</select>';
               echo $html;
        } else{
        	echo '';
        }

	}
	public function getSubDepts($id)
	{
		$this->db->select('*');
		$this->db->where('parent_id',$id);
		$sub_dept = $this->db->get('departments')->result_array();

		//changes to make from here onwards
	}
	
}
