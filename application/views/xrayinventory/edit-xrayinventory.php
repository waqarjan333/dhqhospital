    <section class="content-header">
      <h1 class="text-success">
        Edit XRAY Size
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit XRAY Quantity</li>
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

    <form method="post" action="<?php echo base_url('XRAY_inventory/edit/'.$id);?>">
        <div class="col-md-4">
        <label>Quantity:</label>
        <input type="text" class="form-control"  name="qty" id="qty" value="<?php echo $record[0]['qty'] ?>"  />
        <input type="hidden" class="form-control"  name="xray_size_id" id="xray_size_id" value="<?php echo $record[0]['xray_size_id'] ?>"  />
        <br />
        </div>

        <div class="col-md-2" style="margin-top: 25px; float: left;">
        <div align="center">
            <input type="submit" name="save" value="Update" class="btn btn-success"  />
            <a href="<?php echo base_url('/XRAY_inventory/add');?>" class="btn btn-danger">Cancel </a>
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