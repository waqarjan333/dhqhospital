<?php
$user_ok=FALSE;
$log_email="";

if(isset($_SESSION["user_id"]))
{
    $name = "DHQ";
    $content = "DHQ cookies";
    $expiry = time() + (10 * 365 * 24 * 60 * 60);
    
    $log_email = $_SESSION['user_id'];
    //setcookie($name,$content,$expiry,$log_email);
    $user_ok=TRUE;
    }
      elseif(!isset($_SESSION["user_id"]))
    {
      redirect('/Login/');
    }
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('/Dashboard/');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-leaf"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa fa-leaf"></i><b>  DHQ</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <img src="<?php echo base_url();?>assets/theme/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <span> <div style="text-transform: uppercase;"><?php echo $this->session->userdata('name'); ?></div></span>
            </a>


            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/theme/dist/img/avatarnew.jpg" class="img-circle" alt="User Image">
                  
                <p>
                  Account Settings
                </p>
               <a href="<?php echo base_url('/Profile/system_settings') ?>" class="btn btn-info btn-xs" style="color: white;font-weight: bold;">Settings</a>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <?php $user_id = $this->session->userdata('user_id'); ?>
                  <a href="<?php echo base_url('/Profile/user_profile/'.$user_id);?>" class="btn btn-primary btn-flat"><i class="fa fa-user"></i> Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('/Login/logout');?>" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Log Out</a>
                </div>
              </li>
            </ul>
          </li>
        
        </ul>
      </div>
    </nav>
  </header>