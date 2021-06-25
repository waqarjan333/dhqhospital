
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OtherPharmacy extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('OtherPharmacyModel');
        }

    public function show_storekeeper()
	{
		$page_data['page_name1'] = 'show_storekeeper';
		$page_data['page_name'] = 'pharmacy/show_storekeeper';
		$page_data['data'] = $this->OtherPharmacyModel->get_storekeeper();
		$this->load->view('index',$page_data);
	}    
	public function add_storekeeper()
	{
		$page_data['page_name1'] = 'add_storekeeper';
		$page_data['page_name'] = 'Pharmacy/add_storekeeper';
		// $page_data['getProducts'] = $this->PharmacyModel->getProducts();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			// echo 'Ok';exit;
			$name = $this->input->post('pharmacist_name');
			$type = "store_keeper";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);

			$model = $this->OtherPharmacyModel->insert_storekeeper($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Store Keeper Added Successfully');
				redirect('OtherPharmacy/show_storekeeper');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Store Keeper');
				redirect('OtherPharmacy/add_storekeeper');
			}
		}
	}

	public function edit_storekeeper($id)
	{
			if(isset($_POST['save']))
		{
			// echo 'ok';exit;
				$name = $this->input->post('name');
				$type = "store_keeper";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);
				$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('groups', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'pharmacy/edit_storekeeper';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('OtherPharmacy/show_storekeeper');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from groups where id=".$id);
			$page_data['record'] = $query->result_array();

			// $page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
			//$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

			$page_data['id']=$id;
			$page_data['page_name1'] = 'edit_storekeeper';
			$page_data['page_name'] = 'pharmacy/edit_storekeeper';
			$this->load->view('index', $page_data);
		}

	}
	 public function show_wareIncharge()
		{
			$page_data['page_name1'] = 'show_wareIncharge';
			$page_data['page_name'] = 'pharmacy/show_wareIncharge';
			$page_data['data'] = $this->OtherPharmacyModel->get_wardIncharge();
			$this->load->view('index',$page_data);
		}

	public function add_wardIncharge()
	{
		$page_data['page_name1'] = 'add_wardIncharge';
		$page_data['page_name'] = 'Pharmacy/add_wardIncharge';
		// $page_data['getProducts'] = $this->PharmacyModel->getProducts();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			// echo 'Ok';exit;
			$name = $this->input->post('ward_name');
			$type = "ward_incharge";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);

			$model = $this->OtherPharmacyModel->insert_storekeeper($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Ward Incharge Added Successfully');
				redirect('OtherPharmacy/show_wareIncharge');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Ward Incharge');
				redirect('OtherPharmacy/add_wardIncharge');
			}
		}
	}

	public function delete_wardIncharge($id)
	{
		$this->db->where('id',$id);

		$result =$this->db->delete('groups');
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Ward Incharge Deleted Successfully');
				redirect('OtherPharmacy/show_wareIncharge');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Ward Incharge');
				redirect('OtherPharmacy/show_wareIncharge');
			}
	}

	public function edit_wardIncharge($id)
	{
			if(isset($_POST['save']))
		{
			// echo 'ok';exit;
				$name = $this->input->post('name');
				$type = "ward_incharge";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);
				$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('groups', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'pharmacy/edit_wardIncharge';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('OtherPharmacy/show_storekeeper');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from groups where id=".$id);
			$page_data['record'] = $query->result_array();

			$page_data['id']=$id;
			$page_data['page_name1'] = 'edit_wardIncharge';
			$page_data['page_name'] = 'pharmacy/edit_wardIncharge';
			$this->load->view('index', $page_data);
		}

	}	
    }