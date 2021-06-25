<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<style type="text/css">
    table.dataTable tbody tr {
    min-height: 15px !important;
    font-size: 12px;
}
.content {
    min-height: 120px !important;
    padding: 0px!important;
}
table.dataTable tbody tr, table.dataTable thead tr, table.dataTable tfoot tr {
  font-size: 9px;
}
</style>
    <section class="content-header">
      <h1 class="text-success">
        Laboratory
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laboratory Records</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
<?php 
$from = $to = $shift = $gander = $dept = $type = $dept_id = '';

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

if($this->input->post('type')!='')
$type = $this->input->post('type');

if($this->input->post('search_dept_report')!='')
$dept_id = $this->input->post('search_dept_report');
?>
    <form method="post" action="<?php echo base_url('LAB_Report/all_report_for_print') ?>">

        <div class="col-md-2">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="from" required autocomplete="off" value="<?php echo $from; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div></br>
        </div>

        <div class="col-md-2">
            <label>To Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="to" required autocomplete="off" value="<?php echo $to; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div></br>
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
            <br />
        </div>

        <div class="col-md-2">
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander">
                <option value="">Select Gender</option>
                <option value="Male" <?php if($gander == 'Male') {echo 'selected';} ?>>Male
                </option>
                <option value="Female" <?php if($gander == 'Female') {echo 'selected';} ?>>Female
                </option>
            </select><br />
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
                    <option <?php if($dept_id==$key->id){ echo "selected"; } ?> value="<?php echo $key->id; ?>"><?php echo $key->dep_name; ?></option>
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
    <section class="content" >
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">

    <?php
    $date = date('y-m-d');
    
    // $this->db->select("*");
    // $this->db->from("lab_entry");
    // $this->db->where('sync_status', 0);
    // $this->db->where('is_deleted', 0);
    // $query1 = $this->db->get();
    // if(count($query1->result_array()) > 0)
    // {                           
    ?>
    <button class="btn btn-primary" id="sync" style="float: right; display: none;">Synchronize All Data</button> 
    <?php //} ?>

    <div class="col-md-12">
        
    <div class="row">
    <div class="panel-body">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered">
        <thead>
            <tr style="background-color: #3c8dbc; color: #FFFFFF; font-weight: bold; text-align: center;">
            <th width="5%">S.No</th>
            <th width="15%">Recept</th>
            <th width="15%">Patient</th>
            <th width="5%">Gander</th>
            <th width="10%">Date</th>
            <th width="10%">Shift</th>
            <th width="20%">LAB Test</th>
            <th width="10%">Print</th>
            <th width="5%">Type</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            $total = $totalTests = 0; 
            if($query->num_rows()>0)
            {
            $count=0;   
            foreach($query->result() as $row){

                
            $count++;   

            $get_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$row->dept_id)->get()->result_array();  
            // print_r($get_Dept);
            $get_User = $this->db->SELECT('*')->FROM('user')->where('id',$row->user_id)->get()->result_array();  
            $get_District = $this->db->SELECT('*')->FROM('districts')->where('id',$row->address)->get()->result_array();  

            $sql_lab_test = "SELECT * FROM `lab_entry_details` INNER JOIN testcategories On(lab_entry_details.test_id = testcategories.id) AND lab_entry_details.entry_id= '$row->receptNumber' WHERE lab_entry_details.is_deleted=0 AND lab_entry_details.yearly=".$row->yearly_no;
            $query_lab_test = $this->db->query($sql_lab_test);
              // echo $sql_lab_test;  
             ?>
            <tr style="font-weight: bold; text-align: left;">
                <td><?php echo $count; ?></td>
                <td>

                <?php       
                  echo $get_Dept[0]['dept_nick']."-".$row->yearly_no."-".$row->receptNumber;
                ?> 

                
                </td>
                 <td style="text-transform: uppercase;"><?php echo $row->patient_name ?></td>
                 <td><?php echo $row->gander ?></td>
                 <td><?php $old_date = $row->date; $old_date_timestamp = strtotime($old_date); $new_date = date('j M, Y g:i A', $old_date_timestamp); echo $new_date;  ?></td>
                 <td><?php echo ucfirst($row->shift) ?></td>
                 <td><?php
                 foreach($query_lab_test->result() as $row_lab_test){ ?>
                <?php echo $row_lab_test->name; ?><br>
               <?PHP }
                $totalTests += $query_lab_test->num_rows();
                  ?>
                  
              </td>
              <td>
                <input type="hidden" value="<?php echo $row->yearly_no ?>" id="yearly_no">
                <button type="button" id="print_test" class="btn btn-success print_test" data-id="<?php echo $row->id ?>">Print</button></td>
                  <td><?php echo $row->type ?></td> 
                <td></td>                  
            </tr>
            <?php  } } ?>
            
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
        <!-- Test Showing Model -->
        <div class="modal fade" id="modal-test">
          <div class="modal-dialog"  style="width:500px;height: auto;">
            <div class="modal-content" >
               <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Print Tests</h4>
              </div>
              <div class="modal-body invoice" id="test_modal">
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
  var yearly_no=$(this).data('yearly_no');

  $.ajax({
    method:"post",
    url:'<?php echo base_url('LAB_Report/get_invoice') ?>',
    data:{entryid:entryid,yearly_no:yearly_no},
    beforeSend:function(){
        $('#loading').css('display','block');
    },
    success:function(data){
      $('#test_modal').html(data);
      $('#loading').css('display','none');
      /*var url_for_login=full_path+"admin/user-login-from-admin/"+data.token_for_admin_login+'/'+data.user_id;
      $("#login_url").val(url_for_login);*/
      $("#modal-test").modal("show");
    // alert(data);
    },error: function(response) {
            console.log(response);
        }
  });
});

