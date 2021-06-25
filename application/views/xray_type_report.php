<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<style type="text/css">
    table.dataTable tbody tr {
    min-height: 20px !important;
    font-size: 12px;
}
</style>
    <section class="content-header">
      <h1 class="text-success">
        XAY REPORT
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">XRAY REPORT</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
<?php 
$from = $to = $shift = $gander = $xray_type = "";

if($this->input->post('from')!='')
$from = $this->input->post('from');
else
$from = date('m/d/Y');

if($this->input->post('to')!='')
$to = $this->input->post('to');
else
$to = date('m/d/Y');

if($this->input->post('shift')!='')
$shift = $this->input->post('shift');

if($this->input->post('gander')!='')
$gander = $this->input->post('gander');

if($this->input->post('xray_type')!='')
$xray_type = $this->input->post('xray_type');

?>
    <form method="post" action="<?php echo base_url('XRAY_Report/xray_types') ?>">

        <div class="col-md-3">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="from" required autocomplete="off" value="<?php echo $from; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <label>To Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="to" required autocomplete="off" value="<?php echo $to; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

                <div class="col-md-2">
            <label>Shift:</label>
            <select id="shift" name="shift" class="form-control">
                <option value="" >Select Shift</option>                 
                <option value="Morning" <?php if($shift == 'Morning') {echo 'selected';} ?> id="Morning">Morning
                </option>
                <option value="Evening" <?php if($shift == 'Evening') {echo 'selected';} ?> id="Evening">Evening
                </option>
                <option value="Night" <?php if($shift == 'Night') {echo 'selected';} ?> id="Night">Night
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <label>XRAY:</label>
            <select class="form-control" id="xray_type" name="xray_type">
                <option value="">Select XRAY</option>
                <?php foreach ($xray_types as $xray_type) { ?>
                    <option value="<?php echo $xray_type->id; ?>"><?php echo $xray_type->name; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-2">
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander">
                <option value="">Select Gender</option>
                <option value="Male" <?php if($gander == 'Male') {echo 'selected';} ?>>Male
                </option>
                <option value="Female" <?php if($gander == 'Female') {echo 'selected';} ?>>Female
                </option>
            </select>
        </div>

        
        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="search" id="search" value="Advance Search" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    <section class="content" >
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">


    <div class="col-md-12">
        
    <div class="row">
    <div class="panel-body">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered">
        <thead>
            <tr style="background-color: #3c8dbc; color: #FFFFFF; font-weight: bold; text-align: center;">
                <th width="10%">Date</th>
                <th width="15%" colspan="2">Wards</th>
                <th width="15%" colspan="2">Casualty</th>
                <th width="15%" colspan="2">Labour Room</th>
                <th width="15%" colspan="2">Entitled</th>
                <th width="15%" colspan="2">Paid</th>
                <th width="15%" colspan="2">Total</th>
            
            </tr>
            <tr style="font-weight: bold; text-align: center;">
                <td></td>
                 <td>Films</td><td>Amount</td>
                 <td>Films</td><td>Amount</td>
                 <td>Films</td><td>Amount</td>
                 <td>Films</td><td>Amount</td>
                 <td>Films</td><td>Amount</td>
                 <td>Films</td><td>Amount</td>                
            </tr>
        </thead>

        <tbody>
            <?php
            $totalWardXRAY = $totalWardPrice = $totalcasualtyXRAY = $totalcasualtyPrice = $totallabourRXRAY = $totallabourRPrice = $totalEntitledXRAY = $totalEntitledPrice = $totalPaidXRAY = $totalPaidPrice = $totalXRAYCount = $totalXRAYPrice = 0;
            foreach($xray_report as $xray){ 

                $from=date_create($searchDateFrom);
                date_add($from,date_interval_create_from_date_string("+8 HOUR"));
                $from =  date_format($from,"Y-m-d H:i:s");



                $to=date_create($searchDateTo);
                date_add($to,date_interval_create_from_date_string("+32 HOUR"));
                $to = date_format($to,"Y-m-d H:i:s");


                $ward_sql = "SELECT x.price AS xray_price, COUNT(xed.entry_id) AS Count FROM `xray_entry` AS xe LEFT JOIN `xray_entry_details` AS xed ON (xe.`receptNumber`=xed.`entry_id`) LEFT JOIN `xray_type` AS x ON (xed.`xray_type_id`=x.id) WHERE xe.`type`='Ward' AND xe.`is_deleted`=0 AND xe.date>='$from' AND xe.date<'$to' AND xed.xray_type_id=".$xray->xray_id;
                $ward_query = $this->db->query($ward_sql)->result_array();

                 $casualty_sql = "SELECT x.price AS xray_price, COUNT(xed.entry_id) AS Count FROM `xray_entry` AS xe LEFT JOIN `xray_entry_details` AS xed ON (xe.`receptNumber`=xed.`entry_id`) LEFT JOIN `xray_type` AS x ON (xed.`xray_type_id`=x.id) WHERE xe.`type`='Casualty' AND xe.`is_deleted`=0 AND xe.date>='$from' AND xe.date<'$to' AND xed.xray_type_id=".$xray->xray_id;
                $casualty_query = $this->db->query($casualty_sql)->result_array();

                $labourR_sql = "SELECT x.price AS xray_price, COUNT(xed.entry_id) AS Count FROM `xray_entry` AS xe LEFT JOIN `xray_entry_details` AS xed ON (xe.`receptNumber`=xed.`entry_id`) LEFT JOIN `xray_type` AS x ON (xed.`xray_type_id`=x.id) WHERE xe.`type`='Labour_Room' AND xe.`is_deleted`=0 AND xe.date>='$from' AND xe.date<'$to' AND xed.xray_type_id=".$xray->xray_id;
                $labourR_query = $this->db->query($labourR_sql)->result_array();

                $Entitled_sql = "SELECT x.price AS xray_price, COUNT(xed.entry_id) AS Count FROM `xray_entry` AS xe LEFT JOIN `xray_entry_details` AS xed ON (xe.`receptNumber`=xed.`entry_id`) LEFT JOIN `xray_type` AS x ON (xed.`xray_type_id`=x.id) WHERE xe.`type`='Entitled' AND xe.`is_deleted`=0 AND xe.date>='$from' AND xe.date<'$to' AND xed.xray_type_id=".$xray->xray_id;
                $Entitled_query = $this->db->query($Entitled_sql)->result_array();

                $Paid_sql = "SELECT x.price AS xray_price, COUNT(xed.entry_id) AS Count FROM `xray_entry` AS xe LEFT JOIN `xray_entry_details` AS xed ON (xe.`receptNumber`=xed.`entry_id`) LEFT JOIN `xray_type` AS x ON (xed.`xray_type_id`=x.id) WHERE xe.`type`='Paid' AND xe.`is_deleted`=0 AND xe.date>='$from' AND xe.date<'$to' AND xed.xray_type_id=".$xray->xray_id;
                $Paid_query = $this->db->query($Paid_sql)->result_array();

                $totalXRAY = $ward_query[0]['Count']+$casualty_query[0]['Count']+$labourR_query[0]['Count']+$Entitled_query[0]['Count']+$Paid_query[0]['Count'];

                $totalWardXRAY += $ward_query[0]['Count'];
                $totalWardPrice += $ward_query[0]['Count']*$ward_query[0]['xray_price'];
                $totalcasualtyXRAY += $casualty_query[0]['Count'];
                $totalcasualtyPrice += $casualty_query[0]['Count']*$casualty_query[0]['xray_price'];
                $totallabourRXRAY += $labourR_query[0]['Count'];
                $totallabourRPrice += $labourR_query[0]['Count']*$labourR_query[0]['xray_price'];
                $totalEntitledXRAY += $Entitled_query[0]['Count'];
                $totalEntitledPrice += $Entitled_query[0]['Count']*$Entitled_query[0]['xray_price'];
                $totalPaidXRAY += $Paid_query[0]['Count'];
                $totalPaidPrice += $Paid_query[0]['Count']*$Paid_query[0]['xray_price'];
                $totalXRAYCount  += $totalXRAY;
                $totalXRAYPrice  += $totalXRAY*$Paid_query[0]['xray_price'];

            ?>
             
            <tr style="font-weight: bold; text-align: center;">
                 <td>Date</td>
                 <td><?php echo $ward_query[0]['Count']; ?></td>
                 <td><?php echo $ward_query[0]['Count']*$ward_query[0]['xray_price']; ?></td>
                 <td><?php echo $casualty_query[0]['Count']; ?></td>
                 <td><?php echo $casualty_query[0]['Count']*$casualty_query[0]['xray_price']; ?></td>
                 <td><?php echo $labourR_query[0]['Count']; ?></td>
                 <td><?php echo $labourR_query[0]['Count']*$labourR_query[0]['xray_price']; ?></td>
                 <td><?php echo $Entitled_query[0]['Count']; ?></td>
                 <td><?php echo $Entitled_query[0]['Count']*$Entitled_query[0]['xray_price']; ?></td>
                  <td><?php echo $Paid_query[0]['Count']; ?></td>
                 <td><?php echo $Paid_query[0]['Count']*$Paid_query[0]['xray_price']; ?></td>
                 <td><?php echo $totalXRAY; ?></td>
                 <td><?php echo $totalXRAY*$Paid_query[0]['xray_price']; ?></td>               
            </tr>
            <?php  }  ?>

        </tbody>
        <tfoot>
            <tr style="background-color: green; color: #FFFFFF; font-weight: bold; text-align: center;">
                 <td>Total</td>
                 <td><?php echo $totalWardXRAY; ?></td>
                 <td><?php echo $totalWardPrice; ?></td>
                 <td><?php echo $totalcasualtyXRAY; ?></td>
                 <td><?php echo $totalcasualtyPrice; ?></td>
                 <td><?php echo $totallabourRXRAY; ?></td>
                 <td><?php echo $totallabourRPrice; ?></td>
                 <td><?php echo $totalEntitledXRAY; ?></td>
                 <td><?php echo $totalEntitledPrice; ?></td>
                  <td><?php echo $totalPaidXRAY; ?></td>
                 <td><?php echo $totalPaidPrice; ?></td>
                 <td><?php echo $totalXRAYCount; ?></td>
                 <td><?php echo $totalXRAYPrice; ?></td>               
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

    <script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

    <script type="text/javascript">
     

        $(document).ready(function() {
        $('#example1').DataTable( {
        paging:   false,
        ordering: false,
        info:     false,
        dom: 'Bfrtip',
        buttons: [
        {
                    extend: 'pdf',
                    text: 'PDF'
                },
                {
                    extend: 'copy',
                    text: 'Copy'
                },
                {
                    extend: 'csv',
                    text: 'CSV'
                },
                {
                    extend: 'excel',
                    text: 'Excel'
                },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                modifier: {
                    selected: null
                    }
                }
            },
            {
                extend: 'print',
                text: 'Print selected'
            }
            ],
                scrollY:        "600px",
                scrollX:        true,
                scrollCollapse: true,
                paging:         false,
                fixedColumns:   {
                    heightMatch: 'none'
                },
            select: true
        } );


        $('#sync').on('click',function(e){
                e.preventDefault();
                $.ajax({
                url:'<?php echo base_url('login/syncAllOpdData') ?>',
                method:'POST',
                beforeSend:function(){
                $('#loading').css('display','block');
            },
                success:function(message)
                {
                $('#loading').css('display','none');
                location.reload();
                }
                })  
            })

       
    } );
    </script>