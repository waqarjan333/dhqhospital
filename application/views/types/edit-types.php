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
            <input type="text" class="form-control" value="<?php echo $record[0]['f_name'] ?>" name="fname" required  /><br />
        </div>

        <div class="col-md-4">
            <label>Last Name:</label>
            <input type="text" class="form-control" value="<?php echo $record[0]['l_name'] ?>" name="lname"  /><br />
        </div>

        <div class="col-md-4">
            <label>User Name:</label>
            <input type="text" class="form-control" value="<?php echo $record[0]['user_name'] ?>" name="uname" required  /><br />
        </div>

        <div class="col-md-4">
            <label>Phone:</label>
            <input type="text" class="form-control" pattern="[0-9]{11}" maxlength="11" value="<?php echo $record[0]['contact'] ?>" name="phone" required  /><br />
        </div>

        <div class="col-md-4">
            <label>Email:</label>
            <input type="email" class="form-control" value="<?php echo $record[0]['email'] ?>" name="email" required  /><br />
        </div>

        <div class="col-md-4">
            <label>Type:</label>
            <select name="type" class="form-control" required>
            <option selected disabled="">--Select Type--</option>
            <?php
                foreach($dropdown as $row)
                {
            ?>
                    <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $record[0]['type']){ echo 'selected'; } ?> ><?php echo $row['name']; ?></option>
            <?php
                }
            ?>
            </select><br />
        </div>
        

        <div class="col-md-4">
            <label>Security Type:</label>
            <select name="security_type" class="form-control" required>
                <option value="0" <?php if($record[0]['security_type'] == '0'){ echo 'selected'; } ?> >None</option>
                <option value="1" <?php if($record[0]['security_type'] == '1'){ echo 'selected'; } ?> >Email</option>
                <option value="2" <?php if($record[0]['security_type'] == '2'){ echo 'selected'; } ?> >SMS</option>
                <option value="3" <?php if($record[0]['security_type'] == '3'){ echo 'selected'; } ?> >2FA</option>
            </select><br />
        </div>


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