$(document).ready(function() {
  $(document).on('click','.print_test',function(){
    var test_id=$(this).data('id');
    var yearly_no=$('#yearly_no').val();
                 $.ajax({
    method:"post",
    url:'<?php echo base_url('LAB_Report/getPrintTest') ?>',
    data:{test_id:test_id,yearly_no:yearly_no},
    beforeSend:function(){
        $('#loading').css('display','block');
    },
    success:function(data){
      $('#test_modal').html(data);
      $('#loading').css('display','none');
      /*var url_for_login=full_path+"admin/user-login-from-admin/"+data.token_for_admin_login+'/'+data.user_id;
      $("#login_url").val(url_for_login);*/
      $("#modal-test").modal("show");
    // alert(data);
    },error: function(response) {
            console.log(response);
        }
  });
         }) 

 $(document).on('click','#printSpecificTest',function(){
        var id=$(this).data('id');
      redirect(id);         // alert(id)
            })

 $(document).on('click','#PrintMultiple',function(){
          var id = [];
        $(':checkbox:checked').each(function(i){
          id[i] = $(this).val();
        });
        redirect(id);
            })

  $(document).on('click','#PrintAll',function(){
    var clicked = false;
  $(".checkhour").prop("checked", !clicked);
  clicked = !clicked;
  var id = [];
  $(':checkbox:checked').each(function(i){
          id[i] = $(this).val();
        });
  redirect(id);
    // alert(val)  
 })

 function redirect(id)
 {
                    $.ajax({
  url:"<?php echo base_url();?>LAB/getTestResultEntry",
  data:{id:id},
  method:"POST",
  success:function(data)
  {
     window.location.href="<?php echo base_url();?>LAB/getTestResultEntry/"+id;

  }
}); 
 }


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
            columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'copy',
                    text: 'Copy',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9],
                    modifier: {
                        selected: null,
                       }
                }
            },
            {
                extend: 'print',
                text: 'Print selected',
                exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9],
                    },
            }
            ],
            scrollY:        "500px",
                scrollX:        true,
                scrollCollapse: true,
                paging:         false,
                fixedColumns:   {
                    heightMatch: 'none'
                },
            select: true
        });


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