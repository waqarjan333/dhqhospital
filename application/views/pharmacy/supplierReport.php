<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
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
    <form method="post" action="<?php echo base_url('LAB_Report/dailly_summary_report') ?>">

    	<div class="col-md-3">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="from" value="">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <label>To Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="to"  value="">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        

        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="search" id="search" value="Search" class="btn btn-success"  />
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
    <div class="col-md-12" style="margin-top: 5px;">
    	
    <div class="row">
    <div class="panel-body">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
    	<table id="example1" class="table table-hover table-bordered">
		<thead>
			<tr>
            <th>S,NO</th>
			<th>Recept Number</th>
			<th>Product Name</th>
			<th>Quantity</th>
			</tr>
		</thead>

		<tbody>
            <?php 
            $total=0;
            $count=0; foreach($record->result() as $row){ $count++; ?>			
			<th><?php echo $count; ?></th>
                <td><?php echo "Invoice # ".$row->receptNumber ?></td>
                <td><?php echo $row->name ?></td>
                <td><?php echo $row->quantity ?></td>     
                             
            </tr>
        <?php $total=$total+$row->quantity; } ?>
        <tr style="background-color: lightgray;color: blue;font-weight: bold;font-size: 19px">
            <td ><span>Total Quantity</span></td>
            <td ></td>
            <td ></td>
            <td><i><?php echo $total; ?></i></td>
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
    </script>

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
        var dept = $("#search_dept_report option:selected").text();
            if(dept!="Select Department"){
                 dept = $("#search_dept_report option:selected").text();
            } else {
                dept = "";
            }
            var sub_dept = $("#sub_dept_id option:selected").text();
            if(sub_dept!="Select Department"){
                 sub_dept = $("#search_dept_report option:selected").text();
            } else {
                sub_dept = "";
            }
            var headerTitle = "<h2>DHQ HOSPITAL BATKHELA<small> ("+dept+" { "+sub_dept+" } )</small></h2>";

          
            $('#example1').DataTable( {
            paging:   false,
            ordering: false,
            info:     false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    text: 'PDF'
                },
                {
                    extend: 'copy',
                    text: 'Copy'
                },
                {
                    extend: 'csv',
                    text: 'CSV'
                },
                {
                    extend: 'excel',
                    text: 'Excel'
                },
                {
                    extend: 'print',
                    text: 'Print all',
                    title: headerTitle,
                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                },
                {
                    extend: 'print',
                    text: 'Print selected'
                },
            ],
            select: true
        } );

       
    } );
    </script>