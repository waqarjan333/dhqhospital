<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<style type="text/css">
    table.dataTable tbody tr {
    min-height: 20px !important;
    font-size: 12px;
}
</style>
    <section class="content-header">
      <h1 class="text-success">
        Search Records
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
$shift = $gander = $dept = $type = '';

if($this->input->post('shift')!='')
$shift = $this->input->post('shift');

if($this->input->post('gander')!='')
$gander = $this->input->post('gander');

if($this->input->post('search_dept_report')!='')
$dept = $this->input->post('search_dept_report');

if($this->input->post('type')!='')
$type = $this->input->post('type');
?>
    <form method="post" action="<?php echo base_url('XRAY_Report/') ?>">

        <div class="col-md-2">
            <label>Recept #:</label>
            <input type="text" class="form-control" name="recept" id="recept" /><br />
        </div>

        <div class="col-md-2">
            <label>Paitent Name:</label>
            <input type="text" class="form-control" name="p_name" id="p_name" /><br />
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
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander">
                <option value="">Select Gender</option>
                <option value="Male" <?php if($gander == 'Male') {echo 'selected';} ?>>Male
                </option>
                <option value="Female" <?php if($gander == 'Female') {echo 'selected';} ?>>Female
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Department:</label>
            <select class="form-control" name="search_dept_report" id="search_dept_report">
                <label>Report Filter</label>
                <option value="" selected="" disabled="">Select Department</option>
                <?php
                    foreach ($getDept as $key) 
                    {
                ?>
                    <option value="<?php echo $key->id; ?>"><?php echo $key->dep_name; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="col-md-2">
            <label>Type:</label>
            <select class="form-control" id="type" name="type">
                <option value="">Select Type</option>
                <option value="Paid" <?php if($type == 'Paid') {echo 'selected';} ?>>Paid</option>
                <option value="Casualty" <?php if($type == 'Casualty') {echo 'selected';} ?>>Casualty</option>
                <option value="Ward" <?php if($type == 'Ward') {echo 'selected';} ?>>Ward</option>
                <option value="Labour_Room" <?php if($type == 'Labour_Room') {echo 'selected';} ?>>Labour Room</option>
                <option value="Entitled" <?php if($type == 'Entitled') {echo 'selected';} ?>>Entitled</option>
            </select>
        </div>
        <div class="col-md-12">
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




    <section class="content" style="margin-top: 5px;">

    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <span id="loading" style="display:none;"></span>

    <?php
    $date = date('y-m-d');
    $user_id = $this->session->userdata('user_id');
    
    $this->db->select("*");
    $this->db->from("xray_entry");
    $this->db->where('sync_status', 0);
    $this->db->where('is_deleted', 0);
    $this->db->where('date >=', $date);
    $this->db->where('user_id', $user_id);
    $query1 = $this->db->get(); 
    // print_r($query1->result_array());
    if(count($query1->result_array()) > 0)
    {                           
    ?>
    <button class="btn btn-primary" id="sync" style="float: right;" data-user_id="<?php echo $user_id; ?>">Synchronize</button> 
    <?php } ?>

    <div class="col-md-12" style="margin-top: 5px;">
        
    <div class="row">
    <div class="panel-body">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered">
        <thead>
            <tr style="background-color: #3c8dbc; color: #FFFFFF; font-weight: bold; text-align: center;">
            <th width="5%">S.No</th>
            <th width="5%">Recept</th>
            <th width="10%">Patient</th>
            <th width="5%">Gander</th>
            <th width="10%">Date</th>
            <th width="5%">Dept</th>
            <th width="5%">Shift</th>
            <th width="5%">Type</th>
            <th width="20%">XRAY</th>
            <th width="5%">Films</th>
            <th width="15%">Price</th>
            <th width="10%">Sync</th>
            </tr>
        </thead>

        <tbody>
            <?php $total = $totalFilms = 0;
            if($query->num_rows()>0)
            {
            $count=0;   
            foreach($query->result() as $row){
                
            $count++;   

            $get_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$row->dept_id)->get()->result_array();  
            $get_User = $this->db->SELECT('*')->FROM('user')->where('id',$row->user_id)->get()->result_array();  
            $get_District = $this->db->SELECT('*')->FROM('districts')->where('id',$row->address)->get()->result_array();  

            

            $sql_xray_types = "SELECT * FROM `xray_entry_details` INNER JOIN xray_type On(xray_entry_details.xray_type_id = xray_type.id) AND xray_entry_details.entry_id= '$row->receptNumber' WHERE xray_entry_details.is_deleted=0";

            //echo $sql_xray_types;
            $query_xray_types = $this->db->query($sql_xray_types);


             ?>
            <tr style="font-weight: bold; text-align: center;">
                <td class="center"><?php echo $count; ?></td>
                <td class="center">
                <?php       
                  echo $get_Dept[0]['dept_nick']."-".$row->receptNumber;
                ?>            
                </td>
                 <td class="center" style="text-transform: uppercase;"><?php echo $row->patient_name ?></td>
                 
                 <td class="center"><?php echo $row->gander ?></td>
                 <td class="center"><?php $old_date = $row->date; $old_date_timestamp = strtotime($old_date); $new_date = date('j M, Y g:i A', $old_date_timestamp); echo $new_date;  ?></td>
                <td class="center">
                <?php
                 echo $get_Dept[0]['dep_name']; ?></td>
                 <td class="center"><?php echo ucfirst($row->shift) ?></td>
                 <td class="center"><?php echo ucfirst($row->type) ?></td>
                 <td class="center" style="color: green"><?php
                 foreach($query_xray_types->result() as $row_xray_type){
                echo $row_xray_type->name.'<br>';
                }
                  ?></td>
                 <td><?php echo $row->quantity ?></td>
                 <td class="center" style="color: green;width: 10%;">
                    <a data-entryid="<?php echo $row->receptNumber; ?>" class="xray-invoice" title="View Invoice"><i class="fa  fa-file-text-o"></i></a>
                    <?php echo $row->price."/="; ?>
                    |
                    <?php  $is_admin=$this->session->userdata('is_admin'); 
                    if($is_admin==1){ ?>  
                        <a href="<?php echo base_url('XRAY_Report/xray_print_report_delete/'.$row->receptNumber) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <?php }  ?>
                    </td>
                 
                 <td class="center" style="color: green"><?php 
                 if($row->sync_status == '0')
                 echo 'UN DONE';
                 else if($row->sync_status == '1')
                 echo 'DONE'; ?></td>                
            </tr>
            <?php $total += $row->price; $totalFilms += $row->quantity;  } } ?>
          <tr style="background-color: green; color: #FFFFFF; font-weight: bold; text-align: center;">
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td>
               <td><?php echo $totalFilms; ?></td>  
               <td><?php echo $total; ?></td>
               <td>&nbsp;</td>
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
                <h4 class="modal-title">XRAY Invoice</h4>
              </div>
              <div class="modal-body invoice" id="entry_modal">
                <!-- <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          <b>Painten Info</b>
          <address>
            <strong>Admin, Inc.</strong><br>
            <b>Age:</b> 12<br>
            <b>Gender:</b> Male<br>
            <b>Address:</b><br>
          </address>
        </div>
        <div class="col-sm-6 invoice-col">
          <b>Receipt Number #007612</b><br>
          <b>Shift:</b> 4F3S8J<br>
          <b>Date And Time:</b> 2/22/2014<br>
        </div>
      </div>
                <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Type</th>
              <th>Size</th>
              <th>Qty</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Chest</td>
              <td>8*10</td>
              <td>1</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
                <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total Films:</th>
                <td>4</td>
              </tr>
              <tr>
                <th>Total Amount:</th>
                <td>1500/=</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
                 <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div> -->

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
        $(document).on("click",".xray-invoice",function(){

  var entryid=$(this).data('entryid');

  $.ajax({
    method:"post",
    url:'<?php echo base_url('XRAY_Report/get_invoice') ?>',
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
                    text: 'PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    },
                },
                {
                    extend: 'copy',
                    text: 'Copy',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    },
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    },
                },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10],
                    modifier: {
                        selected: null,
                       }
                }
            },
            {
                extend: 'print',
                text: 'Print selected',
                exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10],
                    },
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
                var user_id= $(this).data("user_id");
                $.ajax({
                url:'<?php echo base_url('login/syncDataXray') ?>',
                method:'POST',
                data:{user_id:user_id},
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