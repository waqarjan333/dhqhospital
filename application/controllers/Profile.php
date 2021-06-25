<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
			$this->load->model('Profiles');
        }
	
	public function user_profile($id)
	{
		if(isset($_POST['save']))
		{	
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');

			// Change Password code
			$current_pass = $this->input->post('current_pass');
			if($current_pass != null)
			{
				$check = $this->db->select('password')->from('user')->where(array('password'=>md5($current_pass), 'id'=>$id))->get();
				$count = $check->num_rows();	
			if(!($count > 0))
			{
				$this->session->set_flashdata('error', 'You Enter Wrong Password, Please Try again!! Or Contact Admin');
				redirect('Profile/user_profile/'.$id);
			}
			else
			{
				$new_pass = $this->input->post('new_pass');
				$again_new_pass = $this->input->post('again_new_pass');

				if($new_pass == $again_new_pass)
				{
					$array = array(

						'f_name'=>$fname,
						'l_name'=>$lname,
						'password'=>md5($new_pass),
						'email' => $email,
						'contact'=>$phone,
					);
				}
				else
				{
					$this->session->set_flashdata('error', 'New Password & Confirm New Password Did Not Match With Each Other, TRY AGAIN !!!');
					redirect('Profile/user_profile/'.$id);
				}

			}

			}
			else
			{

				$array = array(

					'f_name'=>$fname,
					'l_name'=>$lname,
					'email' => $email,
					'contact'=>$phone,
				);
				
			}

			$page_data['record'] = $this->db->where('id', $id);
			$page_data['record'] = $this->db->update('user', $array);
			$page_data['id']=$id;

			$page_data['page_name'] = 'show-profile';
			$this->load->view('index', $page_data);
			$this->session->set_flashdata('message', 'Profile Update Successfully');
			redirect('Profile/user_profile/'.$id); 
		}
		else
		{

			$query = $this->db->query("select * from user where id=".$id);
			$page_data['record'] = $query->result_array();

			$page_data['id']=$id;
			$page_data['page_name1'] = 'show-profile';
			$page_data['page_name'] = 'show-profile';

			$this->load->view('index', $page_data);
		}
	}
	public function system_settings()
	{

		if(isset($_POST['save']))
		{	
			// $this->load->library('upload');

			$config = array(
		'upload_path' => './images',
		'allowed_types' => "gif|jpg|png|jpeg|pdf"
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);	
			$hname = $this->input->post('hname');
			$address = $this->input->post('address');
			
			
			if($this->upload->do_upload('logo'))
			{
			 $data = $this->upload->data();
			$image_path = base_url("images/" . $data['raw_name'] . $data['file_ext']);
			// echo $image_path; exit;
			 $array = array(

						'name'=>$hname,
						'address'=>$address,
						'logo'=>$image_path
					);	
			 $save=$this->db->insert('hospital_info',$array);
			 if($save)
			 {
			$this->session->set_flashdata('message', 'Hospital Informations Successfully Saved');
			redirect('Profile/system_settings/'); 	
			 }
			 else{
			$this->session->set_flashdata('message', 'Error Occured During Image Uploading');
			redirect('Profile/system_settings/');	 	
			 }
			
			}
			else{

				$page_data['upload_error']=$this->upload->display_errors();
			 	$page_data['page_name1'] = 'settings';
			   $page_data['page_name'] = 'settings';
        		$this->load->view('index',$page_data);

			}
       

	}
		else{

		  $page_data['page_name1'] = 'settings';
		   $page_data['page_name'] = 'settings';
        $this->load->view('index',$page_data); 
		}
}

	public function delete_info($id)
	{
				$this->db->where('id',$id);

		$result =$this->db->delete('hospital_info');
			
		if($result)
			{
				$this->session->set_flashdata('message', 'Informations Deleted Successfully');
				redirect('Profile/system_settings');	
			}
			else
			{
				$this->session->set_flashdata('message', 'Error While Deleting Informations');
				redirect('Profile/system_settings');
			}
	}
}
