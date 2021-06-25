    <section class="content-header">
      <h1 class="text-success">
        Edit District
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit District</li>
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

    <form method="post" action="<?php echo base_url('District/edit/'.$id);?>">

        <div class="col-md-4">
            <label>District Name:</label>
            <input type="text" class="form-control" name="dis_name" value="<?php echo $record[0]['name'] ?>" required /><br />
        </div>

        <div class="col-md-2" style="margin-top: 25px; float: left;">
        <div align="center">
            <input type="submit" name="save" value="Update" class="btn btn-success"  />
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