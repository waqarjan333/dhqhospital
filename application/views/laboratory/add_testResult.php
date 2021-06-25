
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
Add Test Result Form
</a>
</h5>
</div>
<div id="answerOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="questionOne">
<div class="panel-body">
 <div class="row">
   <div class="col-md-12">
     <form action="<?php echo base_url('Laboratory/AddTestResult') ?>"  method="POST" class="form-horizontal">
        <input type="hidden" value="<?php echo $this->uri->segment(3) ?>" name="test">
        <div class="col-md-4">
            <label>Test Result:</label>
            <input type="text" class="form-control" name="test_result" placeholder="Test Result" required />
        </div>
         <div class="col-md-4" style="margin-top: 25px">
          <a href="<?php echo base_url('Laboratory/ShowTestResult/'.$this->uri->segment(3)); ?>" class="btn btn-danger"> Cancel </a>
           <input type="submit" value="Save Test Result" name="save" class="btn btn-info">
         </div>
      </form>
   </div>
      
 </div>

                
</div>
</div>
</div>
