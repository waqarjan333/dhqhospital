    <section class="content-header">
      <h1 class="text-success">
        User Profile
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Profile</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 30px;">

    <!-- Showing flashmessage after success or failure -->
    <?php if ($this->session->flashdata('message')) { ?>

        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('message'); ?></strong>
        </div>

    <?php } elseif ($this->session->flashdata('error')) { ?>
        
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>

    <?php } ?>

    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top:30px;">
    <div class="row"><div class="panel-body">

    <form method="post" action="<?php echo base_url('Profile/user_profile/'.$id);?>">


        <div class="row">
        <div class="col-md-6">

            <div class="row">
            <div class="col-md-12">
                <h4 align="center" class="text-danger"><b>Basic Informations</b></h4>
                <label>User Name:</label>
                <input type="text" class="form-control" name="uname" value="<?php echo $record[0]['user_name'] ?>" autocomplete="off" readonly /><br />
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
                <label>First Name:</label>
                <input type="text" class="form-control" name="fname" value="<?php echo $record[0]['f_name'] ?>" autocomplete="off" required /><br />
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
                <label>Last Name:</label>
                <input type="text" class="form-control" name="lname" value="<?php echo $record[0]['l_name'] ?>" autocomplete="off" required /><br />
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
                <label>Phone:</label>
            <input type="number" class="form-control" pattern="[0-9]{11}" maxlength="11" name="phone" value="<?php echo $record[0]['contact'] ?>" autocomplete="off" /><br />
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
                <label>Email:</label>
                <input type="email" class="form-control" name="email"  value="<?php echo $record[0]['email'] ?>" autocomplete="off" /><br />
            </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="row">
            <div class="col-md-12">
            <h4 align="center" class="text-danger"><b>Change Password</b></h4>
            <label>Current Password:</label>
            <input type="password" class="form-control" name="current_pass" placeholder="Enter Current System Password Here" autocomplete="off" /><br />
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
            <label>New Password:</label>
            <input type="password" class="form-control" name="new_pass" placeholder="Enter New Password Here" autocomplete="off" /><br />
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
            <label>Again New Password:</label>
            <input type="password" class="form-control" name="again_new_pass" placeholder="Enter Again New Password Here" autocomplete="off" /><br />
            </div>
            </div>

        </div>
        </div>

        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" value="Update Profile" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    </div>
    </div>

    </div>

    </div>
    </section>