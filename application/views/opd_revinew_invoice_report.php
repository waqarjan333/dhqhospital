<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
    <section class="content-header">
      <h1 class="text-success">
        OPD Department Revinew Invoice Report
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
<?php 
$date = $to = $dept = $shift = '';

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
    <form method="post" action="<?php echo base_url('OPD_Report/revinew_invoice') ?>">
        <div class="col-md-3">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="date"  value="<?php echo $date; ?>" required>
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label>Department:</label>
            <select class="form-control" name="dept_id" id="dept_id" required>
              <option value="">Select Department</option>
                <?php
                    foreach ($getDept as $key) 
                    {?>
                    <option value="<?php echo $key->id; ?>" <?php if($key->id == $dept_id){?>selected <?php } ?>><?php echo $key->dep_name; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>        
        <div class="col-md-3">
            <label>Shift:</label>
            <select id="shift" name="shift" class="form-control" required>
                <option value="" >Select Shift</option>                 
                <option value="Morning" <?php if($shift == 'Morning') {echo 'selected';} ?> id="Morning">Morning
                </option>
                <option value="Evening" <?php if($shift == 'Evening') {echo 'selected';} ?> id="Evening">Evening
                </option>
                <option value="Night" <?php if($shift == 'Night') {echo 'selected';} ?> id="Night">Night
                </option>
            </select>
            <br />
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
              <?php echo $dept_name;?>
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
                <th>Serial Start From:</th>
                <td><?php echo $result_array[0]->serialStart ?></td>
              </tr>
              <tr>
                <th>Serial End To</th>
                <td><?php echo $result_array[0]->serialEnd ?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo $result_array[0]->Total ?></td>
              </tr>
              <tr>
                <th>OPD:</th>
                <td><?php echo $result_array[0]->OPD ?></td>
              </tr>
              <tr>
                <th>Aged:</th>
                <td><?php echo $result_array[0]->Aged ?></td>
              </tr>
              <tr>
                <th>Amount Paid:</th>
                <td><?php echo ($dept_price*$result_array[0]->OPD); ?>/=</td>
              </tr> 
            </table>
          </div>
        </div>
      </div>
    <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url('OPD_Report/opd_revinew_invoice_print_report/'.date('Y-m-d',strtotime($date)).'/'.$dept_id.'/'.$shift) ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
  <?php }else{ ?>
<div class="row">No Record Found</div>
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
    })
});
</script>