    <section class="content-header">
      <h1 class="text-success">
        Edit User
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit User</li>
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

    <form method="post" action="<?php echo base_url('User/edit/'.$id);?>">


         <div class="col-md-4">
            <label>First Name:</label>
            <input type="text" class="form-control" name="fname" value="<?php echo $record[0]['f_name'] ?>" autocomplete="off" /><br />
        </div>

        <div class="col-md-4">
            <label>Last Name:</label>
            <input type="text" class="form-control" name="lname" value="<?php echo $record[0]['l_name'] ?>" autocomplete="off" /><br />
        </div>

        <div class="col-md-4">
            <label>User Name:</label>
            <input type="text" class="form-control" name="uname" required value="<?php echo $record[0]['user_name'] ?>" autocomplete="off" /><br />
        </div>

        <div class="col-md-4">
            <label>New Password:</label>
            <input type="password" class="form-control" name="new_pass"/><br />
        </div>

        <div class="col-md-4">
            <label>Phone:</label>
        <input type="number" class="form-control" pattern="[0-9]{11}" maxlength="11" name="phone" value="<?php echo $record[0]['contact'] ?>" autocomplete="off" /><br />
        </div>

        <div class="col-md-4">
            <label>Email:</label>
            <input type="email" class="form-control" name="email"  value="<?php echo $record[0]['email'] ?>" autocomplete="off" /><br />
        </div>

        <div class="col-md-4">
            <label>Security Type:</label>
            <select name="security_type" class="form-control" required>
                <option <?php if($record[0]['security_type'] == 0){ echo 'selected'; } ?> value="0">None</option>
                <option <?php if($record[0]['security_type'] == 1){ echo 'selected'; } ?> value="1">Email</option>
                <option <?php if($record[0]['security_type'] == 2){ echo 'selected'; } ?> value="2">SMS</option>
                <option <?php if($record[0]['security_type'] == 3){ echo 'selected'; } ?> value="3">2FA</option>
            </select><br />
        </div>

        <div class="col-md-4">
            <label>Status:</label><br>
            <input type="radio"  name="is_admin" value="1" <?php if($record[0]['is_admin'] == 1){ echo 'checked="checked"'; } ?>> <b>Admin</b> &nbsp;&nbsp;&nbsp;
            <input type="radio" name="is_admin" value="0" <?php if($record[0]['is_admin'] == 0){ echo 'checked="checked"'; } ?> > <b>Staff</b><br>
        </div>

        <div class="col-md-4">
            <label>Department:</label>
            <select name="dept_id[]" class="form-control select2" id="dept_id" required multiple="multiple">
                <!-- <option value="" selected="" disabled>Select Departments</option> -->
                <?php
                foreach ($department as $value) { ?>
                    <option <?php if(in_array($value->id, $user_dept_ids )){ echo 'selected'; } ?> value="<?php echo $value->id; ?>"><?php echo $value->dep_name; ?></option>
                <?php } ?>
            </select><br />
        </div>

        <div id="showSubDept"></div>

        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" value="Save" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    </div>
    </div>

    </div>

    </div>
    </section>