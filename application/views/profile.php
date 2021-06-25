<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">    
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/theme/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1 class="text-success">
        Services
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/Home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Services</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 15px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div align="center"><h3>Add Servies Here</h3></div>
    <div class="col-md-12">
    <div class="row">
    <div class="panel-body">

    <form method="post" action="<?php echo base_url('Services/add');?>">

        <div class="col-md-4">
            <label>Service Name:</label>
            <input type="text" class="form-control" name="name" required  />
        </div>

        <div class="col-md-4">
        <label>Price:</label>
        <input type="number" class="form-control" name="price" required  />
        </div>

        <div class="col-md-4" style="margin-top: 15px;">
            <input type="submit" name="save" value="Save" class="btn-sm btn-success"  />
        </div>
        
    </form>

    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- </section>

    <section class="content"> -->
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="container" style="margin-top: 15px;">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered" style="background-color: #ebebe0;">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Add Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php
                if($records):
                 $i=1; foreach ($records as $row):
            ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$row->name; ?></td>
                    <td><?=$row->price;?> Rs</td>
                    <td><?=$row->add_date; ?></td>
                    <td>
                    <a class="btn-sm btn-success" href="<?php echo base_url('/Services/edit/'.$row->id) ?>">Edit</a>
                    <a class="btn-sm btn-danger" onclick="return confirm('Are You Sure ?')" href="<?php echo base_url('/Services/delete/'.$row->id) ?>">Delete</a>
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
    </section>
    <script>
    $(function () {
    //$('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    })

    $(document).ready( function () {
    var table = $('#example1').DataTable( {
    pageLength : 5,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
    } )
    } );
    </script>