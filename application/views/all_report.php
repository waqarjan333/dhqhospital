<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/tableexport.min.css">
<style type="text/css">
    table {
        font-size: 10px;
    }
    .printdiv tr th{
      border-top: none !important;
    }
    .printdiv{
      display: none;
    }
   @media print {
        #printcontent {
          display: none;
        }
       .printdiv{
      display: block;
    }

        }
      }
</style>
    
    <section class="content" style="margin-top: 5px; padding: 5px !important;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
<?php 
error_reporting(0);
$from = $to = '';

if($this->input->post('from')!='')
$from = $this->input->post('from');
else
$from = date('m/d/Y');

if($this->input->post('to')!='')
$to = $this->input->post('to');
else
$to = date('m/d/Y');
?>
    <form method="post" action="<?php echo base_url('/All_report/') ?>">
        <div class="col-md-3">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="from"  value="<?php echo $from; ?>" required>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label>To Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="to"  value="<?php echo $to; ?>" required>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label>
            <input type="submit" name="search" id="search" value="Search" class="form-control btn btn-success"  />
        </div>        
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    <div class="box box-primary">
    <div class="box-body"id="printable" style="width: 100%;margin: 0 auto;">
      <button class="btn btn-success pull-right" id="printcontent">Print</button>
    <div class="col-md-12" id="printTable">        
    <table class="table printdiv">
      <tr>
     <?php 
     $from = $to ='';

if($this->input->post('from')!='')
$from = $this->input->post('from');
else
$from = date('m/d/Y');

