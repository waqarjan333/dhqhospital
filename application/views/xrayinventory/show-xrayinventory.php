    <section class="content-header">
      <h1 class="text-success">
        Xray Inventory
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/login');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Xray Inventory</li>
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

    <form method="post" action="<?php echo base_url('XRAY_inventory/add');?>">

        <div class="col-md-4">
        <label>Quantity:</label>
        <input type="number" class="form-control"  name="qty" id="qty" value=""  />
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <br />
        </div>

        <div class="col-md-2" style="margin-top: 25px; float: left;">
        <div align="center">
            <input type="submit" name="save" value="Save" class="btn btn-success"  />
        </div>

        
        </div>
        
    </form>

    </div>
    <div class="panel-body">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered" style="background-color: #ebebe0;">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>XRay Size</th>
                    <th>Quantity</th>
                    <th>Add Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <?php 
            $total = 0;
            //echo count($record); exit;
            if(count($record) > 0)
            {
            if(is_array($record)){
            $count=0;   
            foreach($record as $row){
                
            $count++;   

            $get_xray_size = $this->db->SELECT('*')->FROM('xray_sizes')->where('id',$row->xray_size_id)->get()->result_array();  


             ?>
            <tr>
            <td class="center"><?php echo $count; ?></td>              
            <td class="center"><?php echo $get_xray_size[0]['title']; ?></td>           
            <td class="center" style="color: green"><?php echo $row->qty; ?></td>
            <td><?php echo $row->created_at; ?></td>
            <td>
            <a class="btn-sm btn-success" href="<?php echo base_url("/XRAY_inventory/edit/".$row->id);?>"><i class="fa fa-pencil"></i></a>
            <button class="btn-sm btn-danger" onclick="validate(this)" value="<?=$row->id; ?>" id="<?php echo $get_xray_size[0]['id']; ?>"><i class="fa fa-trash"></i></button>
            </td>
            </tr>
            <?php } } } ?>
        
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
                swal("Deleted!", "XRAY Size has been Deleted.", "success");
                $(location).attr('href','<?php echo base_url()?>/XRAY_inventory/delete/'+id+'/'+a.id);
            }
        );
    }
    </script>