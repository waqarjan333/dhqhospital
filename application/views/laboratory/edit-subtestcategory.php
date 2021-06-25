
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
Edit Category Form
</a>
</h5>
</div>
<div id="answerOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="questionOne">
<div class="panel-body">
 <div class="row">
   <div class="col-md-7">
     <form action="<?php echo base_url('Laboratory/EditSubTestCategory/'.$id) ?>" method="POST" class="form-horizontal">


                <div class="col-md-4">
                  <label>Select Category : </label>
                  <select name="sub_category" class="form-control" required="" >                 
                      <option value="">Select Test Category</option>
                      <?php  foreach ($data as $row) { ?>
                        <option <?php if($record[0]['parent_id']==$row->id){ echo "selected"; } ?> value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                      <?php } ?>
                  </select>
                  <br />
                </div>

                <div class="col-md-4">
                    <label>Category Name : </label>
                    <input type="text" class="form-control" name="name" value="<?php echo $record[0]['name'] ?>" /><br />
                </div>
               
                 <div class="col-md-3" style="margin-top: 25px;">
                    <div align="center">
                      <a href="<?php echo base_url('Laboratory/ShowCateWiseSub/'.$this->uri->segment(4)); ?>" class="btn btn-danger"> Cancel </a>
                        <input type="submit" name="save" value="Save" class="btn btn-success"  />
                    </div>
                  </div>
      </form>
   </div>
      
 </div>

                
</div>
</div>
</div>