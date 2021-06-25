<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PharmacyReportMdl extends CI_Model
{
	public function getPatientInvoiceReport()
	{
		$sql="SELECT pi.invoice_id,pi.name AS patient_name,pi.mobile_no AS mobile_no,pi.id_card AS id_card, pi.receptNumber,pid.item_id,pid.qty,i.name FROM patient_indent_invoice pi LEFT JOIN patient_invoice_detail pid ON (pi.invoice_id=pid.inv_id) LEFT JOIN item i ON (i.id=pid.item_id)";
		$query=$this->db->query($sql);
		return $query;
	}

	public function getStockReport($search,$product_cat,$p_name)
	{
		$cat='';
		$item='';
		$dated='';
		if(isset($search))
       {
       	// echo $date;exit;
       	if(!empty($product_cat))
       	{
       		$cat=" x.category='$product_cat' ";	
       	}
       	else{
       		$cat="x.category !='' ";
       	}
       	if(!empty($p_name))
       	{
       		$item=" AND x.id='$p_name'";
       	}
       	else{
       		$item=" AND x.id !='' ";
       	}
        $sql="SELECT * FROM (SELECT id,name,quantity,category FROM item) x 

		LEFT JOIN (SELECT SUM(patient_invoice_detail.qty) as p_qty,patient_invoice_detail.item_id AS p_pid FROM patient_invoice_detail GROUP BY p_pid ) y ON x.id=y.p_pid 
		LEFT JOIN (SELECT SUM(unit_indent_invoice_detail.quantity) AS uind_qty,unit_indent_invoice_detail.product AS unid_pid FROM unit_indent_invoice_detail GROUP BY unid_pid) z ON x.id=z.unid_pid 

		LEFT JOIN (SELECT SUM(supplier_invoice_detail.quantity) AS sup_qty,supplier_invoice_detail.product AS sup_pid FROM supplier_invoice_detail GROUP BY sup_pid) q ON x.id=q.sup_pid
           LEFT JOIN (SELECT SUM(adjust_stock.qty) AS adj_qty,adjust_stock.item_id AS adj_pid FROM adjust_stock GROUP BY adj_pid) j ON x.id=j.adj_pid WHERE ".$cat." ".$item."  ORDER BY x.category ASC";
		// echo $sql;exit;
      } 
      else{
      	 $sql="SELECT * FROM (SELECT id,name,quantity,category FROM item) x 

LEFT JOIN (SELECT SUM(patient_invoice_detail.qty) as p_qty,patient_invoice_detail.item_id AS p_pid FROM patient_invoice_detail GROUP BY p_pid ) y ON x.id=y.p_pid 

LEFT JOIN (SELECT SUM(unit_indent_invoice_detail.quantity) AS uind_qty,unit_indent_invoice_detail.product AS unid_pid FROM unit_indent_invoice_detail GROUP BY unid_pid) z ON x.id=z.unid_pid 

LEFT JOIN (SELECT SUM(supplier_invoice_detail.quantity) AS sup_qty,supplier_invoice_detail.product AS sup_pid FROM supplier_invoice_detail GROUP BY sup_pid) q ON x.id=q.sup_pid
LEFT JOIN (SELECT SUM(adjust_stock.qty) AS adj_qty,adjust_stock.item_id AS adj_pid FROM adjust_stock GROUP BY adj_pid) j ON x.id=j.adj_pid
 ORDER BY x.category ASC";
      }

		 $query=$this->db->query($sql);
		return $query;
	}

	public function getSupplierReport()
	{
		
         $sql="SELECT pi.id,pi.receptNumber,pid.product,pid.quantity,i.name FROM supplier_invoice pi LEFT JOIN supplier_invoice_detail pid ON (pi.id=pid.inv_id) LEFT JOIN item i ON (i.id=pid.product)";

		$query=$this->db->query($sql);
		return $query;
	}

	public function getStockReportByDate($search,$product_cat,$p_name,$date)
	{

			if(isset($search))
       {

		if(!empty($product_cat))
       	{
       		$cat=" AND i.category='$product_cat' ";	
       	}
       	else{
       		$cat=" AND i.category !='' ";
       	}
       	if(!empty($p_name))
       	{
       		$item=" i.id='$p_name'";
       	}
       	else{
       		$item=" i.id !='' ";
       	}
       	if(!empty($date))
       	{
       	   $dated="inv_date<='".$date."'";	
       	}
       	else{
       		$dated ="inv_date !=''";
       	    }

		$sql="SELECT * FROM (SELECT id,name,category,quantity AS open_qty FROM item) i LEFT JOIN (SELECT SUM(quantity) AS suplier_qty,product,inv_date FROM supplier_invoice_detail WHERE ".$dated." group BY product) spid ON (i.id=spid.product) LEFT JOIN (SELECT SUM(quantity) AS indent_qty,product,inv_date FROM unit_indent_invoice_detail WHERE ".$dated." GROUP BY product) unid ON (i.id=unid.product)
                   LEFT JOIN (SELECT SUM(qty) AS patient_qty,item_id,inv_date FROM patient_invoice_detail WHERE ".$dated." GROUP BY item_id) pidt ON (i.id=pidt.item_id) WHERE ".$item." ".$cat." ORDER BY i.category";
		 // echo $sql;exit;
		}
		else{
                  $sql="SELECT * FROM (SELECT id,category,name,quantity AS open_qty FROM item) i LEFT JOIN (SELECT SUM(quantity) AS suplier_qty,product FROM supplier_invoice_detail group BY product) spid ON (i.id=spid.product) LEFT JOIN (SELECT SUM(quantity) AS indent_qty,product FROM unit_indent_invoice_detail GROUP BY product) unid ON (i.id=unid.product) LEFT JOIN (SELECT SUM(qty) AS patient_qty,item_id FROM patient_invoice_detail GROUP BY item_id) pidt ON (i.id=pidt.item_id) ORDER BY i.category";
		  // echo $sql;exit;
		}

		$query=$this->db->query($sql);
		return $query;
	}


      public function item_summary_report()
      {
            $sql="SELECT * FROM item ORDER BY company,category ASC";
            $query=$this->db->query($sql);
            return $query;      
      }
	
}		