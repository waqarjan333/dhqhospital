<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>OPD</title>
    <style>
    body{ line-height:1.5em; margin:0; padding:0; font-family:Tahoma, Geneva, sans-serif; font-size:14px; padding-top:10px;}
    *{
    margin:0px;
    padding:0px;
    }

    #container{width:800px; min-height:700px; margin:0 auto;}
    header {
    padding: 0px 10px 0px;
    box-sizing: border-box;
    }
    footer{ padding:10px; height:100px;box-sizing: border-box;}
    table th{ background-color:#F5F5F5}
    h1,h2,h3,h4,h5{padding:0px; margin:0px;}
    .tb_border{ border:2px solid #666; margin-bottom:10px; border-collapse:collapse; border-spacing:0;}
    .tb_border td{ border:0; border-bottom:1px solid #666; border-left:1px solid #666; }
    .tb_border th{ border:0; border-bottom:2px solid #666; border-left:1px solid #666; border-top:2px solid #666;}
    table tr td h2{
    float: left;
    margin-left: 140px;
    margin-top: 55px;
    font-size:36px;
    }
.logo img {
    max-width: 112px;
}
.patientinfo {
    border: 3px solid #000;
    padding: 9px 10px;
}
.patientinfo .title {
    font-weight: bold;
    white-space: nowrap;
    padding-bottom: 7px;
    font-size: 17px;
    text-decoration: none;
    padding-right: 5px;
}

.patientinfo tr th, .patientinfo tr td {
    vertical-align: top;
    background-color: #FFFFFF;
    padding-right: 11px;
    font-size: 16px;
    text-decoration: underline;
    font-weight: bold;
}
.patientinfo tr:last-child th { padding-bottom: 0px; }
.patientinfo tr td:last-child { padding-right: 0px; }

.logo-header {
    width: 100%;
    border-bottom: none;
    border-spacing: 0px;
}
.logo-header .logo {
    width: 20%;
    padding: 5px;
    text-align: center;
}
.header-title {
    padding: 30px 0px 3px;
    vertical-align: top;
    font-size: 22px;
    font-weight: bold;
    line-height: 1.3;
    letter-spacing: 1.1px;
}
.hostname {
    font-size: 27px;
}
.content { padding: 0px 10px; width: 100%;box-sizing: border-box;}
.content table {
    width: 100%;
    /* border: 3px solid #000; */
    border-top: none;
    border-spacing: 0px;
    min-height: 650px;
}
.patientdesc-left {width: 30%;}

td.patientdesc-right {
    width: 70%;
    border-left: 3px solid #000;
}

table.patientdesc td {
    vertical-align: top;
    font-size: 16px;
    padding: 9px 10px;
}

      center table{ border-collapse:collapse;}
      center table th{ padding:5px;border-bottom:1px solid #000;}
      center table td{ border:1px solid #CCC;}
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  </head>
  <body>
    <?php $row = $query->row_array();?>
    <div id="container" style="width:750px;" id="layer">
      <form name="form" method="post" action="" id="form">
        <header style="height:auto; width:750px;">
          <table class="logo-header" width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
              <tr>
                <td class="logo"><img src="<?php echo base_url('assets/img/opd_print_logo.jpg') ?>" alt="logo"></td>
                <td class="header-title">
                  <p class="hostname">DHQ HOSPITAL BATKHELA</p>
                  <p>OUT PATIENT DEPARTMENT</p>
                  
                  <labe style="font-size: 16px;display: block;text-align: right;padding-top: 20px;">
                    Date &amp; Time : <span style="text-decoration: underline;">
                    <?php 
                    $old_date = $row['date']; 
                    $old_date_timestamp = strtotime($old_date); 
                    $new_date = date('j M, Y g:i A', $old_date_timestamp); 
                    echo $new_date;  ?> </span></labe>
                </td>
              </tr>
            </tbody>
          </table>

          <table class="patientinfo" width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
              <tr height="20">
                
                <th class="title" align="left" ;="" width="22%" style="">Patient Name</th>
                <td class="colon">:</td>
                <td align="left" ;="" width="45%" style=""><?php echo strtoupper($row['patient_name']); ?></td>
                <th class="title" align="left" ;="" width="10%" style="">Gender</th>
                <td class="colon">:</td>
                <th align="left" ;="" width="18%" style="text-transform: capitalize;"><?php echo $row['gander'] ?></th>
              </tr>
              <tr height="20">
                <th class="title" align="left" ;="" width="20%" style="">Address</th>
                <td class="colon">:</td>
                <td align="left" ;="" width="45%"><?php echo $row['dis_name'] ?></td>
                
                <th class="title" align="left" ;="" width="10%">Reciept #</th>
                <td class="colon">:</td>
                <td align="left" ;="" width="20%" style="white-space: nowrap;"><?php echo $nick[0]['dept_nick'];?>-<?php echo $row['yearly_no'] ?>-<?php echo $row['receptNumber'] ?></td>
              </tr>
              <tr height="20">
                <th class="title" align="left" ;="" width="20%" style="">Shift</th>
                <td class="colon">:</td>
                <td align="left" ;="" width="45%" style=""><?php echo $row['shift'] ?></td>
                <th class="title" align="left" ;="" width="15%" style="">Age</th>
                <td class="colon">:</td>
                <td align="left" ;="" width="20%" style=""><?php echo $row['age'] ?></td>
              </tr>
              <tr height="20">
                <th class="title" align="left" ;="" width="20%" style="">Type</th>
                <td class="colon">:</td>
                <td align="left" ;="" width="45%" style=""><?php echo $row['type'] ?></td>
                <th class="title" align="left" ;="" width="15%" style=""><?php if($row['type']=="Aged"){ echo "Free"; } ?></th>
                <td class="colon"></td>
                <td align="left" ;="" width="20%" style=""></td>
              </tr>
            </thead>
          </table>
        </header>
        <div class="content">
        <table class="patientdesc" width="100%" border="0" cellpadding="5" cellspacing="0">
          <tbody>
            <tr>
              <td class="patientdesc-left">
                <p style="font-weight: bold;font-size: 17px;">
                  Investigation
                </p>
              </td>
              <td class="patientdesc-right">
                <img src="<?php echo base_url('assets/img/logorx.jpg') ?>" alt="logo">
              </td>
            </tr>
          </tbody>
        </table>
        </div>
        <div style="float: right;">
          <p>----------------------</p>
          <b style="font-weight: bold; ">Doctor Sign</b>
        </div>
        <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.js"></script>
        <script type="text/javascript">

          window.print();
          setTimeout('window.close()', 100);

        </script>