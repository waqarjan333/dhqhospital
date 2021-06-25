<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Loggedin');
	}

	public function index()
	{
		if($this->session->userdata('user_id') != null)
		{
			redirect('/Dashboard');			
		}
		else
		{
			$this->load->view('login/login');
		}
			
	}


	public function validate()
	{
		
		if(isset($_POST['submit']))
		{
			$email = $this->input->post('username');
			$password = $this->input->post('password');
			$data = $this->Loggedin->login($email, $password);
			if($data)
			{
				if($data->security_type != null)
                {
                	$randomCode="";
                	
                	if($data->security_type== '1' || $data->security_type== '2') {
                	$randomCode = $this->randomPassword();
	                } else {
                		$randomCode = "";
                	}
                	

                		$this->db->where('id', $data->id);
						$this->db->where('user_name', $data->user_name);
						$this->db->update('user', array('security_code' => $randomCode));

					if($data->security_type=='1'){
	                	$this->load->library('email');

						$this->email->from('your@example.com', 'DHQ HOSPITAL BATKHELA');
						$this->email->to($data->email);

						$this->email->subject('Login Code');
						$this->email->message('Your Login Code is'.$randomCode);

						//$this->email->send();

						if($this->email->send()) {
							$this->session->set_userdata('user_id',$data->id);
		                	$this->session->set_userdata('name',$data->user_name);
		                	$this->session->set_flashdata('message', 'Please Check login Code in Your Email');
		                	redirect('Login/login_code');
						} else {
							$this->session->unset_userdata('user_id');
							$this->session->unset_userdata('name');
		                	redirect('/Login');
						}
					} 
					elseif ($data->security_type=='2') {
						$api_token = "07eeea2f20c74470502fc04e2265c8725cd53fc6b0ef85bbab3774d8a611";
						$api_secret = "waqarjan333";
						$to = $data->contact;
						$from = "Brand";
						$message = "Your Login Code is : ". $randomCode;
						$url = "http://sms.aursoft.com/plain?api_token=".urlencode($api_token)."&api_secret=".urlencode($api_secret)."&to=".$to."&from=".urlencode($from)."&message=".urlencode($message)."";
						
						$ch  =  curl_init();
						$timeout  =  30;
						curl_setopt ($ch, CURLOPT_URL, $url);
						curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
						$response = curl_exec($ch);
						curl_close($ch);
						$this->session->set_userdata('user_id',$data->id);
		                $this->session->set_userdata('name',$data->user_name);
		                $this->session->set_flashdata('message', 'Please Check login Code in Your Mobile');
		                redirect('Login/login_code');
		                
						 
					} 
					elseif($data->security_type== '0') {

						 $dept_ids = array();
						

	                	 $login_id = $data->id;        
		                 $username = $data->user_name;
		                 $f_name = $data->f_name;
		                 $l_name = $data->l_name;		                 
		                 $is_admin = $data->is_admin;
		                 $security_type = $data->security_type;


		                 // getting department of login person		                 
		                $this->db->select('dept_id');
			        	$this->db->where('user_id',$login_id);
			        	$this->db->where('is_deleted',0);
			        	$getDept = $this->db->get('user_departments')->result();
						
						foreach ($getDept as $key) 
						{
							$dept_ids[] = $key->dept_id;
						}
						// var_dump($data->user_nick);exit;
		                $this->session->set_userdata('user_id',$login_id);
		                $this->session->set_userdata('name',$username);
		                $this->session->set_userdata('full_name',$f_name.' '.$l_name);
		                $this->session->set_userdata('is_admin',$is_admin);
						$this->session->set_userdata('security_type',$security_type);
						// $this->session->set_userdata('nick',$data->user_nick);
						$this->session->set_userdata('dept_ids',$dept_ids);

		                if(isset($login_id))
		                {
		                	redirect('Login/enter');
		                }
	                }
					
                } 

			}
			else
			{
				redirect('/Login');
			}
		}
		else
		{
			$this->login();
		}
		//}
	}

	public function enter()
	{

		if($this->session->userdata('user_id') != null)
		{
			redirect('/Dashboard');
		}
		else
		{
			redirect('/Login');
		}
	}


	public function login_code()
	{
		if(isset($_POST['submit']))
		{
			$code = $this->input->post('code');
			$user_id = $this->session->userdata('user_id');
			$name = $this->session->userdata('name');
			$data = $this->Loggedin->login_code($code, $user_id, $name);
			if($data)
			{
				$this->session->unset_userdata('user_id');
				$this->session->unset_userdata('name');

				 $login_id = $data->id;        
                 $username = $data->user_name;
                 // $dept_id = $data->dep_id;
                 $is_admin = $data->is_admin;
                 $security_type = $data->security_type;

                 // getting user departments
                 $this->db->select('dept_id');
                 $this->db->where('user_id',$login_id);
                 $this->db->where('is_deleted',0);
                 $getDept = $this->db->get('user_departments')->result_array();


                $this->session->set_userdata('user_id',$login_id);
                $this->session->set_userdata('name',$username);
                // $this->session->set_userdata('dept_id',$dept_id);
                $this->session->set_userdata('is_admin',$is_admin);
				$this->session->set_userdata('security_type',$security_type);
				// $this->session->set_userdata('view_section',$getView);
				$this->session->set_userdata('nick',$data->user_nick);
				// user departments set in array
				$this->session->set_userdata('dept_ids',$getDept);

                if(isset($login_id))
                {
                	redirect('Login/enter');
                }

			}
			else
			{
				redirect('/Login/login_code');
			}
		}
		$this->load->view('login/login_code');
	}



	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('dept_id');
		$this->session->unset_userdata('is_admin');
		$this->session->unset_userdata('security_type');
		$this->session->unset_userdata('view_section');
		$this->session->unset_userdata('nick');
			
		redirect('/Login');
	}


