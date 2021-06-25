<?php 
class XRAY_Mdl_report extends CI_Model
  {
    public function getDept()
    {
      $dept_ids = $this->session->userdata('dept_ids');

      $this->db->select('*');
      $this->db->where('view','XRAY');
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
      $this->db->where('view','XRAY');
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

    public function get_today_record($search,$recept,$p_name,$gendar,$shift,$search_dept_report,$type)
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
        
        $sql = "SELECT * FROM `xray_entry` WHERE id!='' AND `is_deleted`=0 ".$xary_type." AND date>='$from' AND date<'$to' ";

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

        if($type!='') {
          $sql.=" AND type='$type'";
        }
      } 
      else 
      {
         $sql = "SELECT * FROM `xray_entry` WHERE id!='' AND `is_deleted`=0 ".$xary_type." AND date>='$from' AND date<'$to'";

      }
        $query=$this->db->query($sql);
        return $query;

}


      public function get_report_xray($search,$from,$to,$shift,$gander,$xray_typ)
      {
        $sql='';
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");
        if(isset($search)){

          $sql = "SELECT x.name AS xray_name, x.id AS xray_id FROM `xray_entry` AS xe 
                  LEFT JOIN `xray_entry_details` AS xed ON (xe.`receptNumber`=xed.`entry_id`) 
                  LEFT JOIN `xray_type` AS x ON (xed.`xray_type_id`=x.id) WHERE xe.id!='' AND xe.is_deleted=0";


            if(!empty($from) && !empty($to)) {
              $sql.=" AND xe.date >= '$from' and xe.date <'$to'"; 
            }


            if(!empty($xray_typ)) {
                $sql.=" AND xed.xray_type_id='$xray_typ'"; 
            }

            if(!empty($gander)) {
                $sql.=" AND xe.gander='$gander'"; 
            }

            if(!empty($shift)) {
                $sql.=" AND xe.shift='$shift'"; 
            }

            $sql .= " GROUP BY xed.xray_type_id";

        } else {

        $date = date('Y-m-d');
        $from2=date_create($date);
        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
        $from2 =  date_format($from2,"Y-m-d H:i:s");

        $to2=date_create($date);
        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
        $to2 = date_format($to2,"Y-m-d H:i:s");

        $sql = "SELECT x.name AS xray_name, x.id AS xray_id FROM `xray_entry` AS xe 
                  LEFT JOIN `xray_entry_details` AS xed ON (xe.`receptNumber`=xed.`entry_id`) 
                  LEFT JOIN `xray_type` AS x ON (xed.`xray_type_id`=x.id)
                   WHERE xe.is_deleted=0 AND xe.date>='$from2' AND xe.date<'$to2' GROUP BY xed.xray_type_id";
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

    public function dailly_summary_report($search,$from,$to,$shift)
    {
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
          COUNT(receptNumber) AS 'Total'  FROM xray_entry WHERE `id`!=''AND `is_deleted`=0 ".$xary_type."";

              
        if($from!='' && $to=='') {
            $sql.=" AND date>='$from' AND date<'$from' + INTERVAL 1 DAY";
        }
              
         
              
        if($from=='' && $to!='') {
            $sql.=" AND date>='$to' AND date<'$to' + INTERVAL 1 DAY"; 
        }
              
        
             
        if($from!='' && $to!='') {
            $sql.=" AND date >= '$from' and date <'$to' + INTERVAL 1 DAY"; 
        }

        
                        
        if($shift!='') {
            $sql.=" AND shift='$shift'"; 
        }
                        
       $sql.=" GROUP BY dated";  

        } 
        else 
        {
          $date = date('Y-m-d');
        $sql = "SELECT date AS date, SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
                SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
                COUNT(receptNumber) AS 'Total'  FROM xray_entry  WHERE id!=''AND `is_deleted`=0 ".$xary_type." AND date>='$date' AND date<'$date' + INTERVAL 1 DAY  GROUP BY dated"; 
        }
//echo $sql;
        $query=$this->db->query($sql);
         return $query;
  }
    public function all_xray_report($search,$from,$to,$gander,$shift,$type)
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
        
        $sql = "SELECT * FROM `xray_entry` WHERE id!=''AND `is_deleted`=0 ".$userType."";
                 
        
        if($from!='' && $to!='') {
            $sql.=" AND date >= '$from' and date <'$to'"; 
          } 

          if($shift!='') {
            $sql.=" AND shift='$shift'"; 
        }

        if(!empty($type)) {
                $sql.=" AND type='$type'"; 
            }

            if(!empty($gander)) {
                $sql.=" AND gander='$gander'"; 
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
          
        $sql = "SELECT * FROM `xray_entry` WHERE `id`!=''AND `is_deleted`=0 AND date>='$from2' AND date<'$to2'";

      }
        $query=$this->db->query($sql);
        return $query;
    } 
    public function today_xray_report($dept_id)
    {
      
       
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
        $year = substr(date('Y'), 2);
        $sql = "SELECT * FROM `xray_entry` WHERE `id`!='' AND dept_id='$dept_id' AND yearly_no='$year' AND `is_deleted`=0 ".$userType." AND date>='$from' AND date<'$to'";
        $query=$this->db->query($sql);
        return $query;
    } 
