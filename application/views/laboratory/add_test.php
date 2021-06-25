
    <section class="content-header">
      <h1 class="text-success">
        
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li class="btn btn-success"><a  style="color: #FFF" href="<?php echo base_url("/Laboratory/ShowTestCategory/");?>"> Test Category</a></li>
        <li class="btn btn-success"><a  style="color: #FFF" href="<?php echo base_url("/Laboratory/ShowCateWiseSub/");?>"> Test Sub Category</a></li>
        <li class="btn btn-success"><a  style="color: #FFF" href="<?php echo base_url("/Laboratory/ShowSubCatTest");?>"> Tests</a></li>
      </ol>
    </section>
    <div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionOne">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="true" aria-controls="answerOne">
Add Test Form
</a>
</h5>
</div>
<div id="answerOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="questionOne">
<div class="panel-body">
 <div class="row">
   <div class="col-md-12">
     <form action="<?php echo base_url('Laboratory/Add_Test') ?>"  method="POST" class="form-horizontal">
                
                <div class="col-md-4">
            <label>Test Name:</label>
            <input type="text" class="form-control" name="test_name" placeholder="Test Name" required />
        </div>
                 <div class="col-md-4">
            <label>Test Unit:</label>
            <input type="text" class="form-control" name="test_unit" placeholder="Test Unit" required />
        </div>
                    <div class="col-md-4">
            <label>Reference Value:</label>
            <input type="text" class="form-control" placeholder="Reference Value" name="test_refvalue" id="test_refvalue" required />
        </div>

        <div class="col-md-6">
          <label for="Name">Select Category :</label>
            <select name="test_category" class="form-control" id="test_category">
                        <option value="">Select Test Category</option>
                 <?php 
                  // var_dump($data);exit;
                  foreach ($data as $row): ?>
                       <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>

                         <?php
                endforeach;
            ?>
                     </select>
        </div>
        
          <div class="col-md-6">
          <label for="Name">Select Sub Category :</label>
            <select name="test_subcategory[]" id="test_subcategory" class="form-control select2" required multiple="multiple">
                        <option value="">Select Sub Test Category</option>
             
                     </select>
        </div>

        
             
         <div class="col-md-4 col-md-offset-4" style="margin-top: 10px">
          <a href="<?php echo base_url('Laboratory/ShowSubCatTest/'); ?>" class="btn btn-danger"> Cancel </a>
           <input type="submit" value="Save Test" name="save" class="btn btn-info">
         </div>
      </form>
   </div>
      
 </div>

                
</div>
</div>
</div>

<script>
  $(document).ready(function(){
    $('#test_category').change(function(){
      // alert()
      var id=$(this).val();

    $.ajax({
      url: '<?php echo base_url('Laboratory/GetSubCategory') ?>',
      type: 'POST',
      data: {id: id},
      success:function(data)
      {
        $('#test_subcategory').html('');
        $('#test_subcategory').html(data);
      }
    })
    
    })
  })
</script>