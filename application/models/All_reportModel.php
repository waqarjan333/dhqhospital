<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_reportModel extends CI_Model
{
	public function show($search,$from,$to)
	{
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

        if(isset($search)){
        	$sql = "SELECT 
	        SUM(CASE WHEN UPPER(type) = 'OPD' THEN 1 ELSE 0 END) AS Paid,
	        SUM(CASE WHEN UPPER(type) = 'Aged' THEN 1 ELSE 0 END) AS Aged,
	        SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
	        SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
	        COUNT(receptNumber) AS total,
	        dept_id AS dept_id
	        FROM opd_entry
	        WHERE id!='' AND is_deleted=0";
        	if(!empty($from) && !empty($to)) {
              $sql .=" AND date >= '$from' AND date <'$to'"; 
        	} 

        } else {
        	$date = date('Y-m-d');
	        $from2=date_create($date);
	        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
	        $from2 =  date_format($from2,"Y-m-d H:i:s");

	        $to2=date_create($date);
	        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
	        $to2 = date_format($to2,"Y-m-d H:i:s");
        	$sql = "SELECT 
	        SUM(CASE WHEN UPPER(type) = 'OPD' THEN 1 ELSE 0 END) AS Paid,
	        SUM(CASE WHEN UPPER(type) = 'Aged' THEN 1 ELSE 0 END) AS Aged,
	        SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
	        SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
	        COUNT(receptNumber) AS total,
	        dept_id AS dept_id
	        FROM opd_entry
	        WHERE id!='' AND is_deleted=0 AND date >= '$from2' and date <'$to2'";
        }

		$sql .= " GROUP BY dept_id";
		
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

public function show_other($search,$from,$to)
	{
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

        if(isset($search)){
        	$sql = "SELECT 
	        SUM(CASE WHEN UPPER(type) = 'Ward' THEN 1 ELSE 0 END) AS Ward,
	        SUM(if(type = 'Ward',price,0)) AS OtherWardAmount,
	        SUM(CASE WHEN UPPER(type) = 'Casualty' THEN 1 ELSE 0 END) AS Casualty,
	        SUM(if(type = 'Casualty',price,0)) AS OtherCasualtyAmount,
	        SUM(CASE WHEN UPPER(type) = 'Entitled' THEN 1 ELSE 0 END) AS Entitled,
	        SUM(if(type = 'Entitled',price,0)) AS OtherEntitledAmount,
	        SUM(CASE WHEN UPPER(type) = 'Labour_Room' THEN 1 ELSE 0 END) AS Labour_Room,
	        SUM(if(type = 'Labour_Room',price,0)) AS OtherLRoomAmount,
	        SUM(CASE WHEN UPPER(type) = 'Paid' THEN 1 ELSE 0 END) AS Paid,
	        SUM(if(type = 'Paid',price,0)) AS OtherPaidAmount,
	        COUNT(receptNumber) AS total, SUM(price) AS OthertotalAmount,
	        dept_id AS dept_id FROM other_entry WHERE id!='' AND is_deleted=0";
        	if(!empty($from) && !empty($to)) {
              $sql .=" AND date >= '$from' AND date <'$to'"; 
        	} 

        } else {
        	$date = date('Y-m-d');
	        $from2=date_create($date);
	        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
	        $from2 =  date_format($from2,"Y-m-d H:i:s");

	        $to2=date_create($date);
	        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
	        $to2 = date_format($to2,"Y-m-d H:i:s");
        	$sql = "SELECT 
	        SUM(CASE WHEN UPPER(type) = 'Ward' THEN 1 ELSE 0 END) AS Ward,
	        SUM(if(type = 'Ward',price,0)) AS OtherWardAmount,
	        SUM(CASE WHEN UPPER(type) = 'Casualty' THEN 1 ELSE 0 END) AS Casualty,
	        SUM(if(type = 'Casualty',price,0)) AS OtherCasualtyAmount,
	        SUM(CASE WHEN UPPER(type) = 'Entitled' THEN 1 ELSE 0 END) AS Entitled,
	        SUM(if(type = 'Entitled',price,0)) AS OtherEntitledAmount,
	        SUM(CASE WHEN UPPER(type) = 'Labour_Room' THEN 1 ELSE 0 END) AS Labour_Room,
	        SUM(if(type = 'Labour_Room',price,0)) AS OtherLRoomAmount,
	        SUM(CASE WHEN UPPER(type) = 'Paid' THEN 1 ELSE 0 END) AS Paid,
	        SUM(if(type = 'Paid',price,0)) AS OtherPaidAmount, COUNT(receptNumber) AS total,
	        SUM(price) AS OthertotalAmount, dept_id AS dept_id FROM other_entry
	        WHERE id!='' AND is_deleted=0 AND date >= '$from2' and date <'$to2'";
        }

		$sql .= " GROUP BY dept_id";
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
public function show_xray($search,$from,$to)
	{
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

        if(isset($search)){
        	$sql = "SELECT 
	        SUM(if(type = 'Paid',quantity,0)) AS Paid,
	      	SUM(if(type = 'Paid',price,0)) AS PaidAmount,
	      	SUM(if(type = 'Ward',quantity,0)) AS Ward,
	      	SUM(if(type = 'Ward',price,0)) AS WardAmount,
	      	SUM(if(type = 'Labour_Room',quantity,0)) AS Labour_Room,
	      	SUM(if(type = 'Labour_Room',price,0)) AS LRoomAmount,
	      	SUM(if(type = 'Casualty',quantity,0)) AS Casualty,
	      	SUM(if(type = 'Casualty',price,0)) AS CasualtyAmount,
	      	SUM(if(type = 'Entitled',quantity,0)) AS Entitled,
	      	SUM(if(type = 'Entitled',price,0)) AS EntitledAmount,
	      	SUM(quantity) AS totalQuantity, SUM(price) AS totalAmount,
	        COUNT(receptNumber) AS total, dept_id AS dept_id
	        FROM xray_entry AS xray WHERE id!='' AND is_deleted=0";
        	if(!empty($from) && !empty($to)) {
              $sql .=" AND date >= '$from' AND date <'$to'"; 
        	} 

        } else {
        	$date = date('Y-m-d');
	        $from2=date_create($date);
	        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
	        $from2 =  date_format($from2,"Y-m-d H:i:s");

	        $to2=date_create($date);
	        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
	        $to2 = date_format($to2,"Y-m-d H:i:s");
        	$sql = "SELECT 
	        SUM(if(type = 'Paid',quantity,0)) AS Paid,
	      	SUM(if(type = 'Paid',price,0)) AS PaidAmount,
	      	SUM(if(type = 'Ward',quantity,0)) AS Ward,
	      	SUM(if(type = 'Ward',price,0)) AS WardAmount,
	      	SUM(if(type = 'Labour_Room',quantity,0)) AS Labour_Room,
	      	SUM(if(type = 'Labour_Room',price,0)) AS LRoomAmount,
	      	SUM(if(type = 'Casualty',quantity,0)) AS Casualty,
	      	SUM(if(type = 'Casualty',price,0)) AS CasualtyAmount,
	      	SUM(if(type = 'Entitled',quantity,0)) AS Entitled,
	      	SUM(if(type = 'Entitled',price,0)) AS EntitledAmount,
	      	SUM(quantity) AS totalQuantity, SUM(price) AS totalAmount,
	        COUNT(receptNumber) AS total, dept_id AS dept_id
	        FROM xray_entry AS xray
	        WHERE id!='' AND is_deleted=0 AND date >= '$from2' and date <'$to2'";
        }

		$sql .= " GROUP BY dept_id";
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
public function show_lab($search,$from,$to)
	{
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

        if(isset($search)){
        	$sql = "SELECT  
					SUM(if(type = 'Paid',price,0)) AS PaidAmount, 
					SUM(if(type = 'Paid',tests , 0)) AS PaidTests,
					SUM(if(type = 'Ward',price,0)) AS WardAmount, 
					SUM(if(type = 'Ward',tests , 0)) AS WardTests, 
					SUM(if(type = 'Casualty',price,0)) AS CasualtyAmount,
					SUM(if(type = 'Casualty',tests , 0)) AS CasualtyTests, 
					SUM(if(type = 'Entitled',price,0)) AS EntitledAmount,
					SUM(if(type = 'Entitled',tests , 0)) AS EntitledTests, 
					SUM(if(type = 'Labour_Room',price,0)) AS LRoomAmount,
					SUM(if(type = 'Labour_Room',tests , 0)) AS LRoomTests,
					SUM(price) AS labtotal, SUM(tests) AS labtotaltests, dept_id AS dept_id FROM lab_entry 
					 WHERE id!='' AND is_deleted=0";
        	if(!empty($from) && !empty($to)) {
              $sql .=" AND date >= '$from' AND date <'$to'"; 
        	} 

        } else {
        	$date = date('Y-m-d');
	        $from2=date_create($date);
	        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
	        $from2 =  date_format($from2,"Y-m-d H:i:s");

	        $to2=date_create($date);
	        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
	        $to2 = date_format($to2,"Y-m-d H:i:s");
        	$sql = "SELECT  
					SUM(if(type = 'Paid',price,0)) AS PaidAmount, 
					SUM(if(type = 'Ward',price,0)) AS WardAmount,  
					SUM(if(type = 'Casualty',price,0)) AS CasualtyAmount, 
					SUM(if(type = 'Entitled',price,0)) AS EntitledAmount, 
					SUM(if(type = 'Labour_Room',price,0)) AS LRoomAmount,
					SUM(price) AS labtotal, dept_id AS dept_id FROM lab_entry 
					WHERE id!='' AND is_deleted=0 AND date >= '$from2' and date <'$to2'";
        }

		$sql .= " GROUP BY dept_id";
		//echo $sql; //exit;
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
public function show_summary($search,$from,$to,$type)
	{
		$opd_type = "";
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

        if($type=='Paid'){
        	$opd_type = " And type='OPD'";
        } elseif ($type=='Free') {
        	$opd_type = " And type='Aged'";
        } else  {
        	$opd_type = ' ';
        }

        if(isset($search)){
        	$sql = "SELECT 
	        SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
	        SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
	        COUNT(receptNumber) AS total,
	        dept_id AS dept_id
	        FROM opd_entry
	        WHERE id!='' ".$opd_type." AND is_deleted=0";
        	if(!empty($from) && !empty($to)) {
              $sql .=" AND date >= '$from' AND date <'$to'"; 
        	} 

        } else {
        	$date = date('Y-m-d');
	        $from2=date_create($date);
	        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
	        $from2 =  date_format($from2,"Y-m-d H:i:s");

	        $to2=date_create($date);
	        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
	        $to2 = date_format($to2,"Y-m-d H:i:s");


        	$sql = "SELECT 
	        SUM(CASE WHEN UPPER(gander) = 'Male' THEN 1 ELSE 0 END) AS Male,
	        SUM(CASE WHEN UPPER(gander) = 'Female' THEN 1 ELSE 0 END) AS Female,
	        COUNT(receptNumber) AS total,
	        dept_id AS dept_id
	        FROM opd_entry
	        WHERE id!='' ".$opd_type." AND is_deleted=0 AND date >= '$from2' and date <'$to2'";
        }

		$sql .= " GROUP BY dept_id";
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

public function show_other_summary($search,$from,$to,$type)
	{
		$other_type = "";
		$other_price = "";
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

        if($type=='Paid'){
        	$other_type = " UPPER(type) = 'Paid'";
        	$other_price = "type = 'Paid'";
        } elseif ($type=='Free') {
        	$other_type = " UPPER(type) != 'Paid'";
        	$other_price = "type != 'Paid'";
        } else  {
        	$other_type = " UPPER(type) IN ('Paid', 'Ward', 'Casualty', 'Entitled', 'Labour_Room')";
        	$other_price = " UPPER(type) IN ('Paid', 'Ward', 'Casualty', 'Entitled', 'Labour_Room')";
        }

        if(isset($search)){
        	$sql = "SELECT 
	        SUM(CASE WHEN ".$other_type." THEN 1 ELSE 0 END) AS Count,
	        SUM(if(".$other_price.",price,0)) AS OtherAmount,
	        dept_id AS dept_id FROM other_entry WHERE id!='' AND is_deleted=0";
        	if(!empty($from) && !empty($to)) {
              $sql .=" AND date >= '$from' AND date <'$to'"; 
        	} 

        } else {

        	$date = date('Y-m-d');
	        $from2=date_create($date);
	        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
	        $from2 =  date_format($from2,"Y-m-d H:i:s");

	        $to2=date_create($date);
	        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
	        $to2 = date_format($to2,"Y-m-d H:i:s");


        	$sql = "SELECT 
	        SUM(CASE WHEN ".$other_type." THEN 1 ELSE 0 END) AS Count,
	        SUM(if(".$other_price.",price,0)) AS OtherAmount,
	        dept_id AS dept_id FROM other_entry WHERE id!='' AND is_deleted=0 AND date >= '$from2' and date <'$to2'";
        }

		$sql .= " GROUP BY dept_id";
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
public function show_xray_summary($search,$from,$to,$type)
	{
		$xray_type = "";
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

        if($type=='Paid'){
        	$xray_type = "type = 'Paid'";
        } elseif ($type=='Free') {
        	$xray_type = "type != 'Paid'";
        } else  {
        	$xray_type = " type IN ('Paid', 'Ward', 'Casualty', 'Entitled', 'Labour_Room')";
        }

        if(isset($search)){
        	$sql = "SELECT 
	        SUM(if(".$xray_type.",quantity,0)) AS xrayCount,
	      	SUM(if(".$xray_type.",price,0)) AS XrayAmount,
	        COUNT(receptNumber) AS total, dept_id AS dept_id
	        FROM xray_entry AS xray WHERE id!='' AND is_deleted=0";
        	if(!empty($from) && !empty($to)) {
              $sql .=" AND date >= '$from' AND date <'$to'"; 
        	} 

        } else {
        	$date = date('Y-m-d');
	        $from2=date_create($date);
	        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
	        $from2 =  date_format($from2,"Y-m-d H:i:s");

	        $to2=date_create($date);
	        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
	        $to2 = date_format($to2,"Y-m-d H:i:s");
        	$sql = "SELECT 
	        SUM(if(".$xray_type.",quantity,0)) AS xrayCount,
	      	SUM(if(".$xray_type.",price,0)) AS XrayAmount,
	        COUNT(receptNumber) AS total, dept_id AS dept_id
	        FROM xray_entry AS xray
	        WHERE id!='' AND is_deleted=0 AND date >= '$from2' and date <'$to2'";
        }

		$sql .= " GROUP BY dept_id";
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
public function show_lab_summary($search,$from,$to,$type)
	{
		$lab_type = "";
        $from=date_create($from);
        date_add($from,date_interval_create_from_date_string("+8 HOUR"));
        $from =  date_format($from,"Y-m-d H:i:s");



        $to=date_create($to);
        date_add($to,date_interval_create_from_date_string("+32 HOUR"));
        $to = date_format($to,"Y-m-d H:i:s");

        if($type=='Paid'){
        	$lab_type = "type = 'Paid'";
        } elseif ($type=='Free') {
        	$lab_type = "type != 'Paid'";
        } else  {
        	$lab_type = " type IN ('Paid', 'Ward', 'Casualty', 'Entitled', 'Labour_Room')";
        }

        if(isset($search)){
        	$sql = "SELECT  
					SUM(if(".$lab_type.",tests,0)) AS labCount,
	      			SUM(if(".$lab_type.",price,0)) AS labAmount,
					SUM(price) AS labtotal, SUM(tests) AS labtotaltests, dept_id AS dept_id FROM lab_entry 
					 WHERE id!='' AND is_deleted=0";
        	if(!empty($from) && !empty($to)) {
              $sql .=" AND date >= '$from' AND date <'$to'"; 
        	} 

        } else {
        	$date = date('Y-m-d');
	        $from2=date_create($date);
	        date_add($from2,date_interval_create_from_date_string("+8 HOUR"));
	        $from2 =  date_format($from2,"Y-m-d H:i:s");

	        $to2=date_create($date);
	        date_add($to2,date_interval_create_from_date_string("+32 HOUR"));
	        $to2 = date_format($to2,"Y-m-d H:i:s");
        	$sql = "SELECT  
					SUM(if(".$lab_type.",tests,0)) AS labCount,
	      			SUM(if(".$lab_type.",price,0)) AS labAmount,
					SUM(price) AS labtotal, dept_id AS dept_id FROM lab_entry 
					WHERE id!='' AND is_deleted=0 AND date >= '$from2' and date <'$to2'";
        }

		$sql .= " GROUP BY dept_id";
		//echo $sql; //exit;
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
public function showDept()
	{
		$result = $this->db->SELECT('*')->FROM('departments')->where(array('view !='=>'PHARMACY','is_deleted'=>0,'parent_id'=>0))->get()->result();

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