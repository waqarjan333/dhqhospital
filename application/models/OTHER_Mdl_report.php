<?php 
class OTHER_Mdl_report extends CI_Model
  {
    public function getDept()
    {
      $dept_ids = $this->session->userdata('dept_ids');

      $this->db->select('*');
      $this->db->where('view','OTHER');
      $this->db->where_in('id', $dept_ids);
      $this->db->where_in('parent_id', 0);
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

    public function getSubDept($dept_id)
    {

      $this->db->select('*');
      $this->db->where('view','OTHER');
      $this->db->where_in('parent_id', $dept_id);
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

    public function getDeptPrice($dept_id)
    {
      $dept_ids = $this->session->userdata('dept_ids');

      $this->db->select('*');
      $this->db->where('view','OTHER');
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


     public function get_today_record($search,$recept,$p_name,$gendar,$shift,$search_dept_report,$type,$sub_dept_id)
    {
       $date = date('Y-m-d');



      $from=date_create($date);
      date_add($from,date_interval_create_from_date_string("+8 HOUR"));
      $from =  date_format($from,"Y-m-d H:i:s");



      $to=date_create($date);
      date_add($to,date_interval_create_from_date_string("+32 HOUR"));
      $to = date_format($to,"Y-m-d H:i:s");

       $opd_type = "";
       $is_admin=$this->session->userdata('is_admin');
       $user_id=$this->session->userdata('user_id');
       if($is_admin == 1)
       {
          $opd_type = "";
       } 
       else
       {
          $opd_type = "AND user_id='$user_id'";
       }

       if(isset($search))
       {
        
        $sql = "SELECT * FROM `other_entry` WHERE id!='' AND is_deleted=0 ".$opd_type." AND date>='$from' AND date<'$to'";

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

        if($sub_dept_id!='')
          $sql.=" AND sub_dept_id='$sub_dept_id'";
      } 
      else 
      {
         $sql = "SELECT * FROM `other_entry` WHERE id!='' AND is_deleted=0 ".$opd_type." AND date>='$from' AND date<'$to'";

      }
        $query=$this->db->query($sql);
        return $query;

}

  public function dailly_summary_report($search,$from,$to,$shift,$type,$search_dept_report,$sub_dept_id)
    {
      $from=date_create($from);
      date_add($from,date_interval_create_from_date_string("+8 HOUR"));
      $from =  date_format($from,"Y-m-d H:i:s");



      $to=date_create($to);
      date_add($to,date_interval_create_from_date_string("+32 HOUR"));
      $to = date_format($to,"Y-m-d H:i:s");


       $opd_type = "";
       $is_admin=$this->session->userdata('is_admin');
       $user_id=$this->session->userdata('user_id');
       if($is_admin == 1)
       {
          $opd_type = "";
       } 
       else
       {
          $opd_type = "AND user_id='$user_id'";
       }

    if(isset($search)){
      
    $sql = "SELECT date AS date, SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
    SUM(price) AS Amount,
          SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
          COUNT(receptNumber) AS 'Total'  FROM other_entry WHERE `id`!='' AND is_deleted=0 ".$opd_type."";

              
        if($from!='' && $to!='') {
              $sql.=" AND date >= '$from' and date <'$to'"; 
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

        if($sub_dept_id!='') {
          $sql.=" AND sub_dept_id='$sub_dept_id'";
        }
                        
        $sql.=" GROUP BY dated";  
        //echo $sql; exit;
        } 
        else 
        {
        $sql = "SELECT date AS date, SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
        SUM(price) AS Amount,
                SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
                COUNT(receptNumber) AS 'Total'  FROM other_entry  WHERE id!='' AND is_deleted=0 ".$opd_type." AND date>='$from' AND date<'$to' + INTERVAL 1 DAY   GROUP BY dated"; 
        }
        $query=$this->db->query($sql);
        return $query;
  }
    public function all_other_report($search,$from,$to,$gendar,$shift,$search_dept_report,$type,$sub_dept_id)
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
        
        $sql = "SELECT * FROM `other_entry` WHERE id!='' AND is_deleted=0 ".$userType."";


          if($from!='' && $to!='') {
            $sql.=" AND date >= '$from' and date <'$to'"; 
          }

          if($gendar!='') {
            $sql.=" AND gander='$gendar'";
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

          if($sub_dept_id!='') {
            $sql.=" AND sub_dept_id='$sub_dept_id'";
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
        $year = substr(date('Y'), 2); 
        $sql = "SELECT * FROM `other_entry` WHERE `id`!='' AND yearly_no='$year' AND is_deleted=0 AND date>='$from2' AND date<'$to2'"; 
      }
      //echo $sql; exit;
        $query=$this->db->query($sql);
        return $query;
       
    
                
    } 

    public function today_other_report($dept_id)
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
        $from2=date_create($date);
        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
        $from2 =  date_format($from2,"Y-m-d H:i:s");

        $to2=date_create($date);
        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
        $to2 = date_format($to2,"Y-m-d H:i:s");
          $year = substr(date('Y'), 2);
        $sql = "SELECT * FROM `other_entry` WHERE `id`!='' AND yearly_no='$year' AND is_deleted=0 AND date>='$from2' AND date<'$to2'";
        $query=$this->db->query($sql);
        return $query;
       
    
                
    } 
  public function shift_gender($search,$from,$to,$dept_id,$type,$sub_dept_id)
    {
      $from=date_create($from);
      date_add($from,date_interval_create_from_date_string("+8 HOUR"));
      $from =  date_format($from,"Y-m-d H:i:s");

      $to=date_create($to);
      date_add($to,date_interval_create_from_date_string("+32 HOUR"));
      $to = date_format($to,"Y-m-d H:i:s");

      if(isset($search))
        {
          $searchDate = ""; 
          if($from!='' && $to!='') {
              $searchDate.=" AND date >= '$from' and date <'$to'"; 
          }

          if(isset($dept_id)) {
            if ($dept_id!='') {
              $dept_id = " AND dept_id ='$dept_id'";
            } else {
              $dept_id = '';
            }
          }

          if(isset($type)) {
              if ($type!='') {
                $type = " AND type ='$type'";
              } else {
                $type = '';
              }
          }

          if(isset($sub_dept_id)) {
            if ($sub_dept_id!='') {
              $sub_dept_id = " AND sub_dept_id ='$sub_dept_id'";
            } else {
              $sub_dept_id = '';
            }
          }


 $sql = "SELECT dept_id,  
SUM(CASE WHEN shift='Morning'  THEN 1 ELSE 0 END) AS MCount,
SUM(if(shift='Morning',price,0)) AS MAmount,       
SUM(CASE WHEN shift='Evening'  THEN 1 ELSE 0 END) AS ECount,
SUM(if(shift='Evening',price,0)) AS EAmount,
SUM(CASE WHEN shift='Night'  THEN 1 ELSE 0 END) AS NCount,
SUM(if(shift='Night',price,0)) AS NAmount,
COUNT(receptNumber) AS TCount,
SUM(price) AS TAmount
FROM other_entry WHERE `id`!='' AND `is_deleted`=0 $searchDate$type$dept_id$sub_dept_id  GROUP By dept_id";

}  else {
  $datefrom = date('Y-m-d');
  $dateto = date('Y-m-d');
  $datefrom=date_create($datefrom);
  date_add($datefrom,date_interval_create_from_date_string("+8 HOUR"));
  $datefrom =  date_format($datefrom,"Y-m-d H:i:s");

  $dateto=date_create($dateto);
  date_add($dateto,date_interval_create_from_date_string("+32 HOUR"));
  $dateto = date_format($dateto,"Y-m-d H:i:s");
$sql = "SELECT dept_id,  
SUM(CASE WHEN shift='Morning'  THEN 1 ELSE 0 END) AS MCount,
SUM(if(shift='Morning',price,0)) AS MAmount,       
SUM(CASE WHEN shift='Evening'  THEN 1 ELSE 0 END) AS ECount,
SUM(if(shift='Evening',price,0)) AS EAmount,
SUM(CASE WHEN shift='Night'  THEN 1 ELSE 0 END) AS NCount,
SUM(if(shift='Night',price,0)) AS NAmount,
COUNT(receptNumber) AS TCount,
SUM(price) AS TAmount
FROM other_entry WHERE `id`!='' AND `is_deleted`=0 AND date >= '$datefrom' and date <'$dateto'  GROUP By dept_id";
}

        //echo $sql; exit;
        $query=$this->db->query($sql);
        return $query;
    }

public function revinew_invoice($dept_id,$date,$shift)
    {
      $from=date_create($date);
      date_add($from,date_interval_create_from_date_string("+8 HOUR"));
      $from =  date_format($from,"Y-m-d H:i:s");



      $to=date_create($date);
      date_add($to,date_interval_create_from_date_string("+32 HOUR"));
      $to = date_format($to,"Y-m-d H:i:s");
      
      $today_date = $date;  
      $dept_id = " AND dept_id ='$dept_id'";
      $shift = " AND shift ='$shift'";
      $date1 = " AND date >= '$from' and date <'$to'";
      $date2 = " AND date >= '$from' and date <'$to'";
      

      $sql = "SELECT  dept_id,shift,
(SELECT receptNumber FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift ORDER BY id ASC limit 1  ) as SerialStartFrom, 
(SELECT receptNumber FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift order by id DESC limit 1  ) as SerialEndTo, 
(SELECT COUNT(receptNumber) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift) as TotalReceipts,
(SELECT SUM(price) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift) as TotalTestsAmount,
(SELECT COUNT(receptNumber) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Paid') as PaidTests,
(SELECT SUM(price) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Paid') as PaidTestsAmount,
(SELECT COUNT(receptNumber) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Casualty') as CasualtyTests,
(SELECT SUM(price) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Casualty') as CasualtyTestsAmount,
(SELECT COUNT(receptNumber) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Ward') as WardTests,
(SELECT SUM(price) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Ward') as WardTestsAmount,
(SELECT COUNT(receptNumber) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Labour_room') as LabourRoomTests,
(SELECT SUM(price) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Labour_room') as LabourRoomTestsAmount,
(SELECT COUNT(receptNumber) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Entitled') as EntitledTests,
(SELECT SUM(price) FROM other_entry WHERE  `is_deleted`=0 $dept_id $date2 $shift AND type = 'Entitled') as EntitledTestsAmount

FROM other_entry a WHERE is_deleted=0 $dept_id $date1 $shift";
      $sql .=" group by dept_id";  
        $query=$this->db->query($sql);
        return  $query->result();
    }

public function other_print_report_delete($dept_id,$receptNumber,$yearly_no)
  {
    
      $exe="UPDATE other_entry SET is_deleted=1 WHERE receptNumber='$receptNumber' AND dept_id='$dept_id' AND yearly_no=".$yearly_no;
      $query=$this->db->query($exe);
          
     
    }
     
}