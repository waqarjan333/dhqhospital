<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>OTHER _Department</title>
<style>
body {
    line-height: 1.5em;
    font-family: Tahoma, Geneva, sans-serif;
    font-size: 14px;    padding-top: 3mm;
}
*{margin:0px;padding:0px;box-sizing: border-box;}
#container{width:83mm ;  margin:0 auto;}
.logo img {
    max-width: 65px;
}
.patientinfo {
    border: 0.75mm solid #000;
    padding: 1.5mm 1.5mm;
}
.patientinfo .title {
    font-weight: bold;
    white-space: nowrap;
    font-size: 2.7mm;
    text-decoration: none;
    padding-right: 0mm;
}
.patientinfo tr th, .patientinfo tr td {
    vertical-align: top;
    background-color: #FFFFFF;
    padding-right: 1mm;
    font-size: 3mm;
    text-decoration: underline;
    font-weight: bold;
    line-height: 1.3;
    padding-bottom: 1mm;
}
.patientinfo tr td {
    padding-right: 2mm;
    font-size: 2.6mm;
}
.patientinfo tr:last-child th, .patientinfo tr:last-child td {
    padding-bottom: 0mm !important;
}
.patientinfo tr td.colon {
    padding-right: 0.35mm;
    font-size: 2.7mm;
}
.patientinfo tr td:last-child {padding-right: 0px;}

.logo-header {
    width: 100%;
    border-bottom: none;
    border-spacing: 0px;
}
.logo-header .logo {
    width: 20%;
    padding-bottom: 1.2mm;
    padding-right: 3mm;
    text-align: center;
}
.header-title {
    padding: 0px 0px 0.2rem;
    vertical-align: top;
    font-size: 3mm;
    font-weight: bold;
    line-height: 1.3;
    letter-spacing: 1.1px;
}
.hostname {
    font-size: 5mm;
}
.ptntTotal {
    margin-top: 3mm;
    font-size: 2.7mm;
    border-right: 1mm solid #000;
    border-top: 1mm solid #000;
    border-collapse: collapse;
}
.ptntTotal td {
    font-size: 2.8mm;
    padding: 1.75mm 1.5mm;
    text-align: center;
    border-collapse: collapse;
    width: 50%;
    font-weight: bold;
    border-left: 1mm solid #000;
    border-bottom: 1mm solid #000;
}
.ptntTotal tr td {

}
.ptntTotal tr:last-child td:first-child {
    border-bottom: none;
    border-left: 0px;
}
    </style>
  </head>
  <body>
    <?php $row = $query->row_array();

      
    ?>
    <div id="container">
          <table class="logo-header" width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
              <tr>
                <td class="logo"><img src="<?php echo base_url('assets/img/opd_print_logo.jpg') ?>" alt="logo"></td>
                <td class="header-title">
                  <p class="hostname">DHQ HOSPITAL BATKHELA</p>
                  <labe style="font-size: 2.7mm;display: block;text-align: right;padding-top: 2.5mm;">
                    Date &amp; Time : <span style="text-decoration: underline;"><?php 
                    $old_date = $row['date']; 
                    $old_date_timestamp = strtotime($old_date); 
                    $new_date = date('j M, Y g:i A', $old_date_timestamp); 
                    echo $new_date;  ?></span></labe>
                </td>
              </tr>
            </tbody>
          </table>

          <table class="patientinfo" width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
              <tr >
                <th class="title" align="left">Patient Name</th>
                <td class="colon">:</td>
                <td align="left"><?php echo ucfirst($row['patient_name']) ?></td>

                <th class="title" align="left">Gender</th>
                <td class="colon">:</td>
                <th align="left" style="text-transform: capitalize;"><?php echo $row['gander'] ?></th>
              </tr>
              <tr >         
                <th class="title" align="left">Reciept #</th>
                <td class="colon">:</td>
                <td align="left"><?php echo $row['dept_nick'];?>-<?php echo $row['yearly_no'] ?>-<?php echo $row['receptNumber'] ?></td>
                <th class="title" align="left">Shift</th>
                <td class="colon">:</td>
                <td align="left"><?php echo $row['shift'] ?></td>
              </tr>
              <tr>
                <th class="title" align="left">Age</th>
                <td class="colon">:</td>
                <td align="left"><?php echo $row['age'] ?></td>
                <th class="title" align="left">Address</th>
                <td class="colon">:</td>
                <td align="left"><?php echo $row['dis_name'] ?></td>
              </tr>
              <tr >
                <th class="title" align="left">Type</th>
                <td class="colon">:</td>
                <td align="left"><?php $deptType; if($row['type']!="Paid"){ $deptType = "( Free )"; } else { $deptType = ""; } echo $row['type'].$deptType; ?></td>
                <th class="title" align="left">Department</th>
                <td class="colon">:</td>
                <td align="left"><?php echo $row['dep_name'] ?></td>
              </tr>

              <tr >
                <th class="title" align="left">Refrence # </th>
                <td class="colon">:</td>
                <td align="left"><?php echo $row['refrence'] ?></td>
                <th class="title"></th>
                <td class="colon"></td>
                <td align="left"></td>
              </tr>
              
            </thead>
          </table>

        <table class="ptntTotal" width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
              <tr >
                <td>Unit</td>
                <td>Price</td>
              </tr>
              <?php
              $sub_total = 0;
              $total_test = 0;
            $query_lab_details = $this->db->query("SELECT * FROM lab_entry_details WHERE is_deleted=0 AND yearly=".$row['yearly_no']." AND entry_id=".$row['receptNumber']." AND dept_id=".$row['dept_id']);
            $res_lab_details =  $query_lab_details->result();
                foreach($res_lab_details as $value) {

  $query_lab_type = $this->db->query("SELECT * FROM testcategories WHERE id=".$value->test_id);
  $res_lab_type =  $query_lab_type->result_array();

  $sub_total += $res_lab_type[0]['price'];
  $total_test++;
            ?>
               <tr >
                <td><?php echo $res_lab_type['0']['name']; ?></td>
                <td><?php 
                  if($row['type'] == 'Paid' ) 
                      echo $res_lab_type[0]['price'];
                    else
                    echo 0;
                   ?></td>
              </tr>
            <?php } ?>
             <tr >
                <td>Total Test</td>
                <td><?php echo $total_test; ?>/=</td>
              </tr>
              <tr >
                <td>Total</td>
                <td><?php 
                  if($row['type'] == 'Paid' ) 
                      echo $sub_total;
                    else
                    echo 0;
                   ?></td>
              </tr>
            </thead>
          </table>
    </div>
<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.js"></script>
        <script type="text/javascript">

          window.print();
          //setTimeout('window.close()', 100);

        </script>

</body>
</html>        