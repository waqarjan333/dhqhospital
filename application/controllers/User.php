<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('Users');
        }

	public function index()
	{
		$page_data['page_name1'] = 'show-customers';
		$page_data['page_name'] = 'customers/show-customers';
		$page_data['data'] = $this->Users->show();
		$this->load->view('index',$page_data);
	}

	public function getUserName()
	{
	    $uname = $this->input->post('uname');
		$check = $this->db->select('user_name')->from('user')->where('user_name',$uname)->get();
		$count = $check->num_rows();	
		echo json_encode($count);
	}

	public function add()
	{
		$page_data['page_name1'] = 'show-customers';
		$page_data['page_name'] = 'customers/add-customers';
		//$page_data['type'] = $this->Users->type();
		$page_data['department'] = $this->Users->department();
		$this->load->view('index', $page_data);

		if(isset($_POST['save']))
		{
			$uname = $this->input->post('uname');
			$check = $this->db->select('user_name')->from('user')->where('user_name',$uname)->get();
			$count = $check->num_rows();	
			if($count > 0)
			{
				$this->session->set_flashdata('error', 'Error While Adding User, this User Name is already Exist, Please choose another!!!');
				redirect('User/index');
			}
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');			
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$pass = md5($this->input->post('pass'));
			$security_type = $this->input->post('security_type');
			$is_admin = $this->input->post('is_admin');
			$dept_id_multy = $this->input->post('dept_id');

			$array = array(

					'f_name'=>$fname,
					'l_name'=>$lname,
					'user_name' => $uname,
					'contact'=>$phone,
					'email'=>$email,
					'password'=>$pass,
					'is_admin'=>$is_admin,
					'add_date'=>date('Y-m-d H:i:s'),
					'security_type'=>$security_type,
				);


			$model = $this->Users->insert($array);
			$insert_id = $this->db->insert_id();

			$data = array();
		    foreach( $dept_id_multy as $key)
		    {
		      
		      $data['dept_id']=$key;
		      $data['user_id']=$insert_id;
			  $this->Users->addDep($data);
    		}

			if($model)
			{
				$this->session->set_flashdata('message', 'User Added Successfully');
				redirect('User/index');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error While Adding User');
				redirect('User/add');
			}
		}
	}

	public function getSub($id)
	{
		$result = $this->db->select('*')->from('departments')->where(array('is_deleted'=>0,'parent_id'=>$id))->get()->result();

		$html = '';
		$html = $html.'
			<div class="col-md-4">
            <label>Sub Department:</label>
            <select name="dept_id" class="form-control" id="dept_id" required>
                <option value="" selected="" disabled>Select Section</option>';

                 foreach ($result as $value) {
                    $html = $html.'<option value="'.$value->id.'"> '.$value->dep_name.'</option>';
                	}
         $html = $html.'</select><br />
        	</div>';

        echo $html;
	}

	public function delete($id)
	{
		$data['is_deleted'] = '1';
		$this->db->where('id',$id);
		$result = $this->db->update('user',$data);
			
		if($result)
			{
				$this->session->set_flashdata('message', 'User Deleted Successfully');
				redirect('User/index');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting User');
				redirect('User/index');
			}
	}

	public function edit($id)
	{
		if(isset($_POST['save']))
		{	
			$pass = null;
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$uname = $this->input->post('uname');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$dept_id_multy = $this->input->post('dept_id');
		
			$security_type = $this->input->post('security_type');
			$is_admin = $this->input->post('is_admin');
			
			if($this->input->post('new_pass') != null)
			{

			$pass = md5($this->input->post('new_pass'));
			
			$array = array(

					'f_name'=>$fname,
					'l_name'=>$lname,
					'user_name' => $uname,
					'contact'=>$phone,
					'password'=>$pass,
					'email'=>$email,
					'is_admin'=>$is_admin,
					'security_type'=>$security_type,
				);
			}
			else
			{
				$array = array(

					'f_name'=>$fname,
					'l_name'=>$lname,
					'user_name' => $uname,
					'contact'=>$phone,
					'email'=>$email,
					'is_admin'=>$is_admin,
					'security_type'=>$security_type,
				);
			}
				
			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('user', $array);
			$page_data['id']=$id;

			$this->db->where('user_id', $id);
			$this->db->delete('user_departments');

			$data = array();
		    foreach( $dept_id_multy as $key)
		    {
		      
		      $data['dept_id']=$key;
		      $data['user_id']=$id;
			  $this->Users->editDep($data);
    		}

			$page_data['page_name'] = 'customers/edit-customers';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Update Successfully');
			redirect('User/index');
		}
		else
		{
			$user_dept_ids = array();
			$id = $this->uri->segment(3); // for getting the id

			$query = $this->db->query("select * from user where id=".$id);
			$page_data['record'] = $query->result_array();

			$dropdown = $this->db->query("select * from departments where parent_id = 0");
			$page_data['dropdown'] = $dropdown->result_array();
					
			$this->db->select('dept_id');
        	$this->db->where('user_id',$id);
        	$this->db->where('is_deleted',0);
        	$getUserDept = $this->db->get('user_departments')->result();
			
			foreach ($getUserDept as $key) 
			{
				$user_dept_ids[] = $key->dept_id;
			}

			$page_data['user_dept_ids'] = $user_dept_ids;

			$page_data['id']=$id;

			$page_data['page_name1'] = 'show-customers';
			$page_data['page_name'] = 'customers/edit-customers';
			$page_data['department'] = $this->Users->department();

			$this->load->view('index', $page_data);
		}
	}

	public function backup(){

    $this->load->dbutil();
    $config = array(     
        'format'      => 'zip',             
        'filename'    => 'my_db_backup.sql'
    );

    $backup =& $this->dbutil->backup($config); 

    $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
    $save = 'uploads/'.$db_name;

    $this->load->helper('file');
    write_file($save, $backup); 
    $this->load->helper('download');
    force_download($db_name, $backup);
}

}
