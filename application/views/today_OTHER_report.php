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
        Today Records
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
$recept = $p_name = $shift = $gander = $dept = $type = '';

if($this->input->post('recept')!='')
$recept = $this->input->post('recept');

if($this->input->post('p_name')!='')
$p_name = $this->input->post('p_name');

if($this->input->post('shift')!='')
$shift = $this->input->post('shift');

if($this->input->post('gander')!='')
$gander = $this->input->post('gander');

if($this->input->post('search_dept_report')!='')
$dept = $this->input->post('search_dept_report');

if($this->input->post('type')!='')
$type = $this->input->post('type');

if($this->input->post('sub_dept_id')!='')
$sub_dept_id = $this->input->post('sub_dept_id');
else
$sub_dept_id = '';

?>

    <form method="post" action="<?php echo base_url('OTHER_Report/') ?>">
        <div class="col-md-2">
            <label>Receipt #:</label>
            <input type="text" class="form-control" name="recept" id="recept" value="<?php echo $recept;?>" />
        </div>

        <div class="col-md-2">
            <label>Paitent Name:</label>
            <input type="text" class="form-control" name="p_name" id="p_name" value="<?php echo $p_name;?>"/>
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


        <div class="col-md-2">
            <label>Department:</label>
            <select class="form-control" name="search_dept_report" id="search_dept_report">
                <label>Report Filter</label>
                <option value="">Select Department</option>
                <?php
                    foreach ($getDept as $key) 
                    { ?>
                    <option value="<?php echo $key->id; ?>" <?php if($dept == $key->id) {echo 'selected';} ?>>
                        <?php echo $key->dep_name; ?>
                    </option>

                <?php } ?>

            </select>
        </div>
        <div class="col-md-2" id="subdeptart">
            <?php if($sub_dept_id!=''){?>
            <label>Sub Department:</label>
            <select class="form-control" name="sub_dept_id" id="sub_dept_id">
                <label>Report Filter</label>
                <option value="">Select Sub Department</option>
                <?php
                    foreach ($getSubDept as $key) 
                    { ?>
                    <option value="<?php echo $key->id; ?>" <?php if($sub_dept_id == $key->id) {echo 'selected';} ?>>
                        <?php echo $key->dep_name; ?>
                    </option>
                <?php } ?>
            </select>
            <?php } ?>
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

    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <span id="loading" style="display:none;"></span>

    
        <button class="btn btn-primary" style="float: right;" id="sync" data-user_id="<?php echo $user_id; ?>">Synchronize</button>
    <?php // } ?>
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
        
    <div class="row">
    <div class="panel-body">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered">
        <thead>
            <tr style="background-color: #3c8dbc; color: #FFFFFF; font-weight: bold; text-align: center;">
            <th width="5%">S.No</th>
            <th width="5%">Recept</th>
            <th width="20%">Patient</th>
            <th width="5%">Gander</th>
            <th width="20%">Date</th>
            <th width="20%">Department</th>
            <th width="5%">Shift</th>
            <th width="5%">Type</th>
            <th width="5%">Price</th>
            <th width="5%">Print</th>
            <th width="5%">Sync</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            $total = 0;
            if($query->num_rows()>0)
            {
            $count=0;   
            foreach($query->result() as $row){
                
            $count++;   
            $get_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$row->dept_id)->get()->result_array(); 
           
            if($row->sub_dept_id!=NULL)
            {
               $get_sub_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$row->sub_dept_id)->get()->result_array(); 
               $sub_dept_name = $get_sub_Dept[0]['dep_name'];

            }else{

                $sub_dept_name = '';
            }

            $get_User = $this->db->SELECT('*')->FROM('user')->where('id',$row->user_id)->get()->result_array();  
            $get_District = $this->db->SELECT('*')->FROM('districts')->where('id',$row->address)->get()->result_array();
              
              $c_dept_id = $get_Dept[0]['id'];
             ?>
            <tr style="font-weight: bold; text-align: center;">
                <td><?php echo $count; ?></td>
                <td>

                <?php       
                echo  $get_Dept[0]['dept_nick']."-".$row->receptNumber;
                ?>
                
                </td>
                 <td style="text-transform: uppercase;"><?php echo $row->patient_name ?></td>
                 <td><?php echo $row->gander ?></td>
                 <td><?php $old_date = $row->date; $old_date_timestamp = strtotime($old_date); $new_date = date('j M, Y g:i A', $old_date_timestamp); echo $new_date;  ?></td>
                <td>
                    <?php echo $get_Dept[0]['dep_name'];
                    if($sub_dept_name!='')
                    echo '-('.$sub_dept_name.')'; 
                ?>
                </td>
                 <td><?php echo ucfirst($row->shift) ?></td>
                 <td><?php echo ucfirst($row->type) ?></td>  
                 <td><?php echo ucfirst($row->price) ?></td> 
                 <td style="color: green"><a href="<?php echo base_url('OTHER_Report/other_print_report/'.$c_dept_id.'/'.$row->receptNumber) ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                    <?php 
                    $is_admin=$this->session->userdata('is_admin'); 
                    if($is_admin==1){ ?>  
                        <a href="<?php echo base_url('OTHER_Report/other_print_report_delete/'.$c_dept_id.'/'.$row->receptNumber) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <?php }
                    ?>
                    
                 </td>               
                 <td style="color: green"><?php 
                 if($row->sync_status == '0')
                 echo 'UNDONE';
                 else if($row->sync_status == '1')
                 echo 'DONE'; ?></td>                
            </tr>
            <?php $total += $row->price; } } ?>
        <tr style="background-color: green; color: #FFFFFF; font-weight: bold; text-align: center;">
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td><?php echo $total; ?></td><td>&nbsp;</td>
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
                    extend: 'pdf',
                    text: 'PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    },
                },
                {
                    extend: 'copy',
                    text: 'Copy',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    },
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    },
                },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8],
                    modifier: {
                        selected: null,
                       }
                }
            },
            {
                extend: 'print',
                text: 'Print selected',
                exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8],
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
                url:'<?php echo base_url('login/syncDataOther') ?>',
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

       $('#search_dept_report').on('change',function(e){
        e.preventDefault();
        var dept_id = $('#search_dept_report').val();
        var sub_dept_id = '<?php echo $sub_dept_id; ?>';
        $.ajax({
        url:'<?php echo base_url('OTHER_Report/getsubDept') ?>',
        method:'POST',
        data:{dept_id:dept_id,sub_dept_id:sub_dept_id},
        beforeSend:function(){
        $('#loading').css('display','block');
        },
        success:function(message)
        {
        $('#loading').css('display','none');
        $('#subdeptart').html(message);
        }
        })  
        });
    });
    </script>