public	function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


public function syncDataOpd()
	{
		$user_id = $this->input->post('user_id');	
		
		$date = date('Y-m-d');

		$this->db->select("receptNumber,patient_name,age,gander,address,date,dated,dept_id,user_id,shift,price");
		$this->db->from("opd_entry");
		$this->db->where('sync_status', 0);
		$this->db->where('date >=', $date);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();	
		$result = $query->result_array();

	
		$this->db2 = $this->load->database('livedb', TRUE);

		foreach ($result as $value) 
		{
			$value['sync_status'] = 1;

		  	$exe="DELETE FROM opd_entry WHERE receptNumber='$value[receptNumber]' AND dept_id= '$value[dept_id]' AND user_id= '$user_id' ";

	      $del_query=$this->db2->query($exe);

	      if($del_query)
	      {
	          $insert=$this->db2->insert('opd_entry',$value);
	      }	

	       $update="update opd_entry set sync_status = 1 WHERE receptNumber='$value[receptNumber]' AND dept_id= '$value[dept_id]' AND user_id= '$user_id' ";

	      $update_query=$this->db->query($update);

		}
				
	}

	public function syncDataOther()
	{
		$user_id = $this->input->post('user_id');	
		
		$date = date('Y-m-d');

		$this->db->select("receptNumber,patient_name,age,gander,address,date,dated,dept_id,user_id,shift,price");
		$this->db->from("other_entry");
		$this->db->where('sync_status', 0);
		$this->db->where('date >=', $date);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();	
		$result = $query->result_array();

	
		$this->db2 = $this->load->database('livedb', TRUE);

		foreach ($result as $value) 
		{
			$value['sync_status'] = 1;

		  	$exe="DELETE FROM other_entry WHERE receptNumber='$value[receptNumber]' AND dept_id= '$value[dept_id]' AND user_id= '$user_id' ";

	      $del_query=$this->db2->query($exe);

	      if($del_query)
	      {
	          $insert=$this->db2->insert('other_entry',$value);
	      }	

	       	$update="update other_entry set sync_status = 1 WHERE receptNumber='$value[receptNumber]' AND dept_id= '$value[dept_id]' AND user_id= '$user_id' ";

	      	$update_query=$this->db->query($update);

		}
				
	}


	public function syncAllOpdData()
	{
		$date = date('Y-m-d');

		$this->db->select("receptNumber,patient_name,age,gander,address,date,dated,dept_id,user_id,shift,price");
		$this->db->from("opd_entry");
		$this->db->where('sync_status', 0);
		$query = $this->db->get();	
		$result = $query->result_array();

	
		$this->db2 = $this->load->database('livedb', TRUE);

		foreach ($result as $value) 
		{
			$value['sync_status'] = 1;

		  	$exe="DELETE FROM opd_entry WHERE receptNumber='$value[receptNumber]' AND dept_id= '$value[dept_id]' AND user_id= '$value[user_id]' ";

	      $del_query=$this->db2->query($exe);

	      if($del_query)
	      {
	          $insert=$this->db2->insert('opd_entry',$value);
	      }	

	       	$update="update opd_entry set sync_status = 1 WHERE receptNumber='$value[receptNumber]' AND dept_id= '$value[dept_id]' AND user_id= '$value[user_id]' ";

	      	$update_query=$this->db->query($update);

		}
				
	}


}
