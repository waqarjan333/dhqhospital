<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('DepartmentModel');
        }

	public function index()
	{
		$page_data['page_name1'] = 'show-departments';
		$page_data['page_name'] = 'departments/show-departments';
		$page_data['data'] = $this->DepartmentModel->show();
		$this->load->view('index',$page_data);
	}

	public function subdept($id)
	{
		$page_data['page_name1'] = 'show-departments';
		$page_data['page_name'] = 'departments/show-departments';
		$page_data['data'] = $this->DepartmentModel->getSub($id);
		$this->load->view('index',$page_data);
	}

	public function add()
	{
		$page_data['page_name1'] = 'show-departments';
		$page_data['page_name'] = 'departments/add-departments';
		$page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			$p_dep = $this->input->post('p_dep');
			$dept_nick = $this->input->post('dept_nick');
			$dep_name = $this->input->post('dep_name');
			$price = $this->input->post('price');
			$view = $this->input->post('view');

			if(empty($p_dep))
			{
				$p_dep = 0;
			}
			
			$array = array(

					'parent_id'=>$p_dep,
					'dept_nick'=>$dept_nick,
					'dep_name'=>$dep_name,
					'dept_price'=>$price,
					'view'=>$view,
					
				);

			$model = $this->DepartmentModel->insert($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Department Added Successfully');
				redirect('Department/index');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Department');
				redirect('Department/add');
			}
		}
	}

public function delete($id)
	{
		$data['is_deleted'] = '1';
		$this->db->where('id',$id);
		$result = $this->db->update('departments',$data);
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Department Deleted Successfully');
				redirect('Department/index');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Department');
				redirect('Department/index');
			}
	}

	public function edit($id)
	{
		if(isset($_POST['save']))
		{		
			$p_dep = $this->input->post('p_dep');
			$dept_nick = $this->input->post('dept_nick');
			$dep_name = $this->input->post('dep_name');
			$price = $this->input->post('price');
			$view = $this->input->post('view');

			if(empty($p_dep))
			{
				$p_dep = 0;
			}
			
			$array = array(

					'parent_id'=>$p_dep,
					'dept_nick'=>$dept_nick,
					'dep_name'=>$dep_name,
					'dept_price'=>$price,
					'view'=>$view,
				);
				
			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('departments', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'departments/edit-departments';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Department/index');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from departments where id=".$id);
			$page_data['record'] = $query->result_array();

			$page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
			//$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

			$page_data['id']=$id;

			$page_data['page_name1'] = 'show-departments';
			$page_data['page_name'] = 'departments/edit-departments';
			$this->load->view('index', $page_data);
		}
	}

}
