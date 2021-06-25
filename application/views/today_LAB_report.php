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

    if($this->input->post('type')!='')
    $type = $this->input->post('type');
    else
    $type = '';  

    ?>

    <form method="post" action="<?php echo base_url('LAB_Report/') ?>">

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
                <option value="" selected disabled>Select Shift</option>                 
                <option value="Morning" id="Morning">Morning</option>
                <option value="Evening" id="Evening">Evening</option>
                <option value="Night" id="Night">Night</option>
            </select>
            <br />
        </div>

        <div class="col-md-2">
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander">
                <option value="" selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
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
    $this->db->from("lab_entry");
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
            <th width="10%">Recept</th>
            <th width="10%">Patient</th>
            <th width="5%">Gander</th>
            <th width="10%">Date</th>
            <th width="10%">Dept</th>
            <th width="10%">Shift</th>
            <th width="20%">LAB Test</th>
            <th width="5%">Type</th>
            <th width="5%">Price</th>
            <th width="5%">Invoice</th>
            <th width="5%">Sync</th>
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
            $get_User = $this->db->SELECT('*')->FROM('user')->where('id',$row->user_id)->get()->result_array();  
            $get_District = $this->db->SELECT('*')->FROM('districts')->where('id',$row->address)->get()->result_array();  

            

            $sql_lab_test = "SELECT * FROM `lab_entry_details` INNER JOIN tests On(lab_entry_details.test_id = tests.id) AND lab_entry_details.entry_id= '$row->receptNumber' AND lab_entry_details.is_deleted=0";
            $query_lab_test = $this->db->query($sql_lab_test);
             ?>
            <tr style="font-weight: bold; text-align: center;">
                <td><?php echo $count; ?></td>
                <td>
                <?php       
                  echo $get_Dept[0]['dept_nick']."-".$row->receptNumber;
                ?>            
                </td>
                 <td style="text-transform: uppercase;"><?php echo $row->patient_name ?></td>
                 <!-- <td><?php echo $row->age ?></td> -->
                 <td><?php echo $row->gander ?></td>
                 <td><?php $old_date = $row->date; $old_date_timestamp = strtotime($old_date); $new_date = date('j M, Y g:i A', $old_date_timestamp); echo $new_date;  ?></td>
                <td >
                <?php
                 echo $get_Dept[0]['dep_name']; ?></td>
                 <td><?php echo ucfirst($row->shift) ?></td>
                 
                 <td style="color: green;"><?php
                 foreach($query_lab_test->result() as $row_lab_test){
                echo $row_lab_test->name.'<br>';
                }
                echo $query_lab_test->num_rows();
                $totalTests += $query_lab_test->num_rows();
                  ?></td>
                 <td><?php echo $row->type ?></td>
                 <td style="color: green;">
                    <!-- <a data-entryid="<?php echo $row->id; ?>" class="lab-invoice" title="Ivoice"><i class="fa  fa-file-text-o"></i></a> -->
                    <?php echo $row->price."/="; ?>
                    </td>
                  <td style="color: green;">
                    <a data-entryid="<?php echo $row->receptNumber; ?>" class="lab-invoice" title="Ivoice"><i class="fa  fa-file-text-o"></i></a> | 
                    <?php  $is_admin=$this->session->userdata('is_admin'); 
                    if($is_admin==1){ ?>  
                        <a href="<?php echo base_url('LAB_Report/lab_print_report_delete/'.$row->receptNumber) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <?php }  ?>
                    </td>  
                 <td style="color: green"><?php 
                 if($row->sync_status == '0')
                 echo 'UN DONE';
                 else if($row->sync_status == '1')
                 echo 'DONE'; ?></td>

                              
            </tr>
            <?php $total += $row->price; } } ?>
            <tr style="background-color: green; color: #FFFFFF; font-weight: bold; text-align: center;">
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td> 
               <td><?php echo $totalTests; ?></td> <td>&nbsp;</td> 
               <td><?php echo $total; ?></td>
               <td>&nbsp;</td><td>&nbsp;</td>
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
                url:'<?php echo base_url('login/syncDataLab') ?>',
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