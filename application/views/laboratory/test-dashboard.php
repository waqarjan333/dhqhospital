<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pharmacy.css">
<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/exporting.js"></script>
<script src="<?php echo base_url();?>assets/js/export-data.js"></script>
<script src="<?php echo base_url();?>assets/js/data.js"></script>
<script src="<?php echo base_url();?>assets/js/drilldown.js"></script>
<section class="content-header">
      <h1 class="text-success">
        Laboratory 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li class="btn btn-success"><a  style="color: #FFF" href="<?php echo base_url("/Laboratory/ShowTestCategory/");?>"> Test Category</a></li>
        <li class="btn btn-success"><a  style="color: #FFF" href="<?php echo base_url("/Laboratory/ShowCateWiseSub/");?>"> Test Sub Category</a></li>
        <li class="btn btn-success"><a  style="color: #FFF" href="<?php echo base_url("/Laboratory/ShowSubCatTest");?>"> Tests</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="well">
        <h4>Laboratory Test's</h4>
      </div>
      <!-- for customers -->
      <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('Laboratory/ShowAllTest') ?>">
            <div class="small-box bg-blue">
            <div class="inner">
              <p style="text-align: center;"><b>Add Test</b></p>
            </div>
          </div>
          </a>
        </div>
              <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('Laboratory/ShowTestCategory') ?>">
            <div class="small-box bg-green">
            <div class="inner">
              <p style="text-align: center;"><b>Add Category</b></p>
            </div> </div>
          </a>
        </div>

             <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('Laboratory/ShowSubTestCategory') ?>">
            <div class="small-box bg-choco">
            <div class="inner">
              <p style="text-align: center;"><b>Add Sub Category</b></p>
            </div> </div>
          </a>
        </div>
    </div>
     <!-- /.row -->

   </section>