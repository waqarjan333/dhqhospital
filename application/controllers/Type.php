<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->model('TypeModel');
	}

	public function index()
	{
		$page_data['page_name1'] = 'show-types';
		$page_data['page_name'] = 'types/show-types';
		$page_data['data'] = $this->TypeModel->show();
		$this->load->view('index',$page_data);
	}

	public function add()
	{
		$page_data['page_name1'] = 'show-types';
		$page_data['page_name'] = 'types/add-types';
		$page_data['getDepartment'] = $this->TypeModel->getDepartment();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			$name = $this->input->post('name');
			$dep_id = $this->input->post('dep_id');
			
			$array = array(

					'name'=>$name,
					'dep_id'=>$dep_id,
					
				);

			$model = $this->TypeModel->insert($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Type Added Successfully');
				redirect('Type/index');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Type');
				redirect('Type/add');
			}
		}
	}

	public function delete($id)
	{
		$data['is_deleted'] = '1';
		$this->db->where('id',$id);
		$result = $this->db->update('type',$data);
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Type Deleted Successfully');
				redirect('Type/index');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Types');
				redirect('Type/index');
			}
	}

	public function edit($id)
	{
		if(isset($_POST['save']))
		{		
			$name = $this->input->post('name');
			$dep_id = $this->input->post('dep_id');
			$array = array(
					'name'=>$fname,
					'dep_id'=>$dep_id,
				);
				
			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('type', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'types/edit-types';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Type/index');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from type where id=".$id);
			$page_data['record'] = $query->result_array();

			$page_data['id']=$id;

			$page_data['page_name1'] = 'show-types';
			$page_data['page_name'] = 'types/edit-types';
			$this->load->view('Type', $page_data);
		}
	}

}
