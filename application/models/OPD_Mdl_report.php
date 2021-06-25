
<?php 
class OPD_Mdl_report extends CI_Model
  {
    public function getDept()
    {
      $dept_ids = $this->session->userdata('dept_ids');

      $this->db->select('*');
      $this->db->where('view','OPD');
      $this->db->where_in('id', $dept_ids);
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
      $this->db->where('view','OPD');
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

     public function get_today_record($search,$recept,$p_name,$shift,$gendar,$search_dept_report,$type)
    {
      $date = date('Y-m-d');



      $from=date_create($date);
      date_add($from,date_interval_create_from_date_string("+8 HOUR"));
      $from =  date_format($from,"Y-m-d H:i:s");



      $to=date_create($date);
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
        
        $sql = "SELECT * FROM `opd_entry` WHERE id!='' AND `is_deleted`=0 ".$userType." AND date>='$from' AND date<'$to'";

        if($recept!='') {
          $sql.=" AND receptNumber='$recept'";
        }                      
        
        if($p_name!='') {
          $sql.=" AND patient_name LIKE '%$p_name%'";
        }

        if($shift!='') {
          $sql.=" AND shift='$shift'";
        }

        if($gendar!='') {
          $sql.=" AND gander='$gendar'";
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
         $sql = "SELECT * FROM `opd_entry` WHERE id!='' AND `is_deleted`=0 ".$userType." AND date>='$from' AND date<'$to'";

      } 
      // echo $sql;exit;
        $query=$this->db->query($sql);
        return $query->rows;

}

public function dailly_summary_report($search,$from,$to,$shift,$type,$search_dept_report)
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

      if(isset($search)){

      $sql = "SELECT date AS date, SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
        SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
        COUNT(receptNumber) AS 'Total'  FROM opd_entry WHERE `id`!='' AND `is_deleted`=0 ".$userType."";

            
      
      
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
                      
     $sql.=" GROUP BY dated";  

      } 
      else 
      {
      $sql = "SELECT date AS date, SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
              SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
              COUNT(receptNumber) AS 'Total'  FROM opd_entry  WHERE id!='' AND `is_deleted`=0 ".$userType." AND date>='$from' AND date<'$to'  GROUP BY dated"; 
      }
      
        $query=$this->db->query($sql);
        return $query;
  }


    public function all_opd_report($search,$from,$to,$gendar,$shift,$dept_id,$type)
    {
      $from=date_create($from);
      date_add($from,date_interval_create_from_date_string("+8 HOUR"));
      $from =  date_format($from,"Y-m-d H:i:s");



      $to=date_create($to);
      date_add($to,date_interval_create_from_date_string("+32 HOUR"));
      $to = date_format($to,"Y-m-d H:i:s");

       $date = date('Y-m-d');
       $userType = "";
       $is_admin=$this->session->userdata('is_admin');
       $user_id=$this->session->userdata('user_id');
       if($is_admin == 1)
       {
          $userType = "";
       } 
       else
       {
          $userType = "AND opd.user_id=$user_id";
       }
      if(isset($search))
       {   
        $sql = "SELECT opd.*, dept.dep_name AS dept_name, dept.dept_nick AS dept_nick, dist.name AS district FROM `opd_entry` AS opd 
                LEFT JOIN departments AS dept ON (opd.dept_id=dept.id) 
                LEFT JOIN districts AS dist ON (opd.address=dist.id)  
                WHERE opd.id!='' AND opd.is_deleted=0 ".$userType."";
               
          if($from!='' && $to!='') {
              $sql.=" AND opd.date >= '$from' and opd.date <'$to'"; 
          }
          if($gendar!='') {
              $sql.=" AND opd.gander='$gendar'";
          } 

          if($shift!='') {
              $sql.=" AND opd.shift='$shift'";
          }

          if($dept_id!='') {
              $sql.=" AND opd.dept_id=$dept_id";
          }
          if($type!='') {
              $sql.=" AND opd.type='$type'";
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
          
        $sql = "SELECT opd.*, dept.dep_name AS dept_name, dept.dept_nick AS dept_nick, dist.name AS district FROM `opd_entry` AS opd 
                LEFT JOIN departments AS dept ON (opd.dept_id=dept.id) 
                LEFT JOIN districts AS dist ON (opd.address=dist.id)  
                WHERE opd.`id`!='' AND opd.is_deleted=0 AND opd.date>='$from2' AND opd.date<'$to2'"; 

      }
      
        $query=$this->db->query($sql);
        return $query;
    }
public function today_opd_report($dept_id)
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

        $sql = "SELECT opd.*, dept.dep_name AS dept_name, dept.dept_nick AS dept_nick, dist.name AS district FROM `opd_entry` AS opd 
                LEFT JOIN departments AS dept ON (opd.dept_id=dept.id) 
                LEFT JOIN districts AS dist ON (opd.address=dist.id)  
                WHERE opd.`id`!='' AND opd.yearly_no='$year' AND opd.is_deleted=0 AND opd.date>='$from2' AND opd.date<'$to2'";

        $query=$this->db->query($sql);
        return $query;
       
    
                
    } 
public function shift_gender($search,$from,$to,$type,$dept_id)
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
              $dept_id = " AND dept_id =$dept_id";
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

 $sql = "SELECT dept_id,  
SUM(CASE WHEN shift='Morning' AND UPPER(gander) = 'Male'  THEN 1 ELSE 0 END) AS MM,       
SUM(CASE WHEN shift='Morning' AND UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS MF, 
SUM(CASE WHEN shift='Morning' THEN 1 ELSE 0 END) AS TM,
SUM(CASE WHEN shift='Evening' AND UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS EM, 
SUM(CASE WHEN shift='Evening' AND UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS EF, 
SUM(CASE WHEN shift='Evening' THEN 1 ELSE 0 END) AS TE,
SUM(CASE WHEN shift='Night' AND UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS NM, 
SUM(CASE WHEN shift='Night' AND UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS NF,
SUM(CASE WHEN shift='Night' THEN 1 ELSE 0 END) AS TN,
SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS TMale,
SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS TFemale,
COUNT(receptNumber) AS Total
FROM opd_entry WHERE `id`!='' AND `is_deleted`=0 $searchDate$type$dept_id  GROUP By dept_id";

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
SUM(CASE WHEN shift='Morning' AND UPPER(gander) = 'Male'  THEN 1 ELSE 0 END) AS MM,       
SUM(CASE WHEN shift='Morning' AND UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS MF, 
SUM(CASE WHEN shift='Morning' THEN 1 ELSE 0 END) AS TM,
SUM(CASE WHEN shift='Evening' AND UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS EM, 
SUM(CASE WHEN shift='Evening' AND UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS EF, 
SUM(CASE WHEN shift='Evening' THEN 1 ELSE 0 END) AS TE,
SUM(CASE WHEN shift='Night' AND UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS NM, 
SUM(CASE WHEN shift='Night' AND UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS NF,
SUM(CASE WHEN shift='Night' THEN 1 ELSE 0 END) AS TN,
SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS TMale,
SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS TFemale,
COUNT(receptNumber) AS Total
FROM opd_entry WHERE `id`!='' AND `is_deleted`=0  AND date >= '$datefrom' and date <'$dateto'  GROUP By dept_id";
}
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


      
      $dept_id = " AND dept_id ='$dept_id'";
      $shift = " AND shift ='$shift'";
      $date1 = " AND date >= '$from' and date <'$to'";
      $date2 = " AND date >= '$from' and date <'$to'";
        

$sql = "SELECT  dept_id,shift,
MIN(`receptNumber`) AS serialStart,
MAX(`receptNumber`) AS serialEnd,
COUNT(CASE WHEN type = 'OPD' THEN `receptNumber` ELSE NULL END) AS OPD, 
COUNT(CASE WHEN type = 'Aged' THEN `receptNumber` ELSE NULL END) AS Aged,
COUNT(`receptNumber`) AS Total
FROM opd_entry a WHERE `is_deleted`=0 $dept_id $date1 $shift";
      $sql .=" group by dept_id";

      //echo $sql;

        $query=$this->db->query($sql);
        
        return  $query->result();
    }


  public function opd_delete_report($dept_id,$receptNumber,$yearly_no)
  {
    
    $exe="UPDATE opd_entry SET `is_deleted`=1 WHERE receptNumber='$receptNumber' AND dept_id='$dept_id' AND yearly_no=".$yearly_no;
    $query=$this->db->query($exe);
  }
     
}