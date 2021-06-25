    <section class="content-header">
      <h1 class="text-success">
        Edit User
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Department</li>
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

    <form method="post" action="<?php echo base_url('Department/edit/'.$id);?>">

        
                <?php if($record[0]['parent_id'] == 0 ) 
                {?>
                <div class="col-md-4">
                <label>Parent Department:</label>
                <select class="form-control" name="p_dep">
                <option value="" selected="" disabled="">Please Select</option>
                <?php 
                if($getDepartment){
                foreach ($getDepartment as $value) {
                ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->dep_name; ?></option>
                <?php } }?>
                </select>
                </div>
                <?php } 
                else {?>
                <div class="col-md-4">
                <label>Parent Department:</label>
                <select class="form-control" name="parent_id">
                <option value="">Please Select</option>
                <?php 
                if($getDepartment){
                foreach ($getDepartment as $value) {
                ?>
                <option value="<?php echo $value->id; ?>" <?php if($value->id == $record[0]['parent_id']){ echo 'selected'; } ?> ><?php echo $value->dep_name; ?></option>
                <?php } }?>
                </select>
                </div>

                <div class="col-md-4">
                <label>Sub Department:</label>
                <select class="form-control" name="p_dep">
                <option value="" selected="" disabled="">Please Select</option>
                <?php 
                if($getSubDepartment){
                foreach ($getSubDepartment as $subvalue) {
                ?>
                <option value="<?php echo $subvalue->id; ?>" <?php if($subvalue->id == $record[0]['id']){ echo 'selected'; } ?>><?php echo $subvalue->dep_name; ?></option>
                <?php } }?>
                </select>
                <?php }
                ?>  
                </div>
            
            
      

        <div class="col-md-4">
            <label>Department Code:</label>
            <input type="text" class="form-control" name="dept_nick" value="<?php echo $record[0]['dept_nick'] ?>" required /><br />
        </div>

        <div class="col-md-4">
            <label>Department Name:</label>
            <input type="text" class="form-control" name="dep_name" value="<?php echo $record[0]['dep_name'] ?>" required /><br />
        </div>

        <div class="col-md-4">
            <label>Price:</label>
            <input type="number" class="form-control" name="price" id="price" value="<?php echo $record[0]['dept_price'] ?>" >
        </div>

        <div class="col-md-4">
            <label>View:</label>
            <select name="view" id="view" class="form-control">
                <option value="" disabled selected>Select View</option>
                <option <?php if($record[0]['view'] == 'OPD'){ echo 'selected'; } ?> value="OPD">OPD</option>
                <option <?php if($record[0]['view'] == 'OTHER'){ echo 'selected'; } ?> value="OTHER">OTHER</option>
                <option <?php if($record[0]['view'] == 'XRAY'){ echo 'selected'; } ?> value="XRAY">XRAY</option>
            </select>
        </div>



        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" value="Save" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    </div>
    </div>

    </div>

    </div>
    </section>