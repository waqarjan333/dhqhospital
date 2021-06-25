<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OtherPharmacyModel extends CI_Model
{
	public function get_storekeeper()
	{
		 $result =$this->db->select('*');
      $this->db->where('type', 'store_keeper');
      $result = $this->db->get('groups')->result();
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  }
	}

	public function insert_storekeeper($array)
	{
	 $result = $this->db->insert('groups', $array); 
	 if($result)
	  {
	    // echo "true";
	   return true;
	  }
	  else
	  {
	   return false;
	  }
	}

	public function get_wardIncharge()
	{
		 $result =$this->db->select('*');
      $this->db->where('type', 'ward_incharge');
      $result = $this->db->get('groups')->result();
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  }
	}
}