public function get_xray_invoice_by_id($dept_id,$receptNumber,$yearly_no)
    {

      

      $exe="SELECT xray.*, dis.name AS dis_name,dept.dept_nick,dept.dep_name 
      FROM xray_entry AS xray 
      LEFT JOIN districts AS dis ON (xray.address=dis.id) 
      LEFT JOIN departments AS dept ON (xray.dept_id=dept.id)
      WHERE xray.receptNumber='$receptNumber' AND xray.yearly_no='$yearly_no' AND xray.is_deleted=0 AND xray.dept_id='$dept_id'";
      
      $query=$this->db->query($exe);
      return $query; 
    }
public function xray_print_report_delete($receptNumber,$yearly_no)
  {
    $this->db->query("UPDATE xray_entry SET is_deleted=1 WHERE receptNumber='$receptNumber' AND yearly_no=".$yearly_no);
    $this->db->query("UPDATE xray_entry_details SET is_deleted=1 WHERE entry_id='$receptNumber' AND year_no=".$yearly_no);
    
        
   
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
        

$sql = "SELECT  dept_id,shift,
(SELECT receptNumber FROM xray_entry WHERE 1  $dept_id $date2 $shift ORDER BY id ASC limit 1  ) as SerialStartFrom, 
(SELECT receptNumber FROM xray_entry WHERE 1 $dept_id $date2 $shift order by id DESC limit 1  ) as SerialEndTo, 
(SELECT COUNT(receptNumber) FROM xray_entry WHERE 1 $dept_id $date2 $shift) as TotalReceipts,
(SELECT SUM(quantity) FROM xray_entry WHERE 1 $dept_id $date2 $shift) as TotalTests,
(SELECT SUM(price) FROM xray_entry WHERE 1 $dept_id $date2 $shift) as TotalTestsAmount,
(SELECT COUNT(*) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Paid') as PaidReceipts,
(SELECT SUM(quantity) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Paid') as PaidTests,
(SELECT SUM(price) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Paid') as PaidTestsAmount,
(SELECT COUNT(*) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Casualty') as CasualtyReceipts,
(SELECT SUM(quantity) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Casualty') as CasualtyTests,
(SELECT SUM(price) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Casualty') as CasualtyTestsAmount,
(SELECT COUNT(*) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Ward') as WardReceipts,
(SELECT SUM(quantity) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Ward') as WardTests,
(SELECT SUM(price) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Ward') as WardTestsAmount,
(SELECT COUNT(*) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Labour_room') as LabourRoomReceipts,
(SELECT SUM(quantity) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Labour_room') as LabourRoomTests,
(SELECT SUM(price) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Labour_room') as LabourRoomTestsAmount,
(SELECT COUNT(*) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Entitled') as EntitledReceipts,
(SELECT SUM(quantity) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Entitled') as EntitledTests,
(SELECT SUM(price) FROM xray_entry WHERE 1 $dept_id $date2 $shift AND type = 'Entitled') as EntitledTestsAmount

FROM xray_entry a WHERE is_deleted=0 $dept_id $date1 $shift";
      $sql .=" group by dept_id";

      //echo $sql;
        $query=$this->db->query($sql);
        return  $query->result();
    }
}