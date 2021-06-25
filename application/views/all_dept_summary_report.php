<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/tableexport.min.css">
<style type="text/css">
    table {
        font-size: 12px;
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
    
    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
<?php 
error_reporting(0);
$from = $to = $type = '';

if($this->input->post('from')!='')
$from = $this->input->post('from');
else
$from = date('m/d/Y');

if($this->input->post('to')!='')
$to = $this->input->post('to');
else
$to = date('m/d/Y');

if($this->input->post('type')!='')
$type = $this->input->post('type');
?>
    <form method="post" action="<?php echo base_url('/All_report/all_dept_summary') ?>">
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
        <div class="col-md-3">
            <label>Type</label>
            <select class="form-control" id="type" name="type" required="required">
                <option value="All" <?php if($type == 'All') {echo 'selected';} ?>>Paid and Free</option>
                <option value="Paid" <?php if($type == 'Paid') {echo 'selected';} ?>>Paid</option>
                <option value="Free" <?php if($type == 'Free') {echo 'selected';} ?>>Free</option>
            </select>
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
    <div class="row">
        <?php 
         $totalMale = $totalFemale = $totaltotal = 0;
         $otherCount = $otherAmount = 0;
         $AllXray = $AllXrayAmount = 0;
         $AllLab = $AllLabAmount = 0;
        if(count($opddata) > 0){ 
        ?>
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Departments Of OPD</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
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
                    </tr> 
                </thead>
              <tbody>
                <?php
                
                foreach ($opddata as $row) { 
$opd_query = $this->db->query("SELECT dep_name, dept_price FROM departments WHERE id=".$row->dept_id)->result_array();
                    ?>
                  <tr>
                      <td class="primary"><?php echo $opd_query[0]['dep_name']; ?></td>
                      <td><?php echo $row->Male ?></td>
                      <td><?php echo $row->Male*$opd_query[0]['dept_price']; ?></td>
                      <td><?php echo $row->Female ?></td>
                      <td><?php echo $row->Female*$opd_query[0]['dept_price']; ?></td>
                      <td><?php echo $row->total ?></td>
                      <td><?php echo $row->total*$opd_query[0]['dept_price']; ?></td>
                  </tr>
                  <?php  
                    $totalMale = $totalMale + $row->Male;
                    $totalFemale = $totalFemale + $row->Female;
                    $totaltotal = $totaltotal + $row->total;
                    } ?>
                  
              </tbody>
              <tfoot>
                  <tr class="danger">
                      <th>Total</th>
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
        <div class="row">
        <?php if(count($otherdata) > 0){ ?>
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Other Departments</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
                        <th colspan="2"><?php echo $type; ?></th>
                    </tr> 
                    <tr class="danger">
                      <th></th>
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
                      <td><?php echo $rows_other->Count ?></td>
                      <td><?php echo $rows_other->OtherAmount ?></td>
                  </tr>
                  <?php  
                    $otherCount = $otherCount + $rows_other->Count;
                    $otherAmount = $otherAmount + $rows_other->OtherAmount;
                  } ?>
                  
              </tbody>
              <tfoot>
                  <tr class="danger">
                      <th>Total</th>
                      <th><?php echo $otherCount ?></th>
                      <th><?php echo $otherAmount ?></th>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>
    <?php } ?>
      </div>
        <div class="row">
        <?php if(count($xraydata) > 0){ ?>
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Department Of XRAY</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
                        <th colspan="2"><?php echo $type; ?></th>
                    </tr> 
                    <tr class="danger">
                      <th></th>
                      <th>Films</th>
                      <th>Amount</th>
                  </tr>
                </thead>
              <tbody>
                  
                <?php 
                

                foreach ($xraydata as $rows_xray) { 
                $xray_query = $this->db->query("SELECT dep_name FROM departments WHERE id=".$rows_xray->dept_id)->result_array();
                $AllXray = $rows_xray->xrayCount;
                $AllXrayAmount =  $rows_xray->XrayAmount;
                ?>
                  <tr>
                      <td class="primary"><?php echo $xray_query[0]['dep_name']; ?></td>
                      <td><?php echo $AllXray ?></td>
                      <td><?php echo $AllXrayAmount ?></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
    <?php } ?>
      </div>

      <div class="row">
        <?php if(count($labdata) > 0){ ?>
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Departments Of Laboratory</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
                        <th colspan="2"><?php echo $type; ?></th>
                    </tr> 
                    <tr class="danger">
                      <th></th>
                      <th>Count</th>
                      <th>Amount</th>
                  </tr> 
                </thead>
              <tbody>
                  
                <?php 
                $AllLabAmount = $totalTestsAmount = 0;
                foreach ($labdata as $rows_lab) { 
                    $AllLab = $rows_lab->labCount;
                    $AllLabAmount = $rows_lab->labAmount;

            $lab_query = $this->db->query("SELECT dep_name FROM departments WHERE id=".$rows_lab->dept_id)->result_array();
                    ?>
                  <tr>
                      <td class="primary"><?php echo $lab_query[0]['dep_name']; ?></td>
                      <td><?php echo $AllLab ?></td>
                      <td><?php echo $AllLabAmount ?></td>
                  </tr>
                  <?php 
                    $totalTests = $totalTests + $AllLab;
                    $totalTestsAmount = $totalTestsAmount + $AllLabAmount;
                   } 
                   ?>
                  <tr style="background: #f2dede;">
                    <td>Total</td>
                    <td style="font-weight: bold;"><?php echo $totalTests ?></td>
                    <td style="font-weight: bold;"><?php echo $totalTestsAmount ?></td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
    <?php } ?>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">All Departments Free And Paid</p>
            <table class="table table-bordered"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th colspan="2">OPD</th>
                        <th colspan="2">OTHERS</th>
                        <th colspan="2">XRAY</th>
                        <th colspan="2">LABORATORY</th>
                        <th colspan="2">Total</th>
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
                  </tr> 
                </thead>
              <tbody>
                
                  <tr style="font-weight: bold; font-size: 14px;">
                    <td><?php echo $totaltotal; ?></td>
                    <td><?php echo $totaltotal*10; ?></td>
                    <td><?php echo $otherCount; ?></td>
                    <td><?php echo $otherAmount; ?></td>
                    <td><?php echo $AllXray; ?></td>
                    <td><?php echo $AllXrayAmount; ?></td>
                    <td><?php echo $totalTests; ?></td>
                    <td><?php echo $totalTestsAmount; ?></td>
                    <td><?php echo $totaltotal+$otherCount+$AllXray+$totalTests; ?></td>
                    <td><?php echo ($totaltotal*10)+$otherAmount+$AllXrayAmount+$totalTestsAmount; ?></td>
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