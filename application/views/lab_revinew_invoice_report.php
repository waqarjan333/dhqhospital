<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<?php 

if($this->input->post('date')!='')
$date = $this->input->post('date');
else
$date = date('m/d/Y');

if($this->input->post('dept_id')!='')
$dept_id = $this->input->post('dept_id');
else
$dept_id = '';

if($this->input->post('shift')!='')
$shift = $this->input->post('shift');
else
$shift = '';

?>
    <section class="content-header">
      <h1 class="text-success">
        LAB Revinew Invoice Print
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Search Records</li>
      </ol>
    </section>
    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
    <form method="post" action="<?php echo base_url('LAB_Report/revinew_invoice') ?>">

        <div class="col-md-4">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="date" value="<?php echo $date; ?>" required>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <label>Shift:</label>
            <select id="shift" name="shift" class="form-control" required>  
            <option value=''>--Select Shift--</option>            
                <option value="Morning" id="Morning" <?php if('Morning'== $shift){?>selected <?php } ?>>Morning</option>
                <option value="Evening" id="Evening" <?php if('Evening' == $shift){?>selected <?php } ?>>Evening</option>
                <option value="Night" id="Night" <?php if('Night' == $shift){?>selected <?php } ?>>Night</option>
            </select>
            <br />
        </div>


        <div class="col-md-4">
            <label>Department:</label>
            <select class="form-control" name="dept_id" id="dept_id" required>
              <option value=''>--Select Department--</option>
                <?php
                    foreach ($getDept as $key) 
                    {?>
                    <option value="<?php echo $key->id; ?>" <?php if($key->id == $dept_id){?>selected <?php } ?>><?php echo $key->dep_name; ?></option>
                <?php } ?>
            </select>
        </div>        

        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="search" id="search" value="Search" class="btn btn-success"  />
        </div>        
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;margin: 0 auto; padding: 0px 0px 20px 20px;">
    <div class="col-md-12">
    <?php if(count($result_array) > 0){ ?>
      <div class="row">
    <div class="panel-body">
        <div class="row invoice-info">
        <div class="col-sm-6 invoice-col" style="width: auto;">
          <div class="col-sm-6">
              <b>User</b>
          </div>
          <div class="col-sm-6">
              <?php echo $this->session->userdata('full_name');?>
          </div>

          <div class="col-sm-6">
              <b>Shift</b>
          </div>
          <div class="col-sm-6">
              <?php echo $shift; ?>&nbsp
          </div>

          <div class="col-sm-6">
              <b>Date</b>
          </div>
          <div class="col-sm-6">
              <?php echo $date; ?>
          </div>

          <div class="col-sm-6">
              <b>Department</b>
          </div>
          <div class="col-sm-6">
              <?php echo $dept_name; ?>
          </div>

        </div>
      </div>

    </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table"> 
              <tr>
                <td style="width: 25%;">Serial </td>
                <td style="width: 25%;"><?php echo $result_array[0]->SerialStartFrom ?><small style="font-size: 10px;">(From)</small></td>
                <td style="width: 25%;"><?php echo $result_array[0]->SerialEndTo ?><small style="font-size: 10px;">(To)</small></td>
                <td style="width: 25%;"><?php echo $result_array[0]->SerialEndTo-$result_array[0]->SerialStartFrom+1; ?><small style="font-size: 10px;">(Total Receipts)</small></td>
              </tr>
              <tr>
                <td>Total:</td>
                <td><?php echo $result_array[0]->TotalReceipts ?><small style="font-size: 10px;">(Reciepts)</small></td>
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
              
              
            </table>
          </div>
        </div>
      </div>
    <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url('LAB_Report/lab_revinew_invoice_print_report/'.date('Y-m-d',strtotime($date)).'/'.$dept_id.'/'.$shift) ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          
        </div>
      </div>
  <?php }else{ ?>
<div class="row"> No Record Found</div>

<?php  } ?>
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

        $(document).ready(function() {
        $('#example1').DataTable( {
            paging:   false,
            ordering: false,
            info:     false,
            dom: 'Bfrtip',
            buttons: [
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
            });
   
    });
    </script>