<?php 
class LAB_Mdl_report extends CI_Model
  {
    public function getDept()
    {
      $dept_ids = $this->session->userdata('dept_ids');

      $this->db->select('*');
      $this->db->where('view','LAB');
      $this->db->where_in('id', $dept_ids);
      $result = $this->db->get('departments')->result();
      if($result)
      {
        return $result;
      }
      else      {
        return false;
      }
    }

    public function getDeptPrice($dept_id)
    {
      $dept_ids = $this->session->userdata('dept_ids');

      $this->db->select('*');
      $this->db->where('view','LAB');
      $this->db->where('id', $dept_id);
      $result = $this->db->get('departments')->result();
      if($result)
      {
        return $result;
      }
      else
      {
        return false;
      }
    }

    public function get_today_record($search,$recept,$p_name,$gendar,$shift,$search_dept_report,$search_type)
    {
        $date = date('Y-m-d');
        $from=date_create($date);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($date);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

         
         $xary_type = "";
         $is_admin=$this->session->userdata('is_admin');
         $user_id=$this->session->userdata('user_id');


       if($is_admin == 1)
       {
          $xary_type = "";
       } 
       else
       {
          $xary_type = "AND user_id='$user_id'";
       }

       if(isset($search))
       {
        
        $sql = "SELECT * FROM `lab_entry` WHERE id!='' AND is_deleted=0 ".$xary_type." AND date>='$from' AND date<'$to' ";

        if($gendar!='') {
          $sql.=" AND gander='$gendar'";
        }                   
        
        if($recept!='') {
          $sql.=" AND receptNumber='$recept'";
        }                      
        
        if($p_name!='') {
          $sql.=" AND patient_name LIKE '%$p_name%'";
        }

        if($shift!='') {
          $sql.=" AND shift='$shift'";
        }

        if($search_dept_report!='') {
          $sql.=" AND dept_id='$search_dept_report'";
        }

        if($search_type!='') {
          $sql.=" AND type='$search_type'";
        }
      } 
      else 
      {
         $sql = "SELECT * FROM `lab_entry` WHERE id!='' AND is_deleted=0 ".$xary_type." AND date>='$from' AND date<'$to'";

      }
        $query=$this->db->query($sql);
        return $query;

}

    public function dailly_summary_report($search,$from,$to,$shift,$type)
    {
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

         
         $xary_type = "";
         $is_admin=$this->session->userdata('is_admin');
         $user_id=$this->session->userdata('user_id');

       if($is_admin == 1)
       {
          $xary_type = "";
       } 
       else
       {
          $xary_type = "AND user_id='$user_id'";
       }

    if(isset($search)){
      
    $sql = "SELECT date AS date, SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
          SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
          COUNT(receptNumber) AS 'Total'  FROM lab_entry WHERE `id`!= AND is_deleted=0'' ".$xary_type."";

              
        if($from!='' && $to!='') {
              $sql.=" AND date >= '$from' and date <'$to'"; 
          }

        
                        
        if($shift!='') {
            $sql.=" AND shift='$shift'"; 
        }

         if($type!='') {
          $sql.=" AND type='$type'";
        }
                        
       $sql.=" GROUP BY dated";  

        } 
        else 
        {
        $date = date('Y-m-d');
        $from2=date_create($date);
        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
        $from2 =  date_format($from2,"Y-m-d H:i:s");

        $to2=date_create($date);
        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
        $to2 = date_format($to2,"Y-m-d H:i:s");

        $sql = "SELECT date AS date, SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
                SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
                COUNT(receptNumber) AS 'Total'  FROM lab_entry  WHERE id!='' AND is_deleted=0 ".$xary_type." AND date>='$from2' AND date<'$to2' GROUP BY dated"; 
        }
        $query=$this->db->query($sql);
         return $query;
   }

      public function get_report_tests($search,$from,$to,$shift,$gander,$test)
      {
        $sql='';
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");
        if(isset($search)){

          $sql = "SELECT t.name AS test_name, t.id AS test_id FROM `lab_entry` AS le LEFT JOIN `lab_entry_details` AS led ON (le.`receptNumber`=led.`entry_id`) LEFT JOIN `tests` AS t ON (led.`test_id`=t.id) WHERE le.id!='' AND le.is_deleted=0";


            if($from!='' && $to!='') {
              $sql.=" AND le.date >= '$from' and le.date <'$to'"; 
            }


            if($test!='') {
                $sql.=" AND led.test_id='$test'"; 
            }

            if($gander!='') {
                $sql.=" AND le.gander='$gander'"; 
            }

            if($shift!='') {
                $sql.=" AND le.shift='$shift'"; 
            }

            $sql .= " GROUP BY led.test_id";
        } else {

        $date = date('Y-m-d');
        $from2=date_create($date);
        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
        $from2 =  date_format($from2,"Y-m-d H:i:s");

        $to2=date_create($date);
        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
        $to2 = date_format($to2,"Y-m-d H:i:s");

        $sql = "SELECT t.name AS test_name, t.id AS test_id FROM `lab_entry` AS le LEFT JOIN `lab_entry_details` AS led ON (le.`receptNumber`=led.`entry_id`) LEFT JOIN `tests` AS t ON (led.`test_id`=t.id) WHERE le.is_deleted=0 AND le.date>='$from2' AND le.date<'$to2' GROUP BY led.test_id";
        }
        $query=$this->db->query($sql);
        if($query)
        {
          return  $query->result();
        }
        else
        {
          return false;
        }
      }
      public function all_lab_report($search,$from,$to,$gendar,$shift,$type,$search_dept_report)
      {

        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

         
         $userType = "";
         $is_admin=$this->session->userdata('is_admin');
         $user_id=$this->session->userdata('user_id');

        if($is_admin == 1)
        {
            $userType = "";
        } 
        else
        {
            $userType = "AND user_id='$user_id'";
        }
        if(isset($search))
          {
          
          $sql = "SELECT * FROM `lab_entry` WHERE id!='' AND is_deleted=0 ".$userType."";


          if($from!='' && $to!='') {
              $sql.=" AND date >= '$from' and date <'$to'"; 
          }

            if($gendar!='') {
                $sql.=" AND gander='$gendar'";
            } 

            if($shift!='') {
                $sql.=" AND shift='$shift'";
            }

          
            if($type!='') {
                $sql.=" AND type='$type'";
            }

            if($search_dept_report!='') {
              $sql.=" AND dept_id='$search_dept_report'";
            }


        } 
        else 
        {
        $date = date('Y-m-d');
        $from2=date_create($date);
        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
        $from2 =  date_format($from2,"Y-m-d H:i:s");

        $to2=date_create($date);
        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
        $to2 = date_format($to2,"Y-m-d H:i:s");
        $sql = "SELECT * FROM `lab_entry` WHERE `id`!='' AND is_deleted=0 AND date>='$from2' AND date<'$to2'"; 
        }

        // echo $sql;exit;
          $query=$this->db->query($sql);
          return $query;    
        } 


public function today_lab_report($dept_id){
         
         $userType = "";
         $is_admin=$this->session->userdata('is_admin');
         $user_id=$this->session->userdata('user_id');

        if($is_admin == 1)
        {
            $userType = "";
        } 
        else
        {
            $userType = "AND user_id='$user_id'";
        }
        
        $date = date('Y-m-d');
        $from=date_create($date);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");

        $to=date_create($date);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");
        $year = date('y');
        $sql = "SELECT * FROM `lab_entry` WHERE `id`!='' AND yearly_no='$year' ".$userType." AND is_deleted=0 AND date>='$from' AND date<'$to'"; 
        $query=$this->db->query($sql);
        return $query;    
} 

    public function revinew_invoice($dept_id,$date,$shift)
    {
        $date = $date;
        $from2=date_create($date);
        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
        $from2 =  date_format($from2,"Y-m-d H:i:s");

        $to2=date_create($date);
        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
        $to2 = date_format($to2,"Y-m-d H:i:s");
 
      $dept_id = " AND dept_id ='$dept_id'";
      $shift = " AND shift ='$shift'";
      $date1 = " AND date>='$from2' AND date<'$to2'";
      $date2 = " AND date>='$from2' AND date<'$to2'";
      $year = explode('-', $date);
      $yearly_no = substr($year[0], 2);

$sql = "SELECT  dept_id,shift,
(SELECT receptNumber FROM lab_entry WHERE 1  $dept_id $date2 $shift ORDER BY id ASC limit 1  ) as SerialStartFrom, 
(SELECT receptNumber FROM lab_entry WHERE 1 $dept_id $date2 $shift order by id DESC limit 1  ) as SerialEndTo, 
(SELECT COUNT(*) FROM lab_entry WHERE 1 $dept_id $date2 $shift) as TotalReceipts,
(SELECT SUM(tests) FROM lab_entry WHERE 1 $dept_id $date2 $shift) as TotalTests,
(SELECT SUM(price) FROM lab_entry WHERE 1 $dept_id $date2 $shift) as TotalTestsAmount,
(SELECT COUNT(*) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Paid') as PaidReceipts,
(SELECT SUM(tests) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Paid') as PaidTests,
(SELECT SUM(price) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Paid') as PaidTestsAmount,
(SELECT COUNT(*) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Casualty') as CasualtyReceipts,
(SELECT SUM(tests) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Casualty') as CasualtyTests,
(SELECT SUM(price) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Casualty') as CasualtyTestsAmount,
(SELECT COUNT(*) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Ward') as WardReceipts,
(SELECT SUM(tests) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Ward') as WardTests,
(SELECT SUM(price) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Ward') as WardTestsAmount,
(SELECT COUNT(*) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Labour_room') as LabourRoomReceipts,
(SELECT SUM(tests) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Labour_room') as LabourRoomTests,
(SELECT SUM(price) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Labour_room') as LabourRoomTestsAmount,
(SELECT COUNT(*) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Entitled') as EntitledReceipts,
(SELECT SUM(tests) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Entitled') as EntitledTests,
(SELECT SUM(price) FROM lab_entry WHERE 1 $dept_id $date2 $shift AND type = 'Entitled') as EntitledTestsAmount

FROM lab_entry a WHERE yearly_no='$yearly_no' AND is_deleted=0 $dept_id $date1 $shift";
      $sql .=" group by dept_id";
        $query=$this->db->query($sql);
        return  $query->result();
    }
  public function get_lab_invoice_by_id($dept_id,$receptNumber,$yearly_no)
    {
      $exe="SELECT lab.*, dis.name AS dis_name,dept.dept_nick,dept.dep_name 
      FROM lab_entry AS lab 
      LEFT JOIN districts AS dis ON (lab.address=dis.id) 
      LEFT JOIN departments AS dept ON (lab.dept_id=dept.id) 

      WHERE lab.receptNumber='$receptNumber' AND lab.is_deleted=0 AND lab.dept_id='$dept_id' AND lab.yearly_no=".$yearly_no;
      $query=$this->db->query($exe);
      return $query; 
    }
public function lab_print_report_delete($receptNumber,$yearly_no)
  {
    $exe="UPDATE lab_entry SET is_deleted=1 WHERE receptNumber='$receptNumber' AND yearly_no=".$yearly_no;
    $this->db->query($exe);

    $exe1="UPDATE lab_entry_details SET is_deleted=1 WHERE entry_id='$receptNumber' AND yearly=".$yearly_no;
    $this->db->query($exe1);
        
   
  }


  public function test_wise_report($search,$from,$to,$test_id,$dept_id)
  {
        $test_sql = $dept = '';
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");
        $this->db->query('SET SQL_BIG_SELECTS=1');
        
      if(isset($test_id) && !empty($test_id)){
              $tests = implode(",",$test_id);
              $test_sql =" AND `test_id` IN ($tests)"; 
          }

          if(isset($dept_id) && !empty($dept_id)){
              $dept =" AND `dept_id` =".$dept_id; 
          }

          $sql = "SELECT lab.test_id AS test_id, cat.name AS test_name, cat.price AS test_price
FROM lab_entry_details lab LEFT JOIN testcategories cat ON (lab.test_id=cat.id) WHERE lab.`id`!='' AND lab.`is_deleted`=0 AND lab.`date` >= '$from' and lab.`date` <'$to' $test_sql $dept GROUP By lab.test_id";

      $query=$this->db->query($sql);
        if($query)
        {
          return  $query->result();
        }
        else
        {
          return false;
        }

  }

}