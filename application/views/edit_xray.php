    <section class="content-header">
      <h1 class="text-success">
     <!--  -->
       
      Edit XRAY Informations
              <?php 
              $recept=$this->uri->segment(3);
               $dept=$this->uri->segment(4);
               $yearly_no=$this->uri->segment(5);

               //echo $yearly_no; exit;

               $exe="SELECT xray_entry.*,xray_entry_details.id,xray_entry_details.entry_id,GROUP_CONCAT( xray_type_id ) as type_id FROM xray_entry LEFT JOIN xray_entry_details ON (xray_entry_details.entry_id=xray_entry.receptNumber) WHERE xray_entry.receptNumber='".$recept."' AND xray_entry.yearly_no='".$yearly_no."' AND xray_entry.dept_id='".$dept."'";
              //echo $exe; exit;
               $sql = $this->db->query($exe);
                    $query=$sql->result_array();
            
                     $date=$query[0]['date'];
                     
                     
                 $xray_type=  $this->db->select('*')->from('xray_type')->get()->result();
                 $districts=  $this->XrayModel->get_districts();  

                 
        ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">LAB Informations</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 30px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">

    <span id="loading" style="display:none;"></span>
    
    
    <div class="col-md-12" style="margin-top:30px;">
    <div class="row">
    
    <div class="panel-body">
<?php 
$type = "";


if($this->input->post('type')!=''){
    $type = $this->input->post('type');
}


?>
    <form method="post" action="" id="xray_form" autocomplete="off">
        <input type="hidden" name="dept_id" id="dept_id" value="<?php echo $dept; ?>">

        <div class="col-md-4">
            <?php //$invno=$inv_no->row_array(); ?>
            <label>Recept #:</label>
            <input type="text" class="form-control" name="receptNumber" id="receptNumber" readonly value="XRAY-<?php echo $query[0]['yearly_no'] ?>-<?php echo $query[0]['receptNumber'] ?>" />
        </div>

        <div class="col-md-4">
            <label>Date:</label>
            <input type="text" class="form-control" name="testDate" id="testDate" readonly value="<?php echo date('h:i A d-m-Y D',strtotime($date)) ?>"  />
        </div>

        <div class="col-md-4">
            <label>Shift:</label>
            <select name="shift" id="shift" class="form-control" required="" disabled >                 
                <option value="Morning" <?php if($query[0]['shift']=='Morning'){ ?>  selected="selected" <?php } ?>>Morning</option>
                <option value="Evening" <?php if($query[0]['shift']=='Evening'){ ?>  selected="selected" <?php } ?>>Evening</option>
                <option value="Night" <?php if($query[0]['shift']=='Night'){ ?>  selected="selected" <?php } ?>>Night</option>
            </select>
            
        </div>
        <div class="col-md-1">
            <label>Age:</label>
            <input type="text" class="form-control" name="age" value="<?php echo $query[0]['age'] ?>" id="age"  />
        </div>
        <div class="col-md-2">
            <label>Address:</label>
            <select id="address" name="address" class="form-control" required="" >  
           <?php foreach ($districts as $value) { ?>
                      <option value="<?php echo $value->id; ?>" <?php if($query[0]['address']==$value->id){?>  selected="selected" <?php } ?>><?php echo $value->name; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            <label>Gender:</label>
            <select class="form-control" id="gander"  name="gander" required="">
                <option value="Male" <?php if($query[0]['gander']=="Male" ){?> selected="selected" <?php } ?>>Male</option>
                <option value="Female" <?php if($query[0]['gander']=="Female" ){?> selected="selected" <?php } ?>>Female</option>
            </select>
        </div>
        <div class="col-md-2">
            <label>Paitent Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $query[0]['patient_name'] ?>" id="name" autofocus required placeholder="Paitent Name" style="text-transform:uppercase;"  />
        </div>
 <div class="col-md-2">
            <label>Ref #:</label>
            <input type="text" class="form-control" name="refrence" value="<?php echo $query[0]['refrence'] ?>" name="refrence"    />
        </div>

        
		<div class="col-md-1">
		<label>Films:</label>
			<input type="text" value="<?php echo $query[0]['quantity'] ?>" class="form-control qty-row" name="quantity" id="qty_1" required="required" />
		</div>
        <div class="col-md-2">
            <label>Type:</label>
            <select class="form-control" id="type" name="type">
                <option value="Paid" <?php if($query[0]['type'] == 'Paid') {echo 'selected';} ?>>Paid</option>
                <option value="Casualty" <?php if($query[0]['type'] == 'Casualty') {echo 'selected';} ?>>Casualty</option>
                <option value="Ward" <?php if($query[0]['type'] == 'Ward') {echo 'selected';} ?>>Ward</option>
                <option value="Labour_Room" <?php if($query[0]['type'] == 'Labour_Room') {echo 'selected';} ?>>Labour Room</option>
                <option value="Entitled" <?php if($query[0]['type'] == 'Entitled') {echo 'selected';} ?>>Entitled</option>
            </select>
        </div>
        
        <div class="col-md-4">
        <label>X-Ray Type</label>
        <select id="xray_types_1" name="xray_types[]" class="form-control select2 xraytypes" required="" multiple="">
            <?php
                $xray_id=explode(",",$query[0]['type_id']);
                
                foreach ($xray_id as  $xray_type_id) {
                        
             foreach ($xray_type as $value) { ?>
            <option value="<?php echo $value->id; ?>" <?php if($xray_type_id==$value->id){?>  selected="selected" <?php } ?>><?php echo $value->name; ?></option>
            <?php } }?>                 
        </select>
        </div>
        




        
        
        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" id="save" value="Update" class="btn btn-success"  />
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
        
        $('#save').on('click',function(e){
            e.preventDefault();
        
        var name=$('#name').val();
        var xray_types = $('#xray_types_1').val();


        if(name == '' || name == null)
        {
            alert('Please Enter Paitent Name')
            return false;
        }

        if(xray_types == '' || xray_types == null)
        {
            alert('Please Add Atleast 1 XRAY Type');
            return false;
        }


        $('.btn-success').css('display','none');
        $.ajax({
            url:'<?php echo base_url('XRAY/update') ?>',
            method:'POST',
            data:$("#xray_form").serialize(),
            beforeSend:function(){   
            $('#loading').css('display','block');
            },
            success:function()
            {
                $('#loading').css('display','none');
                // window.open('<?php //echo base_url('XRAY/xray_print/'.$dept_id) ?>');
                // location.reload();
                window.location="<?php echo base_url('XRAY_Report/all_report') ?>";
            }
        })
        });
        $(function() {
            document.onkeydown = function(event) {
        switch (event.keyCode) {
           case 38:
                document.getElementById("gander").options[0].selected=true;
              break;
           case 40:
                document.getElementById("gander").options[1].selected=true;
              break;
        }
    };
   }); 
    </script>