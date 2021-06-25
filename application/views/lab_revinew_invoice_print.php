<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LAB Revinew Invoice</title>

<style>
body {
    line-height: 1.5em;
    font-family: Tahoma, Geneva, sans-serif;
    font-size: 14px;    padding-top: 3mm;
}
*{margin:0px;padding:0px;box-sizing: border-box;}

table {
    border-collapse: collapse;
    border-spacing: 0;
}
table.main-table {
    border: 3px solid #000;
}


table.header-table td.logo {
    width: 27%;
    border-radius: 100%;
}
table.header-table td.logo figure {
    border: 3px solid #000;
    width: 190px;
    height: 190px;
    border-radius: 100%;
    overflow: hidden;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 14px;
}
table.header-table td.logo img {
    width: 90%;
}

table.header-table > tbody > tr > td {
    padding: 7pt 9pt;
}

table.header-table > tbody > tr > td h2  {
  font-size: 22pt;line-height: normal;border-bottom: 3px solid #000;
  display: inline-block;padding-bottom: 2px;margin-bottom: 14px;}

table.header-table > tbody > tr > td table {
    font-size: 14pt;
    font-weight: bold;
    width: 100%;
}
table.about-patient tr td {
    padding-right: 9pt;
    vertical-align:top;
    padding-bottom:  7pt;
}
table.about-patient tr td:first-child {white-space: nowrap;}
table.about-patient tr td:last-child {width: 100%;}
table.about-patient tr td:last-child span { display:block;border-bottom: 2px solid #000; padding-bottom:2px}





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
    font-size: 15pt;
    line-height: normal;
}
.ptntTotal td {
    padding: 15px 14px;
    border-collapse: collapse;
    font-weight: bold;
    border: 3px solid #000;
}
.ptntTotal tr td:first-child {
    border-left: none;
    white-space: nowrap;
}
.ptntTotal tr td:last-child {
    width: 100%;
    border-right: none;
    text-align: center;
}
.ptntTotal tr:last-child td {
    border-bottom: none;
}


    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  </head>
  <body>
    <?php if(count($result_array) > 0){?>
   
    <table class="main-table" style="margin: 0px auto; width: 750px;">
      <tbody>
        <!-- Header tr start here  -->
        <tr>
          <td>
            <table class="header-table">
              <tbody>
                <tr>
                  <td class="logo"><figure><img src="<?php echo base_url('assets/img/opd_print_logo.jpg') ?>" alt=""></figure></td>
                  <td>
                    <h2>DHQ HOSPITAL BATKHELA</h2>
                    <table class="about-patient">
                      <tr>
                        <td>User</td>
                        <td>:</td>
                        <td><span><?php echo $this->session->userdata('full_name');  ?></span></td>
                      </tr>
                      <tr>
                        <td>Shift</td>
                        <td>:</td>
                        <td><span>Morning</span></td>
                      </tr>
                      <tr>
                        <td>Date</td>
                        <td>:</td>
                        <td><span><?php echo date('j M, Y', strtotime($date));  ?></span></td>
                      </tr>
                      <tr>
                        <td>Department</td>
                        <td>:</td>
                        <td><span><?php echo $dept_name; ?></span></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- header tr end here -->
        <tr>
          <td>
            <table class="ptntTotal" width="100%" border="0" cellpadding="5" cellspacing="0">
            <body>
              <tr>
                <td style="width: 25%;">Serial </td>
                <td style="width: 25%;"><?php echo $result_array[0]->SerialStartFrom ?><small style="font-size: 10px;">(From)</small></td>
                <td style="width: 25%;"><?php echo $result_array[0]->SerialEndTo ?><small style="font-size: 10px;">(To)</small></td>
                <td style="width: 25%;"><?php echo $result_array[0]->SerialEndTo-$result_array[0]->SerialStartFrom+1; ?><small style="font-size: 10px;">(Total Receipts)</small></td>
              </tr>
              <tr>
                <td>Total:</td>
                <td><?php echo $result_array[0]->TotalReceipts ?><small style="font-size: 10px;">(Receipts)</small></td>
                <td><?php echo $result_array[0]->TotalTests ?><small style="font-size: 10px;">(Tests)</small></td>
                <td> <?php echo $result_array[0]->TotalTestsAmount ?><small style="font-size: 10px;">(Tests Amount)</small></td>
              </tr>
              <tr>
                <td>Paid:</td>
                <td>
                <?php 
                  if($result_array[0]->PaidReceipts!='' || $result_array[0]->PaidReceipts!=0){ 
                  echo $result_array[0]->PaidReceipts ?>
                  <small style="font-size: 10px;">(Receipts)</small>
                <?php } else { echo 0; } ?>
              </td>
              <td>
                <?php 
                  if($result_array[0]->PaidTests!='' || $result_array[0]->PaidTests!=0){ 
                  echo $result_array[0]->PaidTests ?>
                  <small style="font-size: 10px;">(Tests)</small>
                <?php } else { echo 0; } ?>
              </td>
               <td>
                <?php 
                  if($result_array[0]->PaidTestsAmount!='' || $result_array[0]->PaidTestsAmount!=0){ 
                  echo $result_array[0]->PaidTestsAmount ?>
                  <small style="font-size: 10px;">(Amount)</small>
                <?php } else { echo 0; } ?>
              </td>
              </tr>
              <tr>
                <td>Casualty:</td>
                <td>
                <?php 
                  if($result_array[0]->CasualtyReceipts!='' || $result_array[0]->CasualtyReceipts!=0){ 
                  echo $result_array[0]->CasualtyReceipts ?>
                  <small style="font-size: 10px;">(Receipts)</small>
                <?php } else { echo 0; } ?>
              </td>
              <td>
                <?php 
                  if($result_array[0]->CasualtyTests!='' || $result_array[0]->CasualtyTests!=0){ 
                  echo $result_array[0]->CasualtyTests ?>
                  <small style="font-size: 10px;">(Tests)</small>
                <?php } else { echo 0; } ?>
              </td>
               <td>
                <?php 
                  if($result_array[0]->CasualtyTestsAmount!='' || $result_array[0]->CasualtyTestsAmount!=0){ 
                  echo $result_array[0]->CasualtyTestsAmount ?>
                  <small style="font-size: 10px;">(Amount)</small>
                <?php } else { echo 0; } ?>
              </td>
              </tr>
              <tr>
                <td>Wards:</td>
                <td>
                <?php 
                  if($result_array[0]->WardReceipts!='' || $result_array[0]->WardReceipts!=0){ 
                  echo $result_array[0]->WardReceipts ?>
                  <small style="font-size: 10px;">(Receipts)</small>
                <?php } else { echo 0; } ?>
              </td>
              <td>
                <?php 
                  if($result_array[0]->WardTests!='' || $result_array[0]->WardTests!=0){ 
                  echo $result_array[0]->WardTests ?>
                  <small style="font-size: 10px;">(Tests)</small>
                <?php } else { echo 0; } ?>
              </td>
               <td>
                <?php 
                  if($result_array[0]->WardTestsAmount!='' || $result_array[0]->WardTestsAmount!=0){ 
                  echo $result_array[0]->WardTestsAmount ?>
                  <small style="font-size: 10px;">(Amount)</small>
                <?php } else { echo 0; } ?>
              </td>
              </tr>
              <tr>
                <td>Labour Room:</td>
                <td>
                <?php 
                  if($result_array[0]->LabourRoomReceipts!='' || $result_array[0]->LabourRoomReceipts!=0){ 
                  echo $result_array[0]->LabourRoomReceipts ?>
                  <small style="font-size: 10px;">(Receipts)</small>
                <?php } else { echo 0; } ?>
              </td>
              <td>
                <?php 
                  if($result_array[0]->LabourRoomTests!='' || $result_array[0]->LabourRoomTests!=0){ 
                  echo $result_array[0]->LabourRoomTests ?>
                  <small style="font-size: 10px;">(Tests)</small>
                <?php } else { echo 0; } ?>
              </td>
               <td>
                <?php 
                  if($result_array[0]->LabourRoomTestsAmount!='' || $result_array[0]->LabourRoomTestsAmount!=0){ 
                  echo $result_array[0]->LabourRoomTestsAmount ?>
                  <small style="font-size: 10px;">(Amount)</small>
                <?php } else { echo 0; } ?>
              </td>
              </tr>
              <tr>
                <td>Entitled:</td>
                <td>
                <?php 
                  if($result_array[0]->EntitledReceipts!='' || $result_array[0]->EntitledReceipts!=0){ 
                  echo $result_array[0]->EntitledReceipts ?>
                  <small style="font-size: 10px;">(Receipts)</small>
                <?php } else { echo 0; } ?>
              </td>
              <td>
                <?php 
                  if($result_array[0]->EntitledTests!='' || $result_array[0]->EntitledTests!=0){ 
                  echo $result_array[0]->EntitledTests ?>
                  <small style="font-size: 10px;">(Tests)</small>
                <?php } else { echo 0; } ?>
              </td>
               <td>
                <?php 
                  if($result_array[0]->EntitledTestsAmount!='' || $result_array[0]->EntitledTestsAmount!=0){ 
                  echo $result_array[0]->EntitledTestsAmount ?>
                  <small style="font-size: 10px;">(Amount)</small>
                <?php } else { echo 0; } ?>
              </td>
              </tr>
               <tr>
                <td colspan="4"></td>
              </tr>
              <tr>
                <td colspan="2">User Sign</td>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td colspan="2">Cash Reciever Sign</td>
                <td colspan="2"></td>
              </tr>
            </body>
          </table>
          </td>
        </tr>
      </tbody>
    </table>

    <?php } ?>


<script>
// window.print();
// window.close();
</script>

</body> 