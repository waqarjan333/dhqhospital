<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pharmacy.css">
<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/exporting.js"></script>
<script src="<?php echo base_url();?>assets/js/export-data.js"></script>
<script src="<?php echo base_url();?>assets/js/data.js"></script>
<script src="<?php echo base_url();?>assets/js/drilldown.js"></script>
<section class="content-header">
      <h1 class="text-success">
        Pharmacy 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pharmacy Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="well">
        <h4>Adding</h4>
      </div>
      <!-- for customers -->
      <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('Product/show_product') ?>">
            <div class="small-box bg-blue">
            <div class="inner">
              <p style="text-align: center;"><b>Add Product</b></p>
            </div>
          </div>
          </a>
        </div>
      <!-- ./col -->
    
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-2 col-xs-5">
          <!-- small box -->
            <a href="<?php echo base_url('Product/show_unit') ?>">
              <div class="small-box bg-purple">
            <div class="inner">
              <p style="text-align: center;"><b>Add Unit</b></p>
            </div>
          </div>
            </a>
        </div>
              <div class="col-lg-2 col-xs-7">
          <!-- small box -->
          <a href="<?php echo base_url('Product/show_category') ?>">
            <div class="small-box bg-green">
            <div class="inner">
              <p style="text-align: center;"><b>Add Category</b></p>
            </div> </div>
          </a>
        </div>
          <div class="col-lg-2 col-xs-7">
          <!-- small box -->
          <a href="<?php echo base_url('Product/show_type') ?>">
            <div class="small-box bg-green">
            <div class="inner">
              <p style="text-align: center;"><b>Add Type</b></p>
            </div> </div>
          </a>
        </div>
        <div class="col-lg-2 col-xs-7">
          <!-- small box -->
          <a href="<?php echo base_url('Pharmacy/show_advisor') ?>">
            <div class="small-box bg-green">
            <div class="inner">
              <p style="text-align: center;"><b>Add Adviser</b></p>
            </div> </div>
          </a>
        </div>
            
    </div>
    <div class="row" style="margin-top: 40px;border-top: 4px solid gray;padding: 30px;">
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
            <a href="<?php echo base_url('SupplierInvoice/show_vendor') ?>">
              <div class="small-box bg-blue">
            <div class="inner">
              <p style="text-align: center;"><b>Add Supplier</b></p>
            </div>
          </div>
            </a>
        </div>
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
            <a href="<?php echo base_url('OtherPharmacy/show_storekeeper') ?>">
              <div class="small-box bg-pink">
            <div class="inner">
              <p style="text-align: center;"><b>Add Store Keeper</b></p>
            </div>
          </div>
            </a>
        </div>
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
            <a href="<?php echo base_url('OtherPharmacy/show_wareIncharge') ?>">
              <div class="small-box bg-brown">
            <div class="inner">
              <p style="text-align: center;"><b>Add Ware Incharge</b></p>
            </div>
          </div>
            </a>
        </div>
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
            <a href="#">
              <div class="small-box bg-choco">
            <div class="inner">
              <p style="text-align: center;"><b>Add Equipments</b></p>
            </div>
          </div>
            </a>
        </div>
        
      <!-- ./col -->
    </div>
     <!-- /.row -->
    
   </section>