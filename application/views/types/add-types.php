    <section class="content-header">
      <h1 class="text-success">
        Add Types
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Types</li>
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

    <form method="post" action="<?php echo base_url('Type/add');?>">

        <div class="col-md-2"></div>
        <div class="col-md-4">
            <label>Type Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Type Name" required /><br />
        </div>

        <div class="col-md-4">
            <label>Department:</label>
            <select class="form-control" name="dep_id">
                <option value="" selected disabled>Please Select</option>
                <?php 
                if($getDepartment):
                foreach ($getDepartment as $value):
                ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->dep_name; ?></option>
                <?php endforeach; endif; ?>
            </select><br />
        </div>
        <div class="col-md-2"></div>

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