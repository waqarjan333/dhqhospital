<section class="content-header">
      <h1 class="text-success">
        Dashboard Of User
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      <h4 style="text-transform: uppercase;"><?php echo $message; ?></h4>
    </section>
<?php
$date = date('Y-m-d');


$this->db->select("count(*) as no");       
$this->db->where('is_deleted',0);                 
$query_user = $this->db->get("user");          
$usersNo = $query_user->result(); 
$total_user = $usersNo[0]->no;

$this->db->select("count(*) as no");       
$this->db->where('date >=', $date);                 
$query_opd_entry = $this->db->get("opd_entry");
$opd_entryNo = $query_opd_entry->result(); 
$total_opd_entry = $opd_entryNo[0]->no;


$this->db->select("count(*) as no");       
$this->db->where('date',$date);                 
$query_other_entry = $this->db->get("other_entry");          
$other_entryNo = $query_other_entry->result(); 
$total_other_entry = $other_entryNo[0]->no;

$this->db->select("count(*) as no");              
$query_sub_departement = $this->db->get("departments");          
$sub_departementNo = $query_sub_departement->result(); 
$total_sub_departement = $sub_departementNo[0]->no;

?>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <!-- for customers -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $total_user; ?></h3>
              <p><b>Users</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url('/User'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            <?php //echo base_url('/User'); ?>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $total_opd_entry;?></h3>
              <p><b>Today OPD Enteries</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php  echo $total_other_entry; ?></h3>
              <p><b>Other Enteries</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-medkit"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $total_sub_departement; ?></h3>
              <p><b>Sub Departments</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-hospital-o"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
      </div>
      <!-- /.row -->