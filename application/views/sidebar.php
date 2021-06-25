 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <?php 
            $is_admin = $this->session->userdata('is_admin');
            $dept_ids =$this->session->userdata('dept_ids');
            //print_r($dept_ids); exit;
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
                if($view!='LAB' && $view!='Pharmacy'){
            ?>

            <li class="<?php if ($dept_id == $this->uri->segment(3)) { echo 'active'; } ?>">
            <a href="<?php echo base_url("/$view/index/".$dept_id);?>"><i class="fa fa-key"></i><span> <?php echo $exe[0]['dep_name']; ?></span></a>
            </li>
            
            <?php } elseif ($view=='LAB' && $exe[0]['dep_name']=='Blood Bank') { ?>
             <li class="treeview">
          <a href="#" >
            <i class="fa fa-info"></i> 
            <span>Laboratory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li>
            <a href="<?php echo base_url("/Laboratory/");?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <?php

            foreach ($dept_ids as $dept_id) 
            {
                $this->db->select('dep_name,view');
                $this->db->from('departments');
                $this->db->where('id',$dept_id);
                $exe = $this->db->get()->result_array();
                $view = $exe[0]['view'];
                if($view=='LAB'){
            ?>

            <li class="<?php if ($dept_id == $this->uri->segment(3)) { echo 'active'; } ?>">
            <a href="<?php echo base_url("/$view/index/".$dept_id);?>"><i class="fa fa-key"></i><span> <?php echo $exe[0]['dep_name']; ?></span></a>
            </li>
            
            <?php } } ?>
             <li class="treeview">
              <a href="#">
               <i class="fa fa-info"></i> 
                <span>Adding Area</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url("/Laboratory/ShowTestCategory/");?>"></i><span> Category</span></a>
                </li>
                 <li>
                  <a href="<?php echo base_url("/Laboratory/ShowCateWiseSub/");?>"></i><span>Sub Category</span></a>
                </li>
                 <li>
                  <a href="<?php echo base_url("/Laboratory/ShowSubCatTest");?>"></i><span>Tests</span></a>
                </li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
               <i class="fa fa-info"></i> 
                <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if ($page_name1 == 'LAB_report_for_print') {echo 'active';} ?>">
                  <a href="<?php echo base_url("/LAB_Report/all_report_for_print/");?>"></i><span>Print Test</span></a>
                </li>
                <li class="<?php if ($page_name1 == 'LAB_report') {echo 'active';} ?>">
                  <a href="<?php echo base_url("/LAB_Report/all_report/");?>"></i><span>All Report</span></a>
                </li>
                 <li class="<?php if ($page_name1 == 'dailly_LAB_summary_report') {echo 'active';} ?>">
                  <a href="<?php echo base_url("/LAB_Report/dailly_summary_report");?>"></i><span>Dailly Summary Report</span></a>
                </li>
                 <li class="<?php if ($page_name1 == 'test_wise_report') {echo 'active';} ?>">
                  <a href="<?php echo base_url("/LAB_Report/test_wise_report");?>"></i><span>Test Wise Report</span></a>
                </li>
                <li class="<?php if ($page_name1 == 'revinew_invoice') {echo 'active';} ?>">
                  <a href="<?php echo base_url("/LAB_Report/revinew_invoice");?>"></i><span>Revinew Invoice</span></a>
                </li>
              </ul>
            </li>
        </li>
        </ul>
        </li>
           <?php } elseif ($view=='Pharmacy') { ?>
             <li class="treeview">
          <a href="#" >
            <i class="fa fa-info"></i> 
            <span>Pharmacy</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li>
            <a href="<?php echo base_url("/Pharmacy/");?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li >
          <li class="treeview">
              <a href="#">
               <i class="fa fa-info"></i> 
                <span>Adding Area</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($page_name1 == 'show-product') { echo 'active'; } ?>">
                  <a href="<?php echo base_url("/Product/show_product/");?>"></i><span>Add Product</span></a>
                </li>
                 <li class="<?php if($page_name1 == 'show-unit') { echo 'active'; } ?>">
                  <a href="<?php echo base_url("/Product/show_unit/");?>"></i><span>Add Unit</span></a>
                </li>
                 <li class="<?php if($page_name1 == 'show-category') { echo 'active'; } ?>">
                  <a href="<?php echo base_url("/Product/show_category/");?>"></i><span>Add Category</span></a>
                </li>
                <li class="<?php if($page_name1 == 'show-type') { echo 'active'; } ?>">
                  <a href="<?php echo base_url("/Product/show_type/");?>"></i><span>Add Type</span></a>
                </li>
                <li class="<?php if($page_name1 == 'show-advisor') { echo 'active'; } ?>">
                  <a href="<?php echo base_url("/Pharmacy/show_advisor/");?>"></i><span>Add Advisor</span></a>
                </li>
                 <li class="<?php if($page_name1 == 'show-vendor') { echo 'active'; } ?>">
                  <a href="<?php echo base_url("/SupplierInvoice/show_vendor/");?>"></i><span>Add Supplier</span></a>
                </li>
                <li class="<?php if($page_name1 == 'show-storekeeper') { echo 'active'; } ?>">
                  <a href="<?php echo base_url("/OtherPharmacy/show_storekeeper/");?>"></i><span>Add Store Keeper</span></a>
                </li>
                <li class="<?php if($page_name1 == 'show-wareIncharge') { echo 'active'; } ?>">
                  <a href="<?php echo base_url("/OtherPharmacy/show_wareIncharge/");?>"></i><span>Add Ward Incharge</span></a>
                </li>
                <li>
                  <a href="<?php echo base_url("#");?>"></i><span>Add Equipments</span></a>
                </li>
              </ul>
            </li>
        <li>
          <li class="treeview">
              <a href="#">
               <i class="fa fa-info"></i> 
                <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url("/PharmacyReport/unitIndentReport");?>"></i><span>Unit Indent Report</span></a>
                </li>
                 <li>
                  <a href="<?php echo base_url("/PharmacyReport/PatientInvoiceReport");?>"></i><span>Patient Indent Report</span></a>
                </li>
                 <li>
                  <a href="<?php echo base_url("/PharmacyReport/SupplierReport");?>"></i><span>Supplier Report</span></a>
                </li>
                <li>
                  <a href="<?php echo base_url("/PharmacyReport/StockReport");?>"></i><span>Stock Report</span></a>
                </li>
                <li>
                  <a href="<?php echo base_url("/PharmacyReport/StockReportByDate");?>"></i><span>Stock Report By Date</span></a>
                </li>
                 <li>
                  <a href="<?php echo base_url("/PharmacyReport/InventorySummaryReport");?>"></i><span>Inventory Summary Report</span></a>
                </li>
              </ul>
            </li>
        </li>
        </ul>
        </li>
          <?php } } ?>
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

                if($query_data->num_rows() > 0 && $key->view!='Pharmacy' && $key->view!='LAB')
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
            
            <li class="<?php if ($page_name1 == $key->view.'_report') {echo 'active';} ?>">
            <a href="<?php echo base_url("/".$key->view.'_Report/all_report');?>"><i class="fa fa-info"></i><span>ALL Report</span></a>
             </li>
             
            <li class="<?php if ($page_name1 == 'dailly_'.$key->view.'_summary_report') {echo 'active';} ?>">
            <a href="<?php echo base_url("/".$key->view.'_Report/dailly_summary_report');?>"><i class="fa fa-info"></i><span>Dailly Summary Report</span></a>
            </li>

            <?php if($key->view == 'LAB'){ ?> <li class="<?php if ($page_name1 == 'test_wise_report') {echo 'active';} ?>">
            <a href="<?php  echo base_url("/".$key->view.'_Report/test_wise_report');?>"><i class="fa fa-info"></i><span>Test Wise Report</span></a>
             </li>  
           <?php } ?>

            <?php if($key->view == 'OPD' || $key->view == 'OTHER'){ ?> <li class="<?php if ($page_name1 == 'opd_shift_gender_report') {echo 'active';} ?>">
            <a href="<?php  echo base_url("/".$key->view.'_Report/shift_gender');?>"><i class="fa fa-info"></i><span>Shift Gender Report</span></a>
             </li>  
           <?php } ?>
           
           

           

             <li class="<?php if ($page_name1 == 'opd_revinew_invoice_report') {echo 'active';} ?>">
            <a href="<?php echo base_url("/".$key->view.'_Report/revinew_invoice');?>"><i class="fa fa-info"></i><span>Revinew Invoice</span></a>
             </li> 

                      
          </ul>
        </li>
        <?php } } ?>
        
        <?php if ($is_admin == 1) { ?>
              
          <li class="treeview" >
          <a href="#">
            <i class="fa fa-info"></i>
            <span>All Dept Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
            <a href="<?php echo base_url('/All_report/all_dept_summary');?>"><i class="fa fa-info"></i><span>All Dept Summary Report</span></a>
             </li>
            <li>
            <a href="<?php echo base_url('/All_report/');?>"><i class="fa fa-info"></i><span>All Dept Report</span></a>
             </li>

             <li>
            <a href="<?php echo base_url('/All_report/monthly_yearly_report');?>"><i class="fa fa-info"></i><span>Monthly Yearly Report</span></a>
             </li>
          </ul>
        </li>
        <li class="<?php if ($page_name1 == 'show-customers') {echo 'active';} ?>">
          <a href="<?php echo base_url("/User/");?>"><i class="fa fa-user"></i><span>Users</span></a>
        </li>

        <li class="<?php if ($page_name1 == 'show-departments') {echo 'active';} ?>">
          <a href="<?php echo base_url("/Department/");?>"><i class="fa fa-building-o"></i><span>Add Departments</span></a>
        </li>

        <li class="<?php if ($page_name1 == 'show-districts') {echo 'active';} ?>">
          <a href="<?php echo base_url("/District/");?>"><i class="fa fa-globe"></i><span>Districts</span></a>
        </li>
        

<!--End labtest manue by kashif 8/oct/2019 9:53 -->

        
        <?php }?>

         


        <li>
          <a href="<?php echo base_url("User/backup");?>"><i class="fa fa-globe"></i><span>Backup Database</span></a>
        </li>

        <li>
          <a href="<?php echo base_url("/Login/logout");?>"><i class="fa fa-flat"></i><span>Logout</span></a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>