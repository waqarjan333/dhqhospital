<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class XRAY_type extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('XRAYtypeModel');
        }

	public function index()
	{
		$page_data['page_name1'] = 'show-xraytype';
		$page_data['page_name'] = 'xraytype/show-xraytype';
		$page_data['xray_type'] = $this->XRAYtypeModel->show();
		$this->load->view('index',$page_data);
	}

	public function add()
	{
		$page_data['page_name1'] = 'show-xraytype';
		$page_data['page_name'] = 'xraytype/add-xraytype';
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			$name = $this->input->post('name');
			$array = array(
					'name'=>$name,				
				);

			$model = $this->XRAYtypeModel->insert($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'XRAY Type Added Successfully');
				redirect('XRAY_type/index');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding XRAY Type');
				redirect('XRAY_type/add');
			}
		}
	}

	public function delete($id)
	{
		$result = $this->db->delete('xray_type', array('id'=>$id));
			
		if($result)
			{
				$this->session->set_flashdata('message', 'XRAY Type Deleted Successfully');
				redirect('XRAY_type/index');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting District');
				redirect('XRAY_type/index');
			}
	}

	public function edit($id)
	{
		if(isset($_POST['save']))
		{		
			$name = $this->input->post('name');
			$array = array(
					'name'=>$name,
				);
				
			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('xray_type', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'xraytype/edit-xraytype';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('XRAY_type/index');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from xray_type where id=".$id);
			$page_data['record'] = $query->result_array();			
			$page_data['id']=$id;
			$page_data['page_name1'] = 'show-xraytype';
			$page_data['page_name'] = 'xraytype/edit-xraytype';
			$this->load->view('index', $page_data);
		}
	}

}
