<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratory extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('LaboratoryModel');
        }


     public function index()
     {
     	$page_data['page_name1'] = 'test-deshboard';
		$page_data['page_name'] = 'laboratory/test-dashboard';
		$this->load->view('index',$page_data);
     }



     public function Add_Test()
     {

     	// $id='';
     	// if($this->uri->segment(3)!=''){
     	// 	$id = $this->uri->segment(3);
     	// } else {
     	// 	$id = '';
     	// }
     	$page_data['page_name1'] = 'add_test';
		$page_data['page_name'] = 'laboratory/add_test';
		$page_data['data'] = $this->LaboratoryModel->get_testcategory();
		$this->load->view('index',$page_data);

		if(isset($_POST['save']))
		{
			// echo 'Ok';exit;
			$name = $this->input->post('test_name');
			$test_unit = $this->input->post('test_unit');
			$test_category = $this->input->post('test_category');
			$test_refvalue = $this->input->post('test_refvalue');
			$test_subcategory = $this->input->post('test_subcategory');
			

			$data = array();
		    foreach( $test_subcategory as $key)
		    {
		      
		      $data['name']=$name;
		      $data['test_unit'] = $test_unit;
		      $data['test_refvalue'] = $test_refvalue;
		      $data['cat_id'] = $test_category;
		      $data['sub_cat_id']=$key;
			  $this->LaboratoryModel->AddTest($data);
    		}
			$this->session->set_flashdata('message', 'Test Added Successfully');
			redirect('Laboratory/ShowSubCatTest');
		}
     }

     public function EditTest($id)
     {
   

		if(isset($_POST['update']))
		{
			
			$name = $this->input->post('test_name');
			$test_unit = $this->input->post('test_unit');
			$test_category = $this->input->post('test_category');
			$test_refvalue = $this->input->post('test_refvalue');
			$test_subcategory = $this->input->post('test_subcategory');
			

			$data = array();
			// echo $id;exit;
			
		    foreach( $test_subcategory as $key)
		    {
		      
		      $data['name']=$name;
		      $data['test_unit'] = $test_unit;
		      $data['test_refvalue'] = $test_refvalue;
		      $data['cat_id'] = $test_category;
		      $data['sub_cat_id']=$key;
		      	$this->db->where('id',$id);
				$this->db->delete('add_tests');
				 $this->LaboratoryModel->AddTest($data);		
				
			 
    		}
			$this->session->set_flashdata('message', 'Test Update Successfully');
			redirect('Laboratory/ShowSubCatTest');
		}
			else
		{

			 // for getting the id

			$query = $this->db->query("select * from add_tests where id=".$id);
			$page_data['record'] = $query->result_array();
		$page_data['id']=$id;
  		$page_data['page_name1'] = 'edit_test';
		$page_data['page_name'] = 'laboratory/edit_test';
		$page_data['data'] = $this->LaboratoryModel->get_testcategory();
		$this->load->view('index',$page_data);
		}
     }

     public function ShowTestResult()
     {

     	$id='';
     	if($this->uri->segment(3)!=''){
     		$id = $this->uri->segment(3);
     	} else {
     		$id = '';
     	}
     	$page_data['page_name1'] = 'show-TestResult';
		$page_data['page_name'] = 'laboratory/show-TestResult';
		$page_data['data'] = $this->LaboratoryModel->get_TestResult($id);
		$this->load->view('index',$page_data);
     }

       public function AddTestResult()
     {
     	$page_data['page_name1'] = 'add_TestResult';
		$page_data['page_name'] = 'laboratory/add_TestResult';
		$page_data['data'] = $this->LaboratoryModel->GetAllTest();
		$this->load->view('index',$page_data);
				if(isset($_POST['save']))
		{
			// echo 'Ok';exit;
			$test = $this->input->post('test');
			$test_result = $this->input->post('test_result');
			$array = array(
					'test_id'=>$test,
					'test_result'=>$test_result
						);

			$model = $this->LaboratoryModel->AddTestResult($array);
		
			if($model)
			{
				$this->session->set_flashdata('message', 'Test Result Added Successfully');
				redirect('Laboratory/ShowTestResult');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Test Result');
				// redirect('Laboratory/SubTestCategory');
			}
		}
     }


     public function ShowTestCategory()
     {
     	$page_data['page_name1'] = 'show-testcategory';
		$page_data['page_name'] = 'laboratory/show-testcategory';
		$page_data['data'] = $this->LaboratoryModel->get_testcategory();
		$this->load->view('index',$page_data);
     }  

     public function ShowCateWiseSub()
     {
     	$id='';
     	if($this->uri->segment(3)!=''){
     		$id = $this->uri->segment(3);
     	} else {
     		$id = '';
     	}
     	$page_data['page_name1'] = 'show-CatewiseSub';
		$page_data['page_name'] = 'laboratory/show-CatewiseSub';
		$page_data['data'] = $this->LaboratoryModel->get_subWiseSubCat($id);
		$this->load->view('index',$page_data);	
     }

     public function ShowSubCatTest()
     {
     	$cat_id = $sub_cat_id='';
     	if($this->uri->segment(3)!=''){
     		$sub_cat_id = $this->uri->segment(3);
     	} else {
     		$sub_cat_id = '';
     	}

     	if($this->uri->segment(4)!=''){
     		$cat_id = $this->uri->segment(4);
     	} else {
     		$cat_id = '';
     	}
     	$page_data['page_name1'] = 'show-SubCatTest';
		$page_data['page_name'] = 'laboratory/show-SubCatTest';
		$page_data['data'] = $this->LaboratoryModel->get_SubCatTest($sub_cat_id, $cat_id);
		$this->load->view('index',$page_data);	
     }

      

     public function TestCategory()
     {
     	$page_data['page_name1'] = 'test_category';
		$page_data['page_name'] = 'laboratory/test_category';
		$this->load->view('index',$page_data);

		if(isset($_POST['save']))
		{
			// echo 'Ok';exit;
			$name = $this->input->post('name');

			$array = array(

					'name'=>$name,
					'parent_id'=>'0',
					'description'=>'Parent Category',
					'price'=>$_POST['amount'],
					
				);

			$model = $this->LaboratoryModel->TestCategory($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Test Category Added Successfully');
				redirect('Laboratory/ShowTestCategory');
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Test Category');
				redirect('Laboratory/TestCategory');
			}
		} elseif (isset($_POST['cancel'])) {
			redirect('Laboratory/ShowTestCategory/');
		}
     }

     public function DeleteTestCategory($id)
     {
     	$result = $this->db->delete('testcategories')->where('id',$id);
		$this->db->delete('testcategories')->where('parent_id',$id);	
		$this->db->delete('add_tests')->where('cat_id',$id);
		//$this->db->delete('test_result')->where('cat_id',$id);
		if($result)
			{
				$this->session->set_flashdata('message', 'Category Deleted Successfully');
				redirect('Laboratory/ShowTestCategory');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Category');
				
     }


    }

    public function DeleteSubTestCategory($id)
    {
    	$this->db->where('id',$id);

		$result =$this->db->delete('testcategories');
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Sub Test Category Deleted Successfully');
				redirect('Laboratory/SubTestCategory');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Category');
				
     }	
    }

	public function EditTestCategory($id)
	{
		if(isset($_POST['save']))
		{
			$name = $this->input->post('name');
			$amount=$this->input->post('amount');
			$array = array(

					'name'=>$name,
					'parent_id'=>'0',
					'price'=>$amount,
					'description'=>'Parent Category'
					
				);
			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('testcategories', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'laboratory/edit-testcategory';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Laboratory/ShowTestCategory');
		} elseif (isset($_POST['cancel'])) {
			redirect('Laboratory/ShowTestCategory/');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from testcategories where id=".$id);
			$page_data['record'] = $query->result_array();
			$page_data['id']=$id;

			$page_data['page_name1'] = 'edit-testcategory';
			$page_data['page_name'] = 'laboratory/edit-testcategory';
			$this->load->view('index', $page_data);
		}
	}

		public function EditSubTestCategory($id)
		{
		if(isset($_POST['save']))
		{
				$name = $this->input->post('name');
			$sub_category = $this->input->post('sub_category');
			$array = array(

					'name'=>$name,
					'parent_id'=>$sub_category,
					'description'=>'Child Category'
					
				);
			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('testcategories', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'laboratory/edit-subtestcategory';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Laboratory/ShowSubTestCategory');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from testcategories where id=".$id);
			$page_data['record'] = $query->result_array();
			$page_data['id']=$id;

			$page_data['page_name1'] = 'edit-subtestcategory';
			$page_data['page_name'] = 'laboratory/edit-subtestcategory';
			$page_data['data'] = $this->LaboratoryModel->get_testcategory();
			$this->load->view('index', $page_data);
		}	

		}

		public function SubTestCategory()
		{
		$page_data['page_name1'] = 'SubTestCategory';
		$page_data['page_name'] = 'laboratory/SubTestCategory';
		$page_data['data'] = $this->LaboratoryModel->get_testcategory();
		$this->load->view('index',$page_data);

		if(isset($_POST['save']))
		{
			// echo 'Ok';exit;
			$name = $this->input->post('name');
			$sub_category = $this->input->post('sub_category');
			$array = array(

					'name'=>$name,
					'parent_id'=>$sub_category,
					'description'=>'Child Category'
					
				);

			$model = $this->LaboratoryModel->TestCategory($array);

			if($model)
			{
				$this->session->set_flashdata('message', 'Sub Test Category Added Successfully');
				redirect('Laboratory/ShowCateWiseSub/'.$this->uri->segment(3));
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Adding Sub Test Category');
				redirect('Laboratory/ShowCateWiseSub/'.$this->uri->segment(3));
			}
		} 
		}

		public function GetSubCategory()
		{
			$id=$this->input->post('id');
			$sub=$this->input->post('sub');

			$this->LaboratoryModel->get_subtestcategories($id,$sub);			
		}

		public function DeleteTestResult($id)
		{
			$this->db->where('id',$id);

		$result =$this->db->delete('test_result');
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Test Result Deleted Successfully');
				redirect('Laboratory/ShowTestResult');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Test Result');
				
     }
		}

		public function EditTestResult($id)
		{
		if(isset($_POST['save']))
		{
				$test = $this->input->post('test');
			$test_result = $this->input->post('test_result');
			$array = array(
					'test_id'=>$test,
					'test_result'=>$test_result
						);
			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('test_result', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'laboratory/edit-testresult';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('Laboratory/ShowTestResult');
		}
		else
		{

			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from test_result where id=".$id);
			$page_data['record'] = $query->result_array();
			$page_data['id']=$id;

			$page_data['page_name1'] = 'edit-testresult';
			$page_data['page_name'] = 'laboratory/edit-testresult';
			$page_data['data'] = $this->LaboratoryModel->GetAllTest();
			$this->load->view('index', $page_data);
		}	

}
}