if($this->input->post('to')!='')
$to = $this->input->post('to');
else
$to = date('m/d/Y');
        $get_logo = $this->db->SELECT('*')->FROM('hospital_info')->get()->result_array(); 
        $logo = $get_logo[0]['logo'];
        $name = $get_logo[0]['name'];
     ?>       
  <th rowspan="2" width="14%" ><img src="<?php echo $logo ?>" width="140" alt="" ></th>
  <th width="40%"><h1 style="text-transform: uppercase;"><?php echo $name; ?></h1></th>
   </tr>
   <tr>
      <th><h4>From Date :<?php echo $from ?>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp; To Date :<?php echo $to ?></h4></th>
    <th></th>
   </tr>
    </table>
    <colgroup><col width="20%"><col width="35%"><col width="40%"></colgroup>
    <div class="row" style="margin-right: -5px; margin-left: -5px;">
        <?php 
         $totalPaid = $totalAged = $totalMale = $totalFemale = $totaltotal = '';
         $totalPaidOther = $totalWardOther = $totalCasualtyOther = '';
         $totalEntitledOther = $totalLRoomOther = $totaltotalOther = '';
         $totalPaidOtherAmount = $totalWardOtherAmount = $totalCasualtyOtherAmount = '';
         $totalEntitledOtherAmount = $totalLRoomOtherAmount = $totaltotalOtherAmount = '';
         $TotalFreeXray = $TotalPaidXray = $TotalFreeXrayAmount =  $TotalPaidXrayAmount = "";
         $totalFreelabAmount = $totalPaidabAmount = "";
         $totalopdFreeCount=$totalopdFreeAmount=0;
        if(count($opddata) > 0){ 
        ?>
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Departments Of OPD</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
                        <th colspan="2">Paid</th>
                        <th colspan="2">Free</th>
                        <th colspan="2">Male</th>
                        <th colspan="2">Female</th>
                        <th colspan="2">Total</th>
                    </tr> 

                    <tr class="danger">
                        <th></th>
                        <th>Count</th>
                        <th>Amount</th>
                        <th>Count</th>
                        <th>Amount</th>
                        <th>Count</th>
                        <th>Amount</th>
                        <th>Count</th>
                        <th>Amount</th>
                        <th>Count</th>
                        <th>Amount</th>
                    </tr> 
                </thead>
              <tbody>
                <?php
                
                foreach ($opddata as $row) { 
$opd_query = $this->db->query("SELECT dep_name, dept_price FROM departments WHERE id=".$row->dept_id)->result_array();
                    ?>
                  <tr>
                      <td class="primary"><?php echo $opd_query[0]['dep_name']; ?></td>
                      <td><?php echo $row->Paid ?></td>
                      <td><?php echo $row->Paid*$opd_query[0]['dept_price']; ?></td>
                      <td><?php echo $row->Aged ?></td>
                      <td><?php echo $row->Aged*$opd_query[0]['dept_price']; ?></td>
                      <td><?php echo $row->Male ?></td>
                      <td><?php echo $row->Male*$opd_query[0]['dept_price']; ?></td>
                      <td><?php echo $row->Female ?></td>
                      <td><?php echo $row->Female*$opd_query[0]['dept_price']; ?></td>
                      <td><?php echo $row->total ?></td>
                      <td><?php echo $row->total*$opd_query[0]['dept_price']; ?></td>
                  </tr>
                  <?php  
                    $totalPaid = $totalPaid + $row->Paid;
                    $totalAged = $totalAged + $row->Aged;
                    $totalMale = $totalMale + $row->Male;
                    $totalFemale = $totalFemale + $row->Female;
                    $totaltotal = $totaltotal + $row->total;
                    } ?>
                  
              </tbody>
              <tfoot>
                  <tr class="danger">
                      <th>Total</th>
                      <th><?php echo $totalPaid ?></th>
                      <th><?php echo $totalPaid*$opd_query[0]['dept_price']; ?></th>
                      <th><?php echo $totalAged ?></th>
                      <th><?php echo $totalAged*$opd_query[0]['dept_price']; ?></th>
                      <th><?php echo $totalMale ?></th>
                      <th><?php echo $totalMale*$opd_query[0]['dept_price']; ?></th>
                      <th><?php echo $totalFemale ?></th>
                      <th><?php echo $totalFemale*$opd_query[0]['dept_price']; ?></th>
                      <th><?php echo $totaltotal ?></th>
                      <th><?php echo $totaltotal*$opd_query[0]['dept_price']; ?></th>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>
    <?php } ?>
      </div>
        <div class="row" style="margin-right: -5px; margin-left: -5px;">
        <?php if(count($otherdata) > 0){ ?>
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Other Departments</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
                        <th colspan="2">Ward</th>
                        <th colspan="2">Caualty</th>
                        <th colspan="2">Entitled</th>
                        <th colspan="2">L Room</th>
                        <th colspan="2">Paid</th>
                        <th colspan="2">Total</th>
                    </tr> 
                    <tr class="danger">
                      <th></th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                  </tr>
                </thead>
              <tbody>
                <?php 
                
                foreach ($otherdata as $rows_other) { 
            $other_query = $this->db->query("SELECT dep_name FROM departments WHERE id=".$rows_other->dept_id)->result_array();
                ?>
                  <tr>
                      <td class="primary"><?php echo $other_query[0]['dep_name']; ?></td>
                      <td><?php echo $rows_other->Ward ?></td>
                      <td><?php echo $rows_other->OtherWardAmount ?></td>
                      <td><?php echo $rows_other->Casualty ?></td>
                      <td><?php echo $rows_other->OtherCasualtyAmount ?></td>
                      <td><?php echo $rows_other->Entitled ?></td>
                      <td><?php echo $rows_other->OtherEntitledAmount ?></td>
                      <td><?php echo $rows_other->Labour_Room ?></td>
                      <td><?php echo $rows_other->OtherLRoomAmount ?></td>
                      <td><?php echo $rows_other->Paid ?></td>
                      <td><?php echo $rows_other->OtherPaidAmount ?></td>
                      <td><?php echo $rows_other->total ?></td>
                      <td><?php echo $rows_other->OthertotalAmount ?></td>
                  </tr>
                  <?php  
                    $totalPaidOther = $totalPaidOther + $rows_other->Paid;
                    $totalWardOther = $totalWardOther + $rows_other->Ward;
                    $totalCasualtyOther = $totalCasualtyOther + $rows_other->Casualty;
                    $totalEntitledOther = $totalEntitledOther + $rows_other->Entitled;
                    $totalLRoomOther = $totalLRoomOther + $rows_other->Labour_Room;
                    $totaltotalOther = $totaltotalOther + $rows_other->total;

                    $totalPaidOtherAmount = $totalPaidOtherAmount + $rows_other->OtherPaidAmount;
                    $totalWardOtherAmount = $totalWardOtherAmount + $rows_other->OtherWardAmount;
                    $totalCasualtyOtherAmount = $totalCasualtyOtherAmount + $rows_other->OtherCasualtyAmount;
                    $totalEntitledOtherAmount = $totalEntitledOtherAmount + $rows_other->OtherEntitledAmount;
                    $totalLRoomOtherAmount = $totalLRoomOtherAmount + $rows_other->OtherLRoomAmount;
                    $totaltotalOtherAmount = $totaltotalOtherAmount + $rows_other->OthertotalAmount;


                    } ?>
                  
              </tbody>
              <tfoot>
                  <tr class="danger">
                      <th>Total</th>
                      <th><?php echo $totalWardOther ?></th>
                      <th><?php echo $totalWardOtherAmount ?></th>
                      <th><?php echo $totalCasualtyOther ?></th>
                      <th><?php echo $totalCasualtyOtherAmount ?></th>
                      <th><?php echo $totalEntitledOther ?></th>
                      <th><?php echo $totalEntitledOtherAmount ?></th>
                      <th><?php echo $totalLRoomOther ?></th>
                      <th><?php echo $totalLRoomOtherAmount ?></th>
                      <th><?php echo $totalPaidOther ?></th>
                      <th><?php echo $totalPaidOtherAmount ?></th>
                      <th><?php echo $totaltotalOther ?></th>
                      <th><?php echo $totaltotalOtherAmount ?></th>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>
    <?php } ?>
      </div>
        <div class="row" style="margin-right: -5px; margin-left: -5px;">
        <?php if(count($xraydata) > 0){ ?>
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Department Of XRAY</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
                        <th colspan="2">Ward</th>
                        <th colspan="2">Caualty</th>
                        <th colspan="2">Entitled</th>
                        <th colspan="2">L Room</th>
                        <th colspan="2">Paid</th>
                        <th colspan="2">Total</th>
                    </tr> 
                    <tr class="danger">
                      <th></th>
                      <th>Films</th>
                      <th>Amount</th>
                      <th>Films</th>
                      <th>Amount</th>
                      <th>Films</th>
                      <th>Amount</th>
                      <th>Films</th>
                      <th>Amount</th>
                      <th>Films</th>
                      <th>Amount</th>
                      <th>Films</th>
                      <th>Amount</th>
                  </tr>
                </thead>
              <tbody>
                  
                <?php 
                

                foreach ($xraydata as $rows_xray) { 
                $xray_query = $this->db->query("SELECT dep_name FROM departments WHERE id=".$rows_xray->dept_id)->result_array();
                $TotalFreeXray = $rows_xray->Ward+$rows_xray->Casualty+$rows_xray->Entitled+$rows_xray->Labour_Room;
                $TotalPaidXray = $rows_xray->Paid;
                $TotalFreeXrayAmount = $rows_xray->WardAmount+$rows_xray->CasualtyAmount+$rows_xray->EntitledAmount+$rows_xray->LRoomAmount;
                  $TotalPaidXrayAmount = $rows_xray->PaidAmount;
                ?>
                  <tr>
                      <td class="primary"><?php echo $xray_query[0]['dep_name']; ?></td>
                      <td><?php echo $rows_xray->Ward ?></td>
                      <td><?php echo $rows_xray->WardAmount ?></td>
                      <td><?php echo $rows_xray->Casualty ?></td>
                      <td><?php echo $rows_xray->CasualtyAmount ?></td>
                      <td><?php echo $rows_xray->Entitled ?></td>
                      <td><?php echo $rows_xray->EntitledAmount ?></td>
                      <td><?php echo $rows_xray->Labour_Room ?></td>
                      <td><?php echo $rows_xray->LRoomAmount ?></td>
                      <td><?php echo $rows_xray->Paid ?></td>
                      <td><?php echo $rows_xray->PaidAmount ?></td>
                      <td><?php echo $rows_xray->totalQuantity ?></td>
                      <td><?php echo $rows_xray->totalAmount ?></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
    <?php } ?>
      </div>

      <div class="row" style="margin-right: -5px; margin-left: -5px;">
        <?php if(count($labdata) > 0){ ?>
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Departments Of Laboratory</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
                        <th colspan="2">Ward</th>
                        <th colspan="2">Caualty</th>
                        <th colspan="2">Entitled</th>
                        <th colspan="2">L Room</th>
                        <th colspan="2">Paid</th>
                        <th colspan="2">Total</th>
                    </tr> 
                    <tr class="danger">
                      <th></th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                  </tr> 
                </thead>
              <tbody>
                  
                <?php 
                $totalWardTests = $totalWardAmount = $totalCasualtyTests = $totalCasualtyAmount = $totalEntitledTests = $totalEntitledAmount = $totalLRoomTests = $totalLRoomAmount = $totalPaidTests = $totalPaidAmount = $totallabtotaltests = $totallabtotal = 0;
                foreach ($labdata as $rows_lab) { 
                    

            $lab_query = $this->db->query("SELECT dep_name FROM departments WHERE id=".$rows_lab->dept_id)->result_array();
                    ?>
                  <tr>
                      <td class="primary"><?php echo $lab_query[0]['dep_name']; ?></td>
                      <td><?php echo $rows_lab->WardTests ?></td>
                      <td><?php echo $rows_lab->WardAmount ?></td>
                      <td><?php echo $rows_lab->CasualtyTests ?></td>
                      <td><?php echo $rows_lab->CasualtyAmount ?></td>
                      <td><?php echo $rows_lab->EntitledTests ?></td>
                      <td><?php echo $rows_lab->EntitledAmount ?></td>
                      <td><?php echo $rows_lab->LRoomTests ?></td>
                      <td><?php echo $rows_lab->LRoomAmount ?></td>
                      <td><?php echo $rows_lab->PaidTests ?></td>
                      <td><?php echo $rows_lab->PaidAmount ?></td>
                      <td><?php echo $rows_lab->labtotaltests ?></td>
                      <td><?php echo $rows_lab->labtotal ?></td>
                  </tr>
                  <?php 

                  $totalWardTests = $totalWardTests + $rows_lab->WardTests;
                  $totalWardAmount = $totalWardAmount + $rows_lab->WardAmount;
                  $totalCasualtyTests = $totalCasualtyTests + $rows_lab->CasualtyTests;
                  $totalCasualtyAmount = $totalCasualtyAmount + $rows_lab->CasualtyAmount;
                  $totalEntitledTests = $totalEntitledTests + $rows_lab->EntitledTests;
                  $totalEntitledAmount = $totalEntitledAmount + $rows_lab->EntitledAmount;
                  $totalLRoomTests = $totalLRoomTests + $rows_lab->LRoomTests;
                  $totalLRoomAmount = $totalLRoomAmount + $rows_lab->LRoomAmount;
                  $totalPaidTests = $totalPaidTests + $rows_lab->PaidTests;
                  $totalPaidAmount = $totalPaidAmount + $rows_lab->PaidAmount;
                  $totallabtotaltests = $totallabtotaltests + $rows_lab->labtotaltests;
                  $totallabtotal = $totallabtotal + $rows_lab->labtotal;

                  $totalFreelabAmount = $rows_lab->WardAmount+$rows_lab->CasualtyAmount+$rows_lab->EntitledAmount+$rows_lab->LRoomAmount;
                    $totalPaidabAmount = $rows_lab->PaidAmount;

                  } ?>
                  <tr  class="primary" style="background: #f2dede; font-weight: bold;">
                    <td>Total</td>
                      <td><?php echo $totalWardTests ?></td>
                      <td><?php echo $totalWardAmount ?></td>
                      <td><?php echo $totalCasualtyTests ?></td>
                      <td><?php echo $totalCasualtyAmount ?></td>
                      <td><?php echo $totalEntitledTests ?></td>
                      <td><?php echo $totalEntitledAmount ?></td>
                      <td><?php echo $totalLRoomTests ?></td>
                      <td><?php echo $totalLRoomAmount ?></td>
                      <td><?php echo $totalPaidTests ?></td>
                      <td><?php echo $totalPaidAmount ?></td>
                      <td><?php echo $totallabtotaltests ?></td>
                      <td><?php echo $totallabtotal ?></td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
    <?php } ?>
      </div>
      <div class="row" style="margin-right: -5px; margin-left: -5px;">
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">All Departments Free And Paid</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th colspan="4">OPD</th>
                        <th colspan="4">OTHERS</th>
                        <th colspan="4">XRAY</th>
                        <th colspan="4">LABORATORY</th>
                        <th colspan="4">Total</th>
                    </tr> 
                    <tr class="danger">
                      <th colspan="2">Free</th>
                      <th colspan="2">Paid</th>
                      <th colspan="2">Free</th>
                      <th colspan="2">Paid</th>
                      <th colspan="2">Free</th>
                      <th colspan="2">Paid</th>
                      <th colspan="2">Free</th>
                      <th colspan="2">Paid</th>
                      <th colspan="2">Free</th>
                      <th colspan="2">Paid</th>
                  </tr> 
                  <tr class="danger">
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                      <th>Count</th>
                      <th>Amount</th>
                  </tr>
                </thead>
              <tbody>
                <?php 
                $totalopdFreeCount = $totalAged;
                $totalopdFreeAmount = $totalAged*10;
                $totalopdPaidCount = $totalPaid;
                $totalopdPaidAmount = $totalPaid*10;

                $totalotherFreeCount = $totalWardOther+$totalCasualtyOther+$totalEntitledOther+$totalLRoomOther;
                $totalotherFreeAmount = $totalWardOtherAmount+$totalCasualtyOtherAmount+$totalEntitledOtherAmount+$totalLRoomOtherAmount;
                $totalotherPaidCount = $totalPaidOther;
                $totalotherPaidAmount = $totalPaidOtherAmount;

                $totalxrayFreeCount = $TotalFreeXray;
                $totalxrayFreeAmount = $TotalFreeXrayAmount;
                $totalxrayPaidCount = $TotalPaidXray;
                $totalxrayPaidAmount = $TotalPaidXrayAmount;


                $totallabFreeCount = $totalWardTests+$totalCasualtyTests+$totalEntitledTests+$totalLRoomTests;
                $totallabFreeAmount = $totalWardAmount+$totalCasualtyAmount+$totalEntitledAmount+$totalLRoomAmount;
                $totallabPaidCount = $totalPaidTests;
                $totallabPaidAmount = $totalPaidAmount;

                $totalFreeCount = $totalopdFreeCount+$totalotherFreeCount+$totalxrayFreeCount+$totallabFreeCount;
                $totalFreeAmount = $totalopdFreeAmount+$totalotherFreeAmount+$totalxrayFreeAmount+$totallabFreeAmount;
                $totalPaidCount = $totalopdPaidCount+$totalotherPaidCount+$totalxrayPaidCount+$totallabPaidCount;
                $totalPaidAmount = $totalopdPaidAmount+$totalotherPaidAmount+$totalxrayPaidAmount+$totallabPaidAmount;

                ?>
                  <tr style="font-weight: bold; font-size: 14px;">
                    <td><?php echo $totalopdFreeCount; ?></td>
                    <td><?php echo $totalopdFreeAmount; ?></td>
                    <td><?php echo $totalopdPaidCount; ?></td>
                    <td><?php echo $totalopdPaidAmount; ?></td>
                    <td><?php echo $totalotherFreeCount; ?></td>
                    <td><?php echo $totalotherFreeAmount; ?></td>
                    <td><?php echo $totalotherPaidCount; ?></td>
                    <td><?php echo $totalotherPaidAmount; ?></td>
                    <td><?php echo $totalxrayFreeCount; ?></td>
                    <td><?php echo $totalxrayFreeAmount; ?></td>
                    <td><?php echo $totalxrayPaidCount; ?></td>
                    <td><?php echo $totalxrayPaidAmount; ?></td>
                    <td><?php echo $totallabFreeCount; ?></td>
                    <td><?php echo $totallabFreeAmount; ?></td>
                    <td><?php echo $totallabPaidCount; ?></td>
                    <td><?php echo $totallabPaidAmount; ?></td>
                    <td><?php echo $totalFreeCount; ?></td>
                    <td><?php echo $totalFreeAmount; ?></td>
                    <td><?php echo $totalPaidCount; ?></td>
                    <td><?php echo $totalPaidAmount; ?></td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
</section>
   
<!-- Datatables CDN START -->
<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url();?>assets/jQuery.print.min.js"></script>
<script src="<?php echo base_url();?>assets/js/FileSaver.min.js"></script>
<script src="<?php echo base_url();?>assets/js/tableexport.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
function ExportTable(){
                $("#tableDownload").tableExport({
                headings: true,                    // (Boolean), display table headings (th/td elements) in the <thead>
                footers: true,                     // (Boolean), display table footers (th/td elements) in the <tfoot>
                formats: ["xls", "csv", "txt"],    // (String[]), filetypes for the export
                fileName: "id",                    // (id, String), filename for the downloaded file
                bootstrap: true,                   // (Boolean), style buttons using bootstrap
                position: "well" ,                // (top, bottom), position of the caption element relative to table
                ignoreRows: null,                  // (Number, Number[]), row indices to exclude from the exported file
                ignoreCols: null,                 // (Number, Number[]), column indices to exclude from the exported file
                ignoreCSS: ".tableexport-ignore"   // (selector, selector[]), selector(s) to exclude from the exported file
            });
            }

$("#printable").find('#printcontent').on('click', function() {
$.print("#printable");
});


});
</script>