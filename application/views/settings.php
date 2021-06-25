    <section class="content-header">
      <h1 class="text-success">
        Hospital Information
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hospital Information</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 30px;">

    <!-- Showing flashmessage after success or failure -->
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
     <?php $sql="SELECT * FROM hospital_info";
            $query=$this->db->query($sql);
            $num=$query->num_rows();
            $result=$query->result_array();
            if($num <1){
      ?>   
    <div class="col-md-12" style="margin-top:30px;">
    <div class="row"><div class="panel-body">

    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('Profile/system_settings/');?>">


        <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="row">
            <div class="col-md-12">
                <h4 align="center" class="text-danger"><b>Hospital Informations</b></h4>
                <label>Hospital Name:</label>
                <input type="text" class="form-control" name="hname" value="" autocomplete="off"  /><br />
            </div>
            </div>
            
            <div class="row">
            <div class="col-md-12">
                <label>Hospital Address:</label>
                <input type="text" class="form-control" name="address" value="" autocomplete="off" required /><br />
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
                <label>Hospital Logo:</label>
                <input type="file" class="form-control" name="logo" /><br />
            </div>
             <?php if(isset($upload_error)) echo $upload_error ?>
            </div>

        </div>
        </div>

        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" value="Save Informations" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    </div>
    </div>
<?php } ?>
<?php if($num>0){ ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Hospital Name</th>
                        <th>Hospital Address</th>
                        <th>Hospital Logo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $result[0]['name']; ?></td>
                        <td><?php echo $result[0]['address']; ?></td>
                        <td><img src="<?php echo $result[0]['logo']; ?>" class="img-responsive" style="width: 120px" alt=""></td>
                        <td><a href="<?php echo base_url('Profile/EditSettings') ?>" ><i class="fa fa-edit fa-2x text-success"></i></a> | <button class="btn-sm btn-danger" onclick="validate(this)" value="<?=$result[0]['id']; ?>"><i class="fa fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php 
}?>
    </div>

    </div>
    </section>

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
                swal("Deleted!", "Advisor has been Deleted.", "success");
                $(location).attr('href','<?php echo base_url()?>/Profile/delete_info/'+id);
            }
        );
    }
    </script>