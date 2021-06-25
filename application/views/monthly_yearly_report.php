<?php error_reporting(0) ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/tableexport.min.css">
<style type="text/css">
table.table-bordered > thead > tr > th{
    border:1px solid #000000;
}
table.table-bordered > tbody > tr > td{
   border:1px solid #F2DEDE;
}
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
  .table-responsive {
    position: relative;
    overflow:visible!important; /* Hide scrollbars */
    font-size: 14px !important;
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
$year = $type = '';
if($this->input->post('year')!='')
$year = $this->input->post('year');
else
$year = '2021';

if($this->input->post('type')!='')
$type = $this->input->post('type');
else
$type = 'All';
?>
    <form method="post" action="<?php echo base_url('/All_report/monthly_yearly_report') ?>">
        <div class="col-md-3">
            <label>Year</label>
            <select class="form-control" id="year" name="year" required="required">
                <option value="2019" <?php if($year == '2019') {echo 'selected';} ?>>2019</option>
                <option value="2020" <?php if($year == '2020') {echo 'selected';} ?>>2020</option>
                <option value="2021" <?php if($year == '2021') {echo 'selected';} ?>>2021</option>
            </select>
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
   
    </table>
    <colgroup><col width="20%"><col width="35%"><col width="40%"></colgroup>
    <div class="row">
        <div class="col-xs-12">
          <div class="table-responsive">
            <p style="font-size: 16px; color: #3C8DBC; font-weight: bold;">Record Of <?php echo $year; ?> ( <?php echo $type; ?> )</p>
            <table class="table table-bordered" style="border:1px solid #F2DEDE;"> 
                <thead class="thead-dark">
                    <tr class="danger">
                        <th>Department</th>
                        <th>Junuary</th>
                        <th>Febuary</th>
                        <th>March</th>
                        <th>Aprail</th>
                        <th>May</th>
                        <th>June</th>
                        <th>July</th>
                        <th>August</th>
                        <th>September</th>
                        <th>October</th>
                        <th>November</th>
                        <th>December</th>
                        <th>Total</th>
                    </tr>  
                </thead>
              <tbody>
                <?php 

                $yearly_no = substr($year, 2);
                $jun_total = $feb_total = $march_total = $april_total = $may_total = $june_total = $july_total = $august_total = $sep_total = $oct_total = $nov_total = $dec_total = $dept_total  = $all_total = $type_sql ="";
                if(count($dept) > 0){  
                  foreach ($dept as $row) { 
                    $table = $type_sql = "";

                    if ($type=='All' && $row->view=='OPD'){
                      $type_sql = 'SUM(price) AS Amount';
                      $table = 'opd_entry';
                    } elseif ($type=='Paid' && $row->view=='OPD'){
                      $type_sql = "SUM(if(type = 'OPD',price,0)) AS Amount";
                      $table = 'opd_entry';
                    }  elseif ($type=='Free' && $row->view=='OPD'){
                      $type_sql = "SUM(if(type = 'Aged',price,0)) AS Amount";
                      $table = 'opd_entry';
                    }  elseif ($type=='All' && $row->view=='OTHER'){
                      $type_sql = 'SUM(price) AS Amount';
                      $table = 'other_entry';
                    }  elseif ($type=='Paid' && $row->view=='OTHER'){
                      $type_sql = "SUM(if(type = 'Paid',price,0)) AS Amount";
                      $table = 'other_entry';
                    }  elseif ($type=='Free' && $row->view=='OTHER'){
                      $type_sql = "SUM(if(type != 'Paid',price,0)) AS Amount";
                      $table = 'other_entry';
                    }  elseif ($type=='All' && $row->view=='XRAY'){
                      $type_sql = 'SUM(price) AS Amount';
                      $table = 'xray_entry';
                    }  elseif ($type=='Paid' && $row->view=='XRAY'){
                      $type_sql = "SUM(if(type = 'Paid',price,0)) AS Amount";
                      $table = 'xray_entry';
                    }  elseif ($type=='Free' && $row->view=='XRAY'){
                      $type_sql = "SUM(if(type != 'Paid',price,0)) AS Amount";
                      $table = 'xray_entry';
                    }  elseif ($type=='All' && $row->view=='LAB'){
                      $type_sql = 'SUM(price) AS Amount';
                      $table = 'lab_entry';
                    }  elseif ($type=='Paid' && $row->view=='LAB'){
                      $type_sql = "SUM(if(type = 'Paid',price,0)) AS Amount";
                      $table = 'lab_entry';
                    }  elseif ($type=='Free' && $row->view=='LAB'){
                      $type_sql = "SUM(if(type != 'Paid',price,0)) AS Amount";
                      $table = 'lab_entry';
                    }


                    $junStartDate = $year.'-01-01 08:00:00';
                    $junEndDate = $year.'-02-01 08:00:00';
                    $junuary_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$junStartDate' AND date<'$junEndDate' AND dept_id=".$row->id;
                    $junuary_query = $this->db->query($junuary_sql)->result_array();
                 
                    $FebStartDate = $year.'-02-01 08:00:00';
                    $FebEndDate = $year.'-03-01 08:00:00';
                 $feb_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$FebStartDate' AND date<'$FebEndDate' AND dept_id=".$row->id;
                 $feb_query = $this->db->query($feb_sql)->result_array();

                    $MarStartDate = $year.'-03-01 08:00:00';
                    $MarEndDate = $year.'-04-01 08:00:00';
                 $march_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$MarStartDate' AND date<'$MarEndDate' AND dept_id=".$row->id;
                 $march_query = $this->db->query($march_sql)->result_array();

                    $AprStartDate = $year.'-04-01 08:00:00';
                    $AprEndDate = $year.'-05-01 08:00:00';
                 $april_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$AprStartDate' AND date<'$AprEndDate' AND dept_id=".$row->id;
                 $april_query = $this->db->query($april_sql)->result_array();

                    $MayStartDate = $year.'-05-01 08:00:00';
                    $MayEndDate = $year.'-06-01 08:00:00';
                 $may_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$MayStartDate' AND date<'$MayEndDate' AND dept_id=".$row->id;
                 $may_query = $this->db->query($may_sql)->result_array();

                    $JuneStartDate = $year.'-06-01 08:00:00';
                    $JuneEndDate = $year.'-07-01 08:00:00';
                 $june_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$JuneStartDate' AND date<'$JuneEndDate' AND dept_id=".$row->id;
                 $june_query = $this->db->query($june_sql)->result_array();

                    $JulyStartDate = $year.'-07-01 08:00:00';
                    $JulyEndDate = $year.'-08-01 08:00:00';
                 $july_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$JulyStartDate' AND date<'$JulyEndDate' AND dept_id=".$row->id;
                 $july_query = $this->db->query($july_sql)->result_array();

                    $AugStartDate = $year.'-08-01 08:00:00';
                    $AugEndDate = $year.'-09-01 08:00:00';
                 $august_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$AugStartDate' AND date<'$AugEndDate' AND dept_id=".$row->id;
                 $august_query = $this->db->query($august_sql)->result_array();


                    $SepStartDate = $year.'-09-01 08:00:00';
                    $SepEndDate = $year.'-10-01 08:00:00';
                 $sep_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$SepStartDate' AND date<'$SepEndDate' AND dept_id=".$row->id;
                 $sep_query = $this->db->query($sep_sql)->result_array();

                    $OctStartDate = $year.'-10-01 08:00:00';
                    $OctEndDate = $year.'-11-01 08:00:00';
                 $oct_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$OctStartDate' AND date<'$OctEndDate' AND dept_id=".$row->id;
                 $oct_query = $this->db->query($oct_sql)->result_array();


                    $NovStartDate = $year.'-11-01 08:00:00';
                    $NovEndDate = $year.'-12-01 08:00:00';
                 $nov_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$NovStartDate' AND date<'$NovEndDate' AND dept_id=".$row->id;
                 $nov_query = $this->db->query($nov_sql)->result_array();

                    $yearOne = $year+1;
                    $DecStartDate = $year.'-12-01 08:00:00';
                    $DecEndDate = $yearOne.'-01-01 08:00:00';
                 $dec_sql = "SELECT ".$type_sql." FROM ".$table." WHERE `is_deleted`=0 AND yearly_no='$yearly_no' AND date>='$DecStartDate' AND date<'$DecEndDate' AND dept_id=".$row->id;
                 $dec_query = $this->db->query($dec_sql)->result_array();

                 $dept_total = $junuary_query[0]['Amount']+$feb_query[0]['Amount']+$march_query[0]['Amount']+$april_query[0]['Amount']+$may_query[0]['Amount']+$june_query[0]['Amount']+$july_query[0]['Amount']+$august_query[0]['Amount']+$sep_query[0]['Amount']+$oct_query[0]['Amount']+$nov_query[0]['Amount']+$dec_query[0]['Amount'];
                  ?>
                  <tr>
                      <td class="danger"><?php echo $row->dep_name; ?></td>
                      <td><?php echo $junuary_query[0]['Amount']; ?></td>
                      <td><?php echo $feb_query[0]['Amount']; ?></td>
                      <td><?php echo $march_query[0]['Amount']; ?></td>
                      <td><?php echo $april_query[0]['Amount']; ?></td>
                      <td><?php echo $may_query[0]['Amount']; ?></td>
                      <td><?php echo $june_query[0]['Amount']; ?></td>
                      <td><?php echo $july_query[0]['Amount']; ?></td>
                      <td><?php echo $august_query[0]['Amount']; ?></td>
                      <td><?php echo $sep_query[0]['Amount']; ?></td>
                      <td><?php echo $oct_query[0]['Amount']; ?></td>
                      <td><?php echo $nov_query[0]['Amount']; ?></td>
                      <td><?php echo $dec_query[0]['Amount']; ?></td>
                      <td style="font-size: 16px; font-weight: bold;"><?php echo $dept_total; ?></td>
                  </tr>
                <?php 
                  $jun_total = $jun_total + $junuary_query[0]['Amount'];
                  $feb_total = $feb_total + $feb_query[0]['Amount'];
                  $march_total = $march_total + $march_query[0]['Amount'];
                  $april_total = $april_total + $april_query[0]['Amount'];
                  $may_total = $may_total + $may_query[0]['Amount'];
                  $june_total = $june_total + $june_query[0]['Amount'];
                  $july_total = $july_total + $july_query[0]['Amount'];
                  $august_total = $august_total + $august_query[0]['Amount'];
                  $sep_total = $sep_total + $sep_query[0]['Amount'];
                  $oct_total = $oct_total + $oct_query[0]['Amount'];
                  $nov_total = $nov_total + $nov_query[0]['Amount'];
                  $dec_total = $dec_total + $dec_query[0]['Amount'];
                 } } 
                 $all_total = $jun_total + $feb_total + $march_total + $april_total + $may_total + $june_total + $july_total + $august_total + $sep_total + $oct_total + $nov_total + $dec_total;
                 ?>
                </tbody>
                <tfoot>
                  <tr class="danger" style="font-size: 16px; font-weight: bold;">
                    <td>Total</td>
                      <td><?php echo $jun_total; ?></td>
                      <td><?php echo $feb_total; ?></td>
                      <td><?php echo $march_total; ?></td>
                      <td><?php echo $april_total; ?></td>
                      <td><?php echo $may_total; ?></td>
                      <td><?php echo $june_total; ?></td>
                      <td><?php echo $july_total; ?></td>
                      <td><?php echo $august_total; ?></td>
                      <td><?php echo $sep_total; ?></td>
                      <td><?php echo $oct_total; ?></td>
                      <td><?php echo $nov_total; ?></td>
                      <td><?php echo $dec_total; ?></td>
                      <td><?php echo $all_total; ?></td>
                  </tr>
                </tfoot>
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