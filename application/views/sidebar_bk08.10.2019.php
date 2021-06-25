 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <?php 
            $is_admin = $this->session->userdata('is_admin');
            $dept_ids =$this->session->userdata('dept_ids');
        ?>
      <ul class="sidebar-menu" data-widget="tree">
       
        <li class="header" style="text-align: center;"><b>NAVIGATION</b></li>

        <!-- Dashbaord -->
        <li class="<?php if ($page_name1 == 'dashboard'){ echo 'active'; }?>">
          <a href="<?php echo base_url('/login/');?>"><i class="fa fa-dashboard"></i><span> Dashboard</span></a>
        </li>

        <!-- For Assign departments -->
        <li class="treeview <?php if ($page_name1 == 'opd_entry' || $page_name1 == 'other_entry'){ echo 'active';} ?> ">
          <a href="#">
            <i class="fa fa-info"></i> 
            <span>Departments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
            $dept_ids =$this->session->userdata('dept_ids');

            foreach ($dept_ids as $dept_id) 
            {
                $this->db->select('dep_name,view');
                $this->db->from('departments');
                $this->db->where('id',$dept_id);
                $exe = $this->db->get()->result_array();
                $view = $exe[0]['view'];
            ?>

            <li class="<?php if ($dept_id == $this->uri->segment(3)) { echo 'active'; } ?>">
            <a href="<?php echo base_url("/$view/index/".$dept_id);?>"><i class="fa fa-key"></i><span> <?php echo $exe[0]['dep_name']; ?></span></a>
            </li>
            
            <?php } ?>
        </ul>
        </li>

        <!-- For Reports -->
        <?php

            $getViews = $this->db->select('view')->from('departments')->group_by('view')->get()->result();

            foreach ($getViews as $key) 
            {

                $controller_name = $key->view.'_Report';

                $this->db->select('*');
                $this->db->where('view',$key->view);
                $this->db->where_in('id', $dept_ids);
                $query_data = $this->db->get('departments');

                if($query_data->num_rows() > 0)
                {
        ?>
        <li class="treeview <?php if (($page_name1 == 'today_'.$key->view.'_report' || $page_name1 == 'dailly_'.$key->view.'_summary_report' || $page_name1 == $key->view.'_report') && $this->uri->segment(1) == $controller_name ){ echo 'active';} ?>" >
          <a href="#">
            <i class="fa fa-info"></i> 
            <span><?php echo $key->view;?> Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($page_name1 == 'today_'.$key->view.'_report') {echo 'active'; } ?>">
            <a href="<?php echo base_url("/".$key->view.'_Report/');?>"><i class="fa fa-info"></i><span>Today <?php echo $key->view;?> Report</span></a>
            </li>

            <li class="<?php if ($page_name1 == 'dailly_'.$key->view.'_summary_report') {echo 'active';} ?>">
            <a href="<?php echo base_url("/".$key->view.'_Report/dailly_summary_report');?>"><i class="fa fa-info"></i><span>Dailly <?php echo $key->view;?> Summary Report</span></a>
            </li>

            <?php if ($is_admin == 1) { ?>
            <li class="<?php if ($page_name1 == $key->view.'_report') {echo 'active';} ?>">
            <a href="<?php echo base_url("/".$key->view.'_Report/all_report');?>"><i class="fa fa-info"></i><span><?php echo $key->view;?> Report</span></a>
            <?php } ?>
            </li>            
          </ul>
        </li>
        <?php } } ?>

        <?php if ($is_admin == 1) { ?>
        <li class="<?php if ($page_name1 == 'show-customers') {echo 'active';} ?>">
          <a href="<?php echo base_url("/User/");?>"><i class="fa fa-user"></i><span>Users</span></a>
        </li>

        <li class="<?php if ($page_name1 == 'show-departments') {echo 'active';} ?>">
          <a href="<?php echo base_url("/Department/");?>"><i class="fa fa-building-o"></i><span>Add Departments</span></a>
        </li>

        <li class="<?php if ($page_name1 == 'show-districts') {echo 'active';} ?>">
          <a href="<?php echo base_url("/District/");?>"><i class="fa fa-globe"></i><span>Districts</span></a>
        </li>
        <li class="<?php if ($page_name1 == 'show-districts') {echo 'active';} ?>">
          <a href="<?php echo base_url("/XRAY_type/");?>"><i class="fa fa-globe"></i><span>XRAY Type</span></a>
        </li>
        <li class="<?php if ($page_name1 == 'xray_inventory') {echo 'active';} ?>">
          <a href="<?php echo base_url("/XRAY_size/");?>"><i class="fa fa-globe"></i><span>XRAY Inventory</span></a>
        </li>
        <?php }?>

        <li>
          <a href="<?php echo base_url("User/backup");?>"><i class="fa fa-globe"></i><span>Backup Database</span></a>
        </li>

        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>