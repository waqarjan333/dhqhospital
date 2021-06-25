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
        LAB TESTS REPORT
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">LAB TESTS REPORT</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
<?php 
$from = $to = $shift = $gander = $test = "";

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

if($this->input->post('test')!='')
$test = $this->input->post('test');

?>
    <form method="post" action="<?php echo base_url('LAB_Report/lab_test_types') ?>">

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
            <label>Tests:</label>
            <select class="form-control" id="test" name="test">
                <option value="">Select test</option>
                <?php foreach ($tests as $test) { ?>
                    <option value="<?php echo $test->id; ?>"><?php echo $test->name; ?></option>
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
                <th width="20%">Test Name</th>
                <th width="10%" colspan="2">Wards</th>
                <th width="15%" colspan="2">Casualty</th>
                <th width="15%" colspan="2">Labour Room</th>
                <th width="15%" colspan="2">Entitled</th>
                <th width="15%" colspan="2">Paid</th>
                <th width="10%" colspan="2">Total</th>
            
            </tr>
            <tr style="font-weight: bold; text-align: center;">
              
                <td></td>
                 <td>Test</td><td>Amount</td>
                 <td>Test</td><td>Amount</td>
                 <td>Test</td><td>Amount</td>
                 <td>Test</td><td>Amount</td>
                 <td>Test</td><td>Amount</td>
                 <td>Test</td><td>Amount</td>                
            </tr>
        </thead>

        <tbody>
            <?php
            $totalWardTest = $totalWardPrice = $totalcasualtyTest = $totalcasualtyPrice = $totallabourRTest = $totallabourRPrice = $totalEntitledTest = $totalEntitledPrice = $totalPaidTest = $totalPaidPrice = $totalTestCount = $totalTestPrice = 0;
            foreach($test_report as $test){ 

                $from=date_create($searchDateFrom);
                date_add($from,date_interval_create_from_date_string("+8 HOUR"));
                $from =  date_format($from,"Y-m-d H:i:s");



                $to=date_create($searchDateTo);
                date_add($to,date_interval_create_from_date_string("+32 HOUR"));
                $to = date_format($to,"Y-m-d H:i:s");


                $ward_sql = "SELECT t.price AS test_price, COUNT(led.entry_id) AS Count FROM `lab_entry` AS le LEFT JOIN `lab_entry_details` AS led ON (le.`receptNumber`=led.`entry_id`) LEFT JOIN `tests` AS t ON (led.`test_id`=t.id) WHERE `type`='Ward' AND le.`is_deleted`=0 AND le.date>='$from' AND le.date<'$to' AND led.test_id=".$test->test_id;
                $ward_query = $this->db->query($ward_sql)->result_array();

                 $casualty_sql = "SELECT t.price AS test_price, COUNT(led.entry_id) AS Count FROM `lab_entry` AS le LEFT JOIN `lab_entry_details` AS led ON (le.`receptNumber`=led.`entry_id`) LEFT JOIN `tests` AS t ON (led.`test_id`=t.id) WHERE `type`='Casualty' AND le.`is_deleted`=0 AND le.date>='$from' AND le.date<'$to' AND led.test_id=".$test->test_id;
                $casualty_query = $this->db->query($casualty_sql)->result_array();

                $labourR_sql = "SELECT t.price AS test_price, COUNT(led.entry_id) AS Count FROM `lab_entry` AS le LEFT JOIN `lab_entry_details` AS led ON (le.`receptNumber`=led.`entry_id`) LEFT JOIN `tests` AS t ON (led.`test_id`=t.id) WHERE `type`='Labour_Room'  AND le.`is_deleted`=0 AND le.date>='$from' AND le.date<'$to' AND led.test_id=".$test->test_id;
                $labourR_query = $this->db->query($labourR_sql)->result_array();

                $Entitled_sql = "SELECT t.price AS test_price, COUNT(led.entry_id) AS Count FROM `lab_entry` AS le LEFT JOIN `lab_entry_details` AS led ON (le.`receptNumber`=led.`entry_id`) LEFT JOIN `tests` AS t ON (led.`test_id`=t.id) WHERE `type`='Entitled' AND le.`is_deleted`=0 AND le.date>='$from' AND le.date<'$to' AND led.test_id=".$test->test_id;
                $Entitled_query = $this->db->query($Entitled_sql)->result_array();

                $Paid_sql = "SELECT t.price AS test_price, COUNT(led.entry_id) AS Count FROM `lab_entry` AS le LEFT JOIN `lab_entry_details` AS led ON (le.`receptNumber`=led.`entry_id`) LEFT JOIN `tests` AS t ON (led.`test_id`=t.id) WHERE `type`='Paid' AND le.`is_deleted`=0 AND le.date>='$from' AND le.date<'$to' AND led.test_id=".$test->test_id;
                $Paid_query = $this->db->query($Paid_sql)->result_array();

                $totalTest = $ward_query[0]['Count']+$casualty_query[0]['Count']+$labourR_query[0]['Count']+$Entitled_query[0]['Count']+$Paid_query[0]['Count'];

                $totalWardTest += $ward_query[0]['Count'];
                $totalWardPrice += $ward_query[0]['Count']*$ward_query[0]['test_price'];
                $totalcasualtyTest += $casualty_query[0]['Count'];
                $totalcasualtyPrice += $casualty_query[0]['Count']*$casualty_query[0]['test_price'];
                $totallabourRTest += $labourR_query[0]['Count'];
                $totallabourRPrice += $labourR_query[0]['Count']*$labourR_query[0]['test_price'];
                $totalEntitledTest += $Entitled_query[0]['Count'];
                $totalEntitledPrice += $Entitled_query[0]['Count']*$Entitled_query[0]['test_price'];
                $totalPaidTest += $Paid_query[0]['Count'];
                $totalPaidPrice += $Paid_query[0]['Count']*$Paid_query[0]['test_price'];
                $totalTestCount  += $totalTest;
                $totalTestPrice  += $totalTest*$Paid_query[0]['test_price'];

            ?>
             
            <tr style="font-weight: bold; text-align: center;">
                 <td><?php echo $test->test_name; ?></td>
                 <td><?php echo $ward_query[0]['Count']; ?></td>
                 <td><?php echo $ward_query[0]['Count']*$ward_query[0]['test_price']; ?></td>
                 <td><?php echo $casualty_query[0]['Count']; ?></td>
                 <td><?php echo $casualty_query[0]['Count']*$casualty_query[0]['test_price']; ?></td>
                 <td><?php echo $labourR_query[0]['Count']; ?></td>
                 <td><?php echo $labourR_query[0]['Count']*$labourR_query[0]['test_price']; ?></td>
                 <td><?php echo $Entitled_query[0]['Count']; ?></td>
                 <td><?php echo $Entitled_query[0]['Count']*$Entitled_query[0]['test_price']; ?></td>
                  <td><?php echo $Paid_query[0]['Count']; ?></td>
                 <td><?php echo $Paid_query[0]['Count']*$Paid_query[0]['test_price']; ?></td>
                 <td><?php echo $totalTest; ?></td>
                 <td><?php echo $totalTest*$Paid_query[0]['test_price']; ?></td>               
            </tr>
            <?php  }  ?>
            <tr style="background-color: green; color: #FFFFFF; font-weight: bold; text-align: center;">
              
                <td>Total</td>
                 <td><?php echo $totalWardTest; ?></td>
                 <td><?php echo $totalWardPrice; ?></td>
                 <td><?php echo $totalcasualtyTest; ?></td>
                 <td><?php echo $totalcasualtyPrice; ?></td>
                 <td><?php echo $totallabourRTest; ?></td>
                 <td><?php echo $totallabourRPrice; ?></td>
                 <td><?php echo $totalEntitledTest; ?></td>
                 <td><?php echo $totalEntitledPrice; ?></td>
                  <td><?php echo $totalPaidTest; ?></td>
                 <td><?php echo $totalPaidPrice; ?></td>
                 <td><?php echo $totalTestCount; ?></td>
                 <td><?php echo $totalTestPrice; ?></td>               
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
     <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content" >
               <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LAB Invoice</h4>
              </div>
              <div class="modal-body invoice" id="entry_modal">
    <!-- /.content -->
    <div class="clearfix"></div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> 
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

   
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
     //    $(function () {
        // $('#example1').DataTable({
        //   'paging'      : true,
        //   'lengthChange': true,
        //   'searching'   : true,
        //   'ordering'    : true,
        //   'info'        : true,
        //   'autoWidth'   : false,
        //   'stateSave'   : true
        // })
        // });
        $(document).on("click",".lab-invoice",function(){

  var entryid=$(this).data('entryid');

  $.ajax({
    method:"post",
    url:'<?php echo base_url('LAB_Report/get_invoice') ?>',
    data:{entryid:entryid},
    beforeSend:function(){
        $('#loading').css('display','block');
    },
    success:function(data){
      $('#entry_modal').html(data);
      $('#loading').css('display','none');
      /*var url_for_login=full_path+"admin/user-login-from-admin/"+data.token_for_admin_login+'/'+data.user_id;
      $("#login_url").val(url_for_login);*/
      $("#modal-default").modal("show");
    // alert(data);
    },error: function(response) {
            console.log(response);
        }
  });
});

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
                scrollY:        "300px",
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