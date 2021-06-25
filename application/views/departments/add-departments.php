    <section class="content-header">
      <h1 class="text-success">
        Add Departments
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Departments</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 30px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    
    <!-- <div class="col-md-1"></div> -->
    <div class="col-md-12" style="margin-top:30px;">
    <div class="row">
    <!-- <div class="panel panel-success"> -->
    <!--  <div class="panel-heading" align="center" style="color:red;"> Add Class Here </div> -->
    <div class="panel-body">

    <form method="post" action="<?php echo base_url('Department/add');?>">

        <div class="col-md-4">
            <label>Parent Department:</label>
            <select class="form-control" name="p_dep">
                <option value="" selected disabled>Please Select</option>
                <?php 
                if($getDepartment){
                foreach ($getDepartment as $value) {
                ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->dep_name; ?></option>
                <?php } }?>
            </select>
            <span class="text-danger" style="margin-top: 5px;">*Note: Only select if want to add Sub-Department!!!</span>
            <br />
        </div>

        <div class="col-md-4">
            <label>Department Code:</label>
            <input type="text" class="form-control" name="dept_nick" required /><br />
        </div>

        <div class="col-md-4">
            <label>Department Name:</label>
            <input type="text" class="form-control" name="dep_name" placeholder="Department Name" required /><br />
        </div>

        <div class="col-md-4">
            <label>Price:</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Price E.g. 200" >
        </div>

        <div class="col-md-4">
            <label>View:</label>
            <select name="view" id="view" class="form-control">
                <option value="" disabled selected>Select View</option>
                <option value="OPD">OPD</option>
                <option value="OTHER">OTHER</option>
                <option value="XRAY">XRAY</option>
                <option value="LAB">LAB</option>
                <option value="PHARMACY">PHARMACY</option>
            </select>
        </div>

        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" value="Save" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    <!-- </div> -->
    </div>
    </div>
    <!-- <div class="col-md-1"></div> -->

    </div>

    </div>
    </section>