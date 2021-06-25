<?php 
$con=new mysqli ('c')
 ?>
<!DOCTYPE html>

<html lang="en">
  
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Print</title>

<!-- <link rel="stylesheet" type="text/css" href="assets/css/print.css"/> -->





<style type="text/css">
  body{
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
  }


</style>

</head>

<body>
<?php 
if($_GET['inv_id'])
{
  $inv_id=$_GET['inv_id'];
}
// $this->db->select('*');
//             $this->db->where('id',$idss);
// $info = $this->db->get('unit_indent_invoice')->result_array();
// $sql1     =   "SELECT * FROM `patient_invoice` WHERE `id`='".$inv_id."'"; 
// $query=$this->db->query($exe);
// $row1     =   mysqli_fetch_assoc($res1);

// $sqlt1    =   "SELECT * FROM `tests` WHERE `id` IN (".$row1['test'].")"; 
// $rest1    = mysqli_query($conn, $sqlt1);


?>
<div id="container" style="width:750px;">
<form name="form" method="post" action="" id="form">
       <header style="height:auto; width:750px;">
        <table width="100%" height="80" border="0" cellpadding="5" cellspacing="0" style="border-bottom:2px solid #666; border:0px;">
        <tr>
         <td>
             <img src="../images/logo.png" height="120" width="120" />
         </td>
        <td style="text-align:center;">
            <p style="font-size:26px; font-weight:bold; word-spacing: 4px;">
            DISTRICT HEAD QUARTER HOSPITAL UPPER DIR
            </p>  
            
            
        </td>
     </tr>
     
     </table>
     <table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-bottom:2px solid #666; border:1px solid #999; margin-top:5px;margin-bottom:10px;">

        <thead>

            <tr>
                
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Patient Name : </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"> Ali Khan</th>
                
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Father Name &nbsp;: </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;">   ?>Ali Jan</th>
                </tr>
                <tr>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">ID Card &nbsp;&nbsp;&nbsp;&nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;"> 1503288566655 ?></th>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Mobile # &nbsp;&nbsp;&nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"> 03489150221</th>
                </tr>
                <tr>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Date &nbsp; &nbsp; &nbsp; &nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;"><?php echo date('Y-m-d') ?></th>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Slip # &nbsp; &nbsp; &nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;">  ?>09</th>
                </tr>
                
                <tr>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Type &nbsp; &nbsp; &nbsp; &nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;">General</th>
                <th align="left"; width="50%" colspan="2" style="font-family: monospace; font-size:18px;text-decoration:underline;">
                    <tr>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Type &nbsp; &nbsp; &nbsp; &nbsp; : </th>
                <th align="left"; width="25%" style="text-decoration:underline;"></th>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Date &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;: </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"><?php echo date('Y-m-d') ?></th>
                </tr>
              
                <tr>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">U/S &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; : </th>
                <th align="left"; width="25%"  style="text-decoration:underline;"></th>
                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Date &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;: </th>
                <th align="left"; width="25%" style="text-decoration:underline;font-family: monospace; font-size:18px;"></th>
                </tr>                <th align="left"; width="25%" style="font-family: monospace; font-size:18px;">Tests &nbsp; &nbsp; &nbsp;&nbsp; : </th>
                <th align="left"; width="75%" colspan="3" style="text-decoration:underline;"></th>
                </tr>
            
               
        </thead>
         </table>
     <table style="border-collapse: collapse; width:100%;">
        <thead>
            <tr>
                <th style="border: 1px solid black;  text-align:left;">S.No</th>
                <th style="border: 1px solid black;  text-align:left;">Medicines Name</th>
                <th style="border: 1px solid black;  text-align:left;">Quantity</th>
                <th style="border: 1px solid black;  text-align:left;">Comment</th>
            </tr>
        </thead>

        <tbody>
<?php 
$sql6     =   "SELECT * FROM `patient_invoice_detail` WHERE `inv_id`='".$inv_id."'"; 
$res6   = mysqli_query($conn, $sql6);
// $count=1;
// while($row6     =   mysqli_fetch_assoc($res6)){  
    
// $sql7     =   "SELECT * FROM `products` WHERE `id`='".$row6['product']."'"; 
// $res7   = mysqli_query($conn, $sql7);
// $row7     =   mysqli_fetch_assoc($res7);
// $this->db->select('*');
//             $this->db->where('id',$idss);
// $run = $this->db->get('unit_indent_invoice_detail');
//  $run = $this->db->query($sql);
// $query1=$run->rows; 
$count=0;
while($row     =   mysqli_fetch_assoc($res6))
{
  $count++;
?>
            <tr>
                <td style="border: 1px solid black;"><?php $count; ?></td>
                <td  style="border: 1px solid black;"><?php echo $row['dosage_form'] ?></td>
                <td  style="border: 1px solid black;"><?php echo $row['quantity'] ?></td>
                <td  style="border: 1px solid black;"><?php echo $row['quantity'] ?></td>
            </tr>
<?php } ?>
        </tbody>
     </table>







<div style="width:100%; float:left;">
<a style="background-color:#FFF; color:#FFF; border:0px; height:30px; width:100%;" href="patient_invoice.php">======================================================================================================================</a>
</div>

  </header>



</form>
 
</div>


<script type="text/javascript" src="js/jquery.js"></script>



<script src="include/jquery_updown.min.js"></script>

</body>
</html>