    <style>
  #box{
  -webkit-box-shadow: -4px 24px 31px 39px rgba(217,217,217,0.88);
-moz-box-shadow: -4px 24px 31px 39px rgba(217,217,217,0.88);
box-shadow: -4px 24px 31px 39px rgba(217,217,217,0.88);
  }
  #record{
  -webkit-box-shadow: -33px 25px 31px 10px rgba(219,208,216,1);
-moz-box-shadow: -33px 25px 31px 10px rgba(219,208,216,1);
box-shadow: -33px 25px 31px 10px rgba(219,208,216,1);
  }
#p_record li{
  list-style: none;
  font-size: 15px;
}
input{
  background-image: url('<?php echo base_url('images/text-bg.gif') ?>') !important;
  background-position:center !important;
  /*background-repeat: repeat-x;*/
     color: black;
    /*padding: 1px 3px 2px 3px;*/
    background: white repeat-x 0 0;
    border-width: 1px;
    border-style: solid !important;
    border-color: #b5b8c8 !important;
    height: 23px !important;
    margin-top: 6px;
    
}
select {
   background-image: url('<?php echo base_url('images/text-bg.gif') ?>') !important;
  background-position:center !important;

  height: 30px !important;

} 
select#category {
    font-size: 12px;
}
select#vendor,#med_type {
    font-size: 12px;
}
.input-group-addon {
    height:   5px !important;

    background: #F0F0F0 !important;
}
/*#s_rec{
  background: red;
  cursor: pointer;
}*/
#s_rec:hover{
  background: #DBD0D8;
  cursor: pointer;
}
#s_pro{
  width: 70%;
  border-right: 3px solid #DED9DF;
  font-weight:bold;
}
#s_pro1{
  width: 30%;
}
</style>
    <section class="content-header">
      <h1 class="text-success">
        
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Type</li>
      </ol>
    </section>
    <div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionOne">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="true" aria-controls="answerOne">
Update Type Form
</a>
</h5>
</div>
<div id="answerOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="questionOne">
<div class="panel-body">
 <div class="row">
   <div class="col-md-7">
     <form action="<?php echo base_url('Pharmacy/edit_advisor/'.$id) ?>" method="POST" class="form-horizontal">
                <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label">Type Name :</label>
                    <span id="name_error" style="color: red;font-size: 11px;"></span>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" value="<?php echo $record[0]['name'] ?>" placeholder="Unit Name" name="name" id="name" required />
                    
                  </div>
                </div>
               
                 <div class="form-group">
                   <div class="col-md-4 col-md-offset-3">
                     <input type="submit" value="Update Unit" name="update_advisor" style="width: 150px;color: green;font-weight: bold;height: 40px !important;border-radius:10px;font-size: 20px">
                   </div>
                 </div>
                </form>
   </div>
      
 </div>

                
</div>
</div>
</div>
