<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('DistrictModel');
        }

	public function index()
	{
		$page_data['page_name1'] = 'show-districts';
		$page_data['page_name'] = 'districts/show-districts';
		$page_data['data'] = $this->DistrictModel->show();
		$this->load->view('index',$page_data);
	}

	public function add()
	{
		$page_data['page_name1'] = 'show-districts';
		$page_data['page_name'] = 'districts/add-districts';
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			$dis_name = $this->input->post('dis_name');
			
			$array = array(
					'name'=>$dis_name,					
				);

			$model = $this->DistrictModel->insert($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'District Added Successfully');
				redirect('District/index');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding District');
				redirect('District/add');
			}
		}
	}

	public function delete($id)
	{
		$result = $this->db->delete('districts', array('id'=>$id));
			
		if($result)
			{
				$this->session->set_flashdata('message', 'District Deleted Successfully');
				redirect('District/index');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting District');
				redirect('District/index');
			}
	}

	public function edit($id)
	{
		if(isset($_POST['save']))
		{		
			$dis_name = $this->input->post('dis_name');
			
			$array = array(
					'name'=>$dis_name,
				);
				
			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('districts', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'districts/edit-districts';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('District/index');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from districts where id=".$id);
			$page_data['record'] = $query->result_array();			
			$page_data['id']=$id;
			$page_data['page_name1'] = 'show-districts';
			$page_data['page_name'] = 'districts/edit-districts';
			$this->load->view('index', $page_data);
		}
	}

}
