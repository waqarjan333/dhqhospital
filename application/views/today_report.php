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

    <form method="post" action="<?php echo base_url('Report/') ?>">

    	<div class="col-md-3">
            <label>Recept #:</label>
            <input type="text" class="form-control" name="recept" id="recept" /><br />
        </div>

    	<div class="col-md-3">
            <label>Paitent Name:</label>
            <input type="text" class="form-control" name="p_name" id="p_name" /><br />
        </div>

        <div class="col-md-3">
            <label>Shift:</label>
            <select id="shift" name="shift" class="form-control">
                <option value="" selected disabled>Select Shift</option>                 
                <option value="Morning" id="Morning">Morning</option>
                <option value="Evening" id="Evening">Evening</option>
                <option value="Night" id="Night">Night</option>
            </select>
            <br />
        </div>

        <div class="col-md-3">
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander">
                <option value="" selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br />
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

<?php
$date = date('Y-m-d');
$dept_id=$this->session->userdata('dept_id');
$this->db->select("*");
$this->db->from("opd_entry");
$this->db->where('sync_status', 0);
$this->db->where('date >=', $date);
$this->db->where('dept_id', $dept_id);
$query1 = $this->db->get();
if(count($query1->result_array()) > 0)
{							
?>
<div class="box-body" style="width: 100%;">
    <a style="float: right;" href="<?php echo base_url('User/add');?>">
    	<span id="loading" style="display:none;"></span>
    	<button class="btn btn-primary" id="sync" data-dept_id="<?php echo $dept_id; ?>">Synchronize</button> </a>
<?php } ?>


    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    	
    <div class="row">
    <div class="panel-body">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
    	<table id="example1" class="table table-hover table-bordered">
		<thead>
			<tr>
            <th width="5%" class="center">S.No</th>
			<th width="10%" class="center">Recept #</th>
			<th width="10%" class="center">Patient</th>
			<th width="5%" class="center">Age</th>
			<th width="5%" class="center">Gander</th>
			<th width="10%" class="center">Address</th>
			<th width="10%" class="center">Date</th>
			<th width="15%" class="center">Department</th>
			<th width="10%" class="center">Shift</th>
			<th width="5%" class="center">Price</th>
			<th width="5%" class="center">Sync</th>
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
			 ?>
			<tr>
				<td class="center"><?php echo $count; ?></td>
				<td class="center">

					<?php
				$result_nick_recipt = $this->db->SELECT('*')->FROM('user')->where('id',$row->user_id)->get()->result();
				foreach ($result_nick_recipt as $value_nick_recipt) {
				$user_nick = $value_nick_recipt->user_nick;
				}
				?>

				<?php 		
				echo  $user_nick."-".$row->receptNumber;
				?>

				
				</td>
				 <td class="center" style="text-transform: uppercase;"><?php echo $row->patient_name ?></td>
				 <td class="center"><?php echo $row->age ?></td>
				 <td class="center"><?php echo $row->gander ?></td>
				 <td class="center"><?php echo $row->address ?></td>
				 <td class="center"><?php $old_date = $row->date; $old_date_timestamp = strtotime($old_date); $new_date = date('j M, Y g:i A', $old_date_timestamp); echo $new_date;  ?></td>
				<td class="center">
				<?php
				$opd = "---";

				$result = $this->db->SELECT('*')->FROM('departments')->where('id',$row->dept_id)->get()->result();
				foreach ($result as $value) {
				$opd = $value->dep_name;
				}
				?>
				 	<?php echo $opd; ?></td>
				 <td class="center"><?php echo ucfirst($row->shift) ?></td>
				 <td class="center" style="color: green"><?php echo $row->price."/="; ?></td>
				 
				 <td class="center" style="color: green"><?php 
				 if($row->sync_status == '0')
				 echo 'UN DONE';
				 else if($row->sync_status == '1')
				 echo 'DONE'; ?></td>				 
			</tr>
			<?php $total += $row->price; } } ?>
		
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
	    $('#example1').DataTable( {
	    	paging:   false,
	        ordering: false,
	        info:     false,
	        dom: 'Bfrtip',
	        buttons: [
	            {
	                extend: 'print',
	                text: 'Print all',
	                exportOptions: {
	                    modifier: {
	                        selected: null
	                    }
	                }
	            },
	            {
	                extend: 'print',
	                text: 'Print selected'
	            }
	        ],
	        select: true
	    } );
	    $('#sync').on('click',function(e){
				e.preventDefault();
				var dept_id= $(this).data("dept_id");
				$.ajax({
				url:'<?php echo base_url('login/sync_insert_fm_opd') ?>',
				method:'POST',
				data:{dept_id:dept_id},
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