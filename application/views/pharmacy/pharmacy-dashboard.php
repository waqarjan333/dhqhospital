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
        <h4>UNIT INDENT INVOICE</h4>
      </div>
      <!-- for customers -->
      <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('UnitIndent/') ?>">
            <div class="small-box bg-blue">
            <div class="inner">
              <p style="text-align: center;"><b>Unit Indent</b></p>
            </div>
          </div>
          </a>
        </div>
              <div class="col-lg-6 col-xs-7">
          <!-- small box -->
          <a href="<?php echo base_url('Pharmacy/patient_indent') ?>">
            <div class="small-box bg-green">
            <div class="inner">
              <p style="text-align: center;"><b>Medicine Issue To Patient</b></p>
            </div> </div>
          </a>
        </div>
    </div>
     <!-- /.row -->

   </section>
   <!-- unit indent section end here -->
     <section class="content mt">
      <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="well">
        <h4>Supplier Invoice</h4>
      </div>
      <!-- for customers -->
      <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('SupplierInvoice/') ?>">
            <div class="small-box bg-black">
            <div class="inner">
              <p style="text-align: center;"><b>Supplier Invoice</b></p>
            </div>
          </div>
          </a>
        </div>
      <!-- ./col -->
    
      <!-- ./col -->
      <div class="col-lg-6 col-xs-6">
          <a href="<?php echo base_url('SupplierInvoice/supplierOrder') ?>"><div class="small-box bg-red">
            <div class="inner">
              <p style="text-align: center;"><b>Supplier Order</b></p>
            </div>
          </div></a>
        </div>
      <!-- ./col -->
    </div>
     <!-- /.row -->

   </section>
   <!-- Supplier Invoice End Here -->
     <section class="content mt">
      <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="well">
        <h4>Unit Indent Record</h4>
      </div>
      <!-- for customers -->
      <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('UnitIndent/show_IndentInvoices') ?>">
            <div class="small-box bg-pink">
            <div class="inner">
              <p style="text-align: center;"><b>Unit Indent Record</b></p>
            </div>
          </div>
          </a>
        </div>
              <div class="col-lg-6 col-xs-12">
          <!-- small box -->
            <a href="<?php echo base_url('Pharmacy/show_patientInvoices') ?>">
              <div class="small-box bg-darkgray">
            <div class="inner">
              <p style="text-align: center;"><b>Record Of Medicine Issued to Patient</b></p>
            </div>
          </div>
            </a>
        </div>
      <!-- ./col -->
    </div>
     <!-- /.row -->

   </section>
   <!-- Unit Indent Record End Here -->
        <section class="content mt">
      <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="well">
        <h4>Supplier Invoice Record</h4>
      </div>
      <!-- for customers -->
      <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('SupplierInvoice/ShowSupplierInvoice') ?>">
            <div class="small-box bg-orange">
            <div class="inner">
              <p style="text-align: center;"><b>Supplier Record</b></p>
            </div>
          </div>
          </a>
        </div>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('SupplierInvoice/StockAdjustements') ?>">
            <div class="small-box bg-brown">
            <div class="inner">
              <p style="text-align: center;"><b>Stock Adjustement</b></p>
            </div>
          </div>
          </a>
        </div>
      <!-- ./col -->
    </div>
     <!-- /.row -->

   </section>