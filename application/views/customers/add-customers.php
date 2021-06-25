    <section class="content-header">
      <h1 class="text-success">
        Add User
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add User</li>
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

    <form method="post" action="<?php echo base_url('User/add');?>">

        <div class="col-md-4">
            <label>First Name:</label>
            <input type="text" class="form-control" name="fname" autocomplete="off" /><br />
        </div>

        <div class="col-md-4">
            <label>Last Name:</label>
            <input type="text" class="form-control" name="lname" autocomplete="off" /><br />
        </div>

        <div class="col-md-4">
            <label>User Name:</label>
            <input type="text" class="form-control" style="text-transform: lowercase;" minlength="5" id="uname" name="uname" required autocomplete="off" />
            <div id="msg"></div>
            <br />
        </div>

        <div class="col-md-4">
            <label>Password:</label>
            <input type="password" class="form-control" name="pass" required  /><br />
        </div>

        <div class="col-md-4">
            <label>Phone:</label>
            <input type="number" class="form-control" pattern="[0-9]{11}" minlength="8" maxlength="11" name="phone" autocomplete="off" /><br />
        </div>

        <div class="col-md-4">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" autocomplete="off" /><br />
        </div>

        <!-- <div class="col-md-4">
            <label>Type:</label>
            <select name="type" class="form-control" required>
                <option value="" selected="" disabled>Select Type</option>
                <?php foreach ($type as $value) { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                <?php } ?>
            </select><br />
        </div> -->

        <!-- <div id="showSubDept"></div> -->

        <div class="col-md-4">
            <label>Security Type:</label>
            <select name="security_type" class="form-control" required>
                <option value="0">None</option>
                <option value="1">Email</option>
                <option value="2">SMS</option>
                <option value="3">2FA</option>
            </select><br />
        </div>

        <div class="col-md-4">
            <label>Department:</label>
            <select name="dept_id[]" class="form-control select2" required multiple="multiple">
                <!-- <option value="" selected="" disabled>Select Section</option> -->
                <?php foreach ($department as $value) { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->dep_name; ?></option>
                <?php } ?>
            </select><br />
        </div>

        <div class="col-md-4">
            <label>Status:</label><br>
            <input type="radio" name="is_admin" value="1"> <b>Admin</b> &nbsp;&nbsp;&nbsp;
            <input type="radio" name="is_admin" value="0" checked="checked"> <b>Staff</b><br>
        </div>

        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" value="Save" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    <!-- </div> -->
    </div>
    </div>
    <!-- <div class="col-md-1"></div> -->

    </div>

    </div>
    </section>

    <script type="text/javascript">
    $(document).ready(function(){

        $('#uname').on('change',function(e){
                var uname = $('#uname').val();
                $.ajax({
                url: "<?php echo base_url('User/getUserName/'); ?>",
                data:{ uname:uname},
                method:'post',
                success:function(response)
                {
                     if(response > 0) 
                        {
                            $('#uname').val('');
                            $('#msg').html('<span style="color:red;">*User Name Is Already Exist Please Choose Another !!!</span>');
                        }
                        else
                        {
                            $('#msg').html('<span style="color:green;"></span>');
                        } 
                }
                })  
        });

    });
    </script>


    <!-- <script type="text/javascript">
    $(document).ready(function(){

        $('#dept_id').on('change',function(e){
                e.preventDefault();
                var id= $('#dept_id').val();
                $.ajax({
                url: "<?php echo base_url('User/getSub/'); ?>"+id,
                method:'get',
                success:function(data)
                {
                $('#showSubDept').html(data);
                }
                })  
        });

    });
    </script> -->