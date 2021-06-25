    <section class="content-header">
      <h1 class="text-success">
        Category
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/login');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 20px;">

    <!-- Showing flashmessage after success -->
    <?php if ($this->session->flashdata('message')) { ?>

        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('message'); ?></strong>
        </div>

    <?php } ?>

    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">       
    <div class="row">
    <div class="panel-body">
    <a style="float: right; margin: 10px;" href="<?php echo base_url('Product/add_category');?>"><button class="btn btn-primary">Add New</button> </a>
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered" style="background-color: #ebebe0;">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Category Name</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            <?php
                if($data):
                 $i=1; foreach ($data as $row):
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td>
                    <a class="btn-sm btn-success" href="<?php echo base_url("/Product/edit_category/".$row->id);?>"><i class="fa fa-pencil"></i></a>
                    
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
                $(location).attr('href','<?php echo base_url()?>/Product/delete_category/'+id);
            }
        );
    }
    </script>