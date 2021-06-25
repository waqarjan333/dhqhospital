<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_ScriptModel extends CI_Model
{
	public function getLabMissingSerialNumber()
	{
        $sql = "SELECT `receptNumber` AS record  FROM `lab_entry` WHERE `receptNumber` NOT IN (SELECT `entry_id` FROM `lab_entry_details`) GROUP BY `receptNumber`";  
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


	public function getLabDetailMissingSerialNumber()
	{
        $sql = "SELECT `entry_id` AS record FROM `lab_entry_details` WHERE `entry_id` NOT IN (SELECT `receptNumber` FROM `lab_entry`) GROUP BY `entry_id`";  
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
    public function updateTestsCOuntLab($from,$to)
    {

        $sql = "UPDATE `lab_entry` SET `tests` = (SELECT COUNT(*) FROM `lab_entry_details` WHERE `entry_id`=`receptNumber`) WHERE `receptNumber` BETWEEN ".$from." AND ".$to;  
        $query=$this->db->query($sql);
        if($query)
        {
          echo "Script Run Successfully";
        }
        else
        {
          echo "Error";
        }

    }


    public function findDUplicateRecord($table,$column)
    {
 
        $sql = "SELECT ".$column." AS record, COUNT(*) AS count FROM ".$table." GROUP BY ".$column." HAVING COUNT(*) > 1"; 
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