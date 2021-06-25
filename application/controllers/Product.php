<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('ProductModel');
        }
     public function adding_area()
	{
		$page_data['page_name1'] = 'adding_area';
		$page_data['page_name'] = 'pharmacy/adding_area';
		// $page_data['data'] = $this->Users->show();
		$this->load->view('index',$page_data);	
	}
	public function fetch_item_batch()
	{
		$id=$this->input->post('id');
		 $this->ProductModel->get_batch($id);
	}
 	
 	public function fetch_item_by_type()
	{
		$id=$this->input->post('med_id');
		 $this->ProductModel->fetch_item_by_type($id);
	}
 	
 	public function add_product()
	{
		$this->load->model('IndentModel');
		$page_data['page_name1'] = 'show-product';
		$page_data['page_name'] = 'pharmacy/add_product';
		$page_data['getCats'] = $this->ProductModel->get_category();
		$page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();	
		$page_data['getTypes'] = $this->ProductModel->get_type();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			// echo 'ok';exit;
			$name="";
			$dosage_form = $this->input->post('dosage_form');
			$generic_name = $this->input->post('generic_name');
			$strength = $this->input->post('strength');
			$brand = $this->input->post('brand');
			$category = $this->input->post('category');
			$batch_no = $this->input->post('batch_no');
			$expiry = $this->input->post('expiry');
			$low_stock = $this->input->post('low_stock');
			$quantity = $this->input->post('quantity');
			$vendor = $this->input->post('vendor');
			$med_type = $this->input->post('med_type');
			$product_cat = $this->input->post('product_cat');
			$product_type=$this->input->post('product_type');
			if($product_type==1)
			{
				$name=$dosage_form." / ".$generic_name." / ".$strength." / ".$brand;
			}
			else{
				$name=$this->input->post('lab_info');
			}
			$array = array(

					'name'=>$name,
					'category'=>$category,
					'quantity'=>$quantity,
					'batch_no'=>$batch_no,
					'expiry'=>$expiry,
					'low_limit'=>$low_stock,
					'company'=>$vendor,
					'med_type'=>$med_type,
					'product_type'=>$product_type,
					'product_cat'=>$product_cat,
					
				);

			$model = $this->ProductModel->insert($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Product Added Successfully');
				redirect('Product/show_product');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Product');
				redirect('Product/add_product');
			}
		}
	}

	public function edit($id)
	{
			if(isset($_POST['save']))
		{
			$name="";
			$dosage_form = $this->input->post('dosage_form');
			$generic_name = $this->input->post('generic_name');
			$strength = $this->input->post('strength');
			$brand = $this->input->post('brand');
			$category = $this->input->post('category');
			$batch_no = $this->input->post('batch_no');
			$expiry = $this->input->post('expiry');
			$low_stock = $this->input->post('low_stock');
			$quantity = $this->input->post('quantity');
			$vendor = $this->input->post('vendor');
			$med_type = $this->input->post('med_type');
			$product_type=$this->input->post('product_type');
			$low_limit=$this->input->post('low_stock');
			// echo $dosage_form."/".$generic_name."/".$strength."/".$brand;exit;
			if($product_type==1)
			{
				$name=$dosage_form."/".$generic_name."/".$strength."/".$brand;
			}
			else{
				$name=$this->input->post('lab_info');
			}
			$array = array(

					'name'=>$name,
					'category'=>$category,
					'quantity'=>$quantity,
					'batch_no'=>$batch_no,
					'expiry'=>$expiry,
					'low_limit'=>$low_stock,
					'company'=>$vendor,
					'med_type'=>$med_type,
					'product_type'=>$product_type,
					'product_cat'=>$product_cat,
					
				);

				$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('item', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'pharmacy/edit-product';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Product/show_product');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from item where id=".$id);
			$page_data['record'] = $query->result_array();

			// $page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
			//$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

			$page_data['id']=$id;

			$page_data['page_name1'] = 'show-departments';
			$page_data['page_name'] = 'pharmacy/edit-product';
			$this->load->view('index', $page_data);
		}
	}

	public function delete($id)
	{
		$this->db->where('id',$id);

		$result =$this->db->delete('item');
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Product Deleted Successfully');
				redirect('Product/show_product');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Product');
				redirect('Product/show_product');
			}
	}

	public function add_unit()
	{
		$page_data['page_name1'] = 'show-product';
		$page_data['page_name'] = 'pharmacy/add_unit';
		// $page_data['getProducts'] = $this->pharmacyModel->getProducts();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			// echo 'Ok';exit;
			$name = $this->input->post('name');
			$type = "unit";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);

			$model = $this->ProductModel->insert_unit($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Unit Added Successfully');
				redirect('Product/show_unit');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Unit');
				redirect('Product/add_unit');
			}
		}
	}

	public function edit_unit($id)
	{
			if(isset($_POST['save']))
		{
			// echo 'ok';exit;
				$name = $this->input->post('name');
			$type = "unit";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);
				$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('groups', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'pharmacy/edit_unit';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Product/show_unit');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from groups where id=".$id);
			$page_data['record'] = $query->result_array();

			// $page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
			//$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

			$page_data['id']=$id;

			$page_data['page_name1'] = 'show_unit';
			$page_data['page_name'] = 'pharmacy/edit_unit';
			$this->load->view('index', $page_data);
		}
	}

		public function delete_unit($id)
		{
			$this->db->where('id',$id);

		$result =$this->db->delete('groups');
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Unit Deleted Successfully');
				redirect('Product/show_unit');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Unit');
				redirect('Product/show_unit');
			}
		}
		public function add_category()
	{
		$page_data['page_name1'] = 'show-category';
		$page_data['page_name'] = 'pharmacy/add_category';
		// $page_data['getProducts'] = $this->pharmacyModel->getProducts();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			// echo 'Ok';exit;
			$name = $this->input->post('name');
			$type = "category";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);

			$model = $this->ProductModel->insert_unit($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Category Added Successfully');
				redirect('Product/show_category');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Category');
				redirect('Product/add_category');
			}
		}
	}

	public function edit_category($id)
	{
			if(isset($_POST['save']))
		{
			// echo 'ok';exit;
			$name = $this->input->post('name');
			$type = "category";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);
				$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('groups', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'pharmacy/edit_category';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Product/show_category');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from groups where id=".$id);
			$page_data['record'] = $query->result_array();

			// $page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
			//$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

			$page_data['id']=$id;

			$page_data['page_name1'] = 'show_unit';
			$page_data['page_name'] = 'pharmacy/edit_category';
			$this->load->view('index', $page_data);
		}
	}
	public function delete_category($id)
	{
		$this->db->where('id',$id);

		$result =$this->db->delete('groups');
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Category Deleted Successfully');
				redirect('Product/show_category');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Category');
				redirect('Product/show_category');
			}
	}
	public function add_type()
	{
		$this->load->model('IndentModel');
		$page_data['page_name1'] = 'show-type';
		$page_data['page_name'] = 'pharmacy/add_type';
		$page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();
		// $page_data['getProducts'] = $this->pharmacyModel->getProducts();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
				// echo 'Ok';exit;
			$name = $this->input->post('name');
			$type = $this->input->post('indent_type');

			$array = array(

					'name'=>$name,
					'indent_id'=>$type
					
				);

			$model = $this->ProductModel->insert_type($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Type Added Successfully');
				redirect('Product/show_type');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Type');
				redirect('Product/add_type');
			}
		}
	}
	public function edit_type($id)
	{
			if(isset($_POST['save']))
		{
			// echo 'ok';exit;
				$name = $this->input->post('name');
				$type = $this->input->post('indent_type');

				$array = array(

						'name'=>$name,
						'indent_id'=>$type
						
					);

				$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('indent_sub_name', $array);
			$page_data['id']=$id;

			// $page_data['page_name'] = 'pharmacy/edit_type';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Product/show_type');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from indent_sub_name where id=".$id);
			$page_data['record'] = $query->result_array();
			$this->load->model('IndentModel');
			// $page_data['getDepartment'] = $this->DepartmentModel->getDepartment();
			//$page_data['getSubDepartment'] = $this->DepartmentModel->getSub($page_data['record'][0]['parent_id']);

			$page_data['id']=$id;
			$page_data['unit_ident'] = $this->IndentModel->get_unit_indent_name();	
			$page_data['page_name1'] = 'show_unit';
			$page_data['page_name'] = 'pharmacy/edit_type';
			$this->load->view('index', $page_data);
		}
	}

	public function delete_type($id)
	{
		$this->db->where('id',$id);

		$result =$this->db->delete('indent_sub_name');
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Type Deleted Successfully');
				redirect('Product/show_type');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Type');
				redirect('Product/show_type');
			}
	}
	public function show_product()
	{
		$page_data['page_name1'] = 'show-product';
		$page_data['page_name'] = 'pharmacy/show-product';
		$page_data['data'] = $this->ProductModel->get_items();
		$this->load->view('index',$page_data);
	}
	public function show_unit()
	{
		$page_data['page_name1'] = 'show-unit';
		$page_data['page_name'] = 'pharmacy/show-unit';
		$page_data['data'] = $this->ProductModel->get_unit();
		$this->load->view('index',$page_data);
	}
	public function show_category()
	{
		$page_data['page_name1'] = 'show-category';
		$page_data['page_name'] = 'pharmacy/show-category';
		$page_data['data'] = $this->ProductModel->get_category();
		$this->load->view('index',$page_data);
	}
	public function show_type()
	{
		$page_data['page_name1'] = 'show-type';
		$page_data['page_name'] = 'pharmacy/show-type';
		$page_data['data'] = $this->ProductModel->get_type();
		$this->load->view('index',$page_data);
	}

	public function get_all_product()
	{
	  $this->ProductModel->get_product();
	} 

	public function fetch_product_qty()
	{
		$id=$this->input->post('id');
		 $this->ProductModel->fetch_product_qty($id);
	}

		public function get_product_name()
	{
		$value=$this->input->post('inp');
		if(isset($value))
		{
			$this->ProductModel->get_product_name_item($value);
		}
	}

	public function get_product_type()
	{
		$value=$this->input->post('val');
		if(isset($value))
		{
			$this->ProductModel->get_product_type_item($value);
		}
	}

	public function save_category()
	{
	$name = $this->input->post('name');
			$type = "category";

			$array = array(

					'name'=>$name,
					'type'=>$type
					
				);

			$model = $this->ProductModel->insert_unit($array);
			
	}
	public function save_type()
	{
	$name = $this->input->post('name');
			// $type = "category";

		$name = $this->input->post('name');
			$type = $this->input->post('indent_type');

			$array = array(

					'name'=>$name,
					'indent_id'=>$type
					
				);

			$model = $this->ProductModel->insert_type($array);
			
	}
	public function getCat()
	{
		$this->ProductModel->getCat();

	}
	public function getType()
	{
		$this->ProductModel->getType();

	}

	public function fetch_product_by_category()
	{
		$category=$this->input->post('category');
		  $this->db->select('*');
      $this->db->where('category', $category);
      $result = $this->db->get('item')->result();
      echo json_encode($result);
	}

	public function fetch_product()
	{
		$search=$this->input->post('query');
		$this->ProductModel->fetch_product($search);
	}
		public function get_product_cat()
	{
		$value=$this->input->post('val');
		if(isset($value))
		{
			$this->ProductModel->get_product_cat_item($value);
		}
	}

	public function adjust_stock()
	{
		
	 	$data = array(		  'item_id' => $this->input->post('med_id'),
					 		  'qty' => $this->input->post('qty_diff'),	
					 		  'memos' => $this->input->post('memo'),	
					  		  'adj_date' => date('Y-m_d')
					);
	 	 $query=$this->db->insert('adjust_stock',$data);		 	
	}

}