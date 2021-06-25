
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
     <form action="<?php echo base_url('Laboratory/EditTestCategory/'.$id) ?>" method="POST" class="form-horizontal">
                <div class="col-md-4">
                    <label>Category Name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $record[0]['name'] ?>" /><br />
                </div>

                <div class="col-md-4">
                    <label>Amount :</label>
                    <input type="text" class="form-control" name="amount" value="<?php echo $record[0]['price'] ?>" /><br />
                </div>
               
               
                 <div class="col-md-4" style="margin-top: 25px;">
                    <div align="center">
                      <input type="submit" name="cancel" value="Cancel" class="btn btn-danger"  />
                        <input type="submit" name="save" value="Update" class="btn btn-success"  />
                    </div>
                  </div>
                </form>
   </div>
      
 </div>

                
</div>
</div>
</div>