<section class="content-header">
      <h1 class="text-success">
        Users
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/login');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 20px;">

    <!-- Showing flashmessage after success -->
    <?php if ($this->session->flashdata('message')) { ?>

        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('message'); ?></strong>
        </div>

    <?php } elseif ($this->session->flashdata('error')) { ?>
        
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>

    <?php } ?>

    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">       
    <div class="row">
    <div class="panel-body">

    <a style="float: right; margin: 10px;" href="<?php echo base_url('User/add');?>"><button class="btn btn-primary">Add New</button></a>



    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered" style="background-color: #ebebe0;">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>User Name</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Security</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php

                if($data):
                 $i=1; foreach ($data as $row):
            ?>
                <tr>
                    <td><?=$i;?></td>
                    <td>
                        <?php if(!empty($row->user_name)) echo $row->user_name; else echo "Not Available"; ?>
                    </td>
                    <td>
                        <?php if(!empty($row->f_name)) echo $row->f_name." ".$row->l_name; else echo "Not Available"; ?>
                    </td>
                    <td>
                        <?php if(!empty($row->contact)) echo $row->contact; else echo "Not Available"; ?>
                    </td>
                    <td>
                        <?php if(!empty($row->email)) echo $row->email; else echo "Not Available"; ?>
                    </td>
                    <td><?php if($row->is_admin=='0'){ echo "Staff"; } elseif ($row->is_admin=='1') { echo "Admin"; } ?></td>


                    <td><?php if($row->security_type=='0'){ echo "None"; } elseif ($row->security_type=='1') { echo "Email"; } elseif ($row->security_type=='2') { echo "SMS"; } elseif ($row->security_type=='3') { echo "2FA"; } ?></td>
                    <td>
                    <a class="btn-sm btn-success" href="<?php echo base_url('/User/edit/'.$row->id) ?>"><i class="fa fa-pencil"></i></a>
                   
                    <button class="btn-sm btn-danger" onclick="validate(this)" value="<?=$row->id; ?>"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
           <?php
                $i++;
                endforeach;
                endif;
            ?>
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
    <script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
   
    <script>
    $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'stateSave'   : true
    })
    });
    </script>

    <script>
    function validate(a)
    {
        var id= a.value;

        swal({
                title: "Are you sure?",
                text: "You want to delete this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete it!",
                closeOnConfirm: false }, function()
            {
                swal("Deleted!", "User has been Deleted.", "success");
                $(location).attr('href','<?php echo base_url()?>/User/delete/'+id);
            }
        );
    }
    </script>