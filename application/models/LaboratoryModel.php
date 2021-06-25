<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaboratoryModel extends CI_Model
{
	public function TestCategory($data)
	{
		$result = $this->db->insert('testcategories', $data); 
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

 public function get_testcategory()
 {
  // if($id!=''){
  //       $this->db->where('parent_id =', $id);
  //     } else {
  //       $this->db->where('parent_id !=', 0);
  //     }
 	 $result =$this->db->select('*');
      $this->db->where('parent_id', '0');
      $result = $this->db->get('testcategories')->result();
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  }
 }

 public function get_subWiseSubCat($id)
{

      $result =$this->db->select('*');
      if($id!=''){
        $this->db->where('parent_id =', $id);
      } else {
        $this->db->where('parent_id !=', 0);
      }
      
      $result = $this->db->get('testcategories')->result();
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  }
}

public function get_SubCatTest($sub_cat_id, $cat_id)
{
   $result = '';
   if($sub_cat_id!='' && $cat_id!=''){
    $multipleWhere = ['cat_id =' => $cat_id, 'sub_cat_id =' => $sub_cat_id];
    $result = $this->db->SELECT('t.*,s.name AS parent_cat,sub.name AS child_category')->FROM('add_tests as t')
    ->join('testcategories as s','t.cat_id=s.id','INNER')
    ->join('testcategories as sub','t.sub_cat_id=sub.id','INNER')
    ->where($multipleWhere)->get()->result();
  } elseif($sub_cat_id!='' && $cat_id==''){
    $result = $this->db->SELECT('t.*,sub.name AS child_category')->FROM('add_tests as t')
    ->join('testcategories as sub','t.sub_cat_id=sub.id','INNER')
    ->where('sub_cat_id =', $sub_cat_id)->get()->result();
  }  elseif($sub_cat_id=='' && $cat_id!=''){
    $result = $this->db->SELECT('t.*,s.name AS parent_cat')->FROM('add_tests as t')
    ->join('testcategories as s','t.cat_id=s.id','INNER')
    ->where('cat_id =', $cat_id)->get()->result();
  } else  {
    $result = $this->db->SELECT('t.*,s.name AS parent_cat,sub.name AS child_category')->FROM('add_tests as t')
    ->join('testcategories as s','t.cat_id=s.id','INNER')
    ->join('testcategories as sub','t.sub_cat_id=sub.id','INNER')->get()->result();
  }
    
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  } 
}	

  	

public function get_subtestcategories($id,$sub)
{
  $output='';
 $exe="SELECT * FROM testcategories WHERE parent_id ='$id'";
    $query=$this->db->query($exe);
  if( $query->num_rows()>0)
  {
    foreach($query->result_array() as $row){  
    
    if($sub!='')
    {
      $query = $this->db->query("select * from add_tests where sub_cat_id=".$sub);
      $record = $query->result_array();

      if($row['id']==$record[0]['sub_cat_id']){
        $select="selected==''";
      }
      else{
        $select='';
      }
    }
    else{
      $select='';
    }  
    $output.='<option value="'.$row['id'].'" '.$select.'>'.$row['name'].'</option>';
  }
  }
  else{
    $output.='<option></option>';
  }
  echo $output; 
}

public function AddTest($data)
{
   $result = $this->db->insert('add_tests', $data); 
   if($result)
    {
     return true;
    }
    else
    {
     return false;
    }
}


public function GetAllTest()
{
      $result = $this->db->SELECT('t.*,s.name AS sub_cat')->FROM('add_tests as t')
    ->join('testcategories as s','t.cat_id=s.id','INNER')
    ->where('t.id !=', '0')->get()->result();

  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  }
}


public function get_TestResult($id)
{
   if($id!=''){
    $result =$this->db->select('t.*,s.name AS test_name,c.name AS sub_cat')->FROM('test_result as t')
                      ->join('add_tests as s','t.test_id=s.id','INNER')
                      ->join('testcategories as c','s.cat_id=c.id','INNER')
                      ->where('t.id !=', '0')->get()->result();
    } else {
    $result =$this->db->select('t.*,s.name AS test_name,c.name AS sub_cat')->FROM('test_result as t')
                      ->join('add_tests as s','t.test_id=s.id','INNER')
                      ->join('testcategories as c','s.cat_id=c.id','INNER')->get()->result();

     }

  
  if($result)
  {
   return $result;
  }
  else
  {
   return false;
  } 
}

public function AddTestResult($data)
{
    $result = $this->db->insert('test_result', $data); 
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



}	