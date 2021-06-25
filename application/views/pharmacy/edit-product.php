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
        Edit Product
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product</li>
      </ol>
    </section>

   </section>
    <div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionOne">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="true" aria-controls="answerOne">
Add Product Form
</a>
</h5>
</div>
<div id="answerOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="questionOne">
<div class="panel-body">
 <div class="row">
   <div class="col-md-7">
     <form action="<?php echo base_url('Product/edit/'.$id) ?>" method="POST" class="form-horizontal">
                <div class="form-group">
                  <label for="Product Type" class="col-sm-2 control-label">Product Type :</label>
                  <div class="col-sm-5">
                     <select name="product_type" id="product_type" class="form-control">
             <option value="">Product Type</option>
             <option value="1" <?php if($record[0]['product_type']==1){?>selected=""<?php } ?>>Medicine</option>
             <option value="2" <?php if($record[0]['product_type']==2){?>selected=""<?php } ?>>LAB , XRAY , BB , ECG , B&C & Equipement</option>
           </select>
                  </div>
                </div>
                <?php if($record[0]['product_type']==1){
                    $name=explode("/",$record[0]['name']);
                 ?>
                <div class="medinfo">
                  <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label">Dosage Form :</label>
                    <span id="name_error" style="color: red;font-size: 11px;"></span>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" value="<?php echo $name[0] ?>" placeholder="Dosage Form" name="dosage_form" id="dosage_form"  />
                    
                  </div>
                </div>

                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Generic Name :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" value="<?php echo $name[1] ?>" placeholder="Generic Name" name="generic_name" id="generic_name"  />
                  </div>
                </div> 
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Strength :</label>

                  <div class="col-sm-5">
                       <input type="text" class="form-control" value="<?php echo $name[2] ?>" name="strength" id="strength" placeholder="Strength"  />
                  </div>
                </div>  
                 <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Brand Name :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" value="<?php echo $name[3] ?>" name="brand" id="brand" placeholder="Brand Name" >
                  </div>
                </div> 
                </div>
                <?php }else{ ?>
                <div class="labinfo">
                   <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Product Name :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" value="<?php echo $record[0]['name'] ?>" placeholder="Product Name" name="lab_info" id="lab_info"  />
                  </div>
                </div> 
                </div>
            <?php } ?>
                   <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Medicine Category :</label>

                  <div class="col-sm-5">
                       <select name="category" id="category" class="form-control">
             <option value="">Medicine Category</option>
             <option value="Syrup" <?php if($record[0]['category'] == 'Syrup'){ echo 'selected'; } ?>>Syrup</option>
             <option value="Tablet" <?php if($record[0]['category'] == 'Tablet'){ echo 'selected'; } ?>>Tablet</option>
             <option value="Injection" <?php if($record[0]['category'] == 'Injection'){ echo 'selected'; } ?>>Injection</option>
             <option value="Capsule" <?php if($record[0]['category'] == 'Capsule'){ echo 'selected'; } ?>>Capsule</option>
           </select>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Select Vendor :</label>

                  <div class="col-sm-5">
                       <select name="vendor" id="vendor" class="form-control">
             <option value="Company" <?php if($record[0]['company'] == 'Company'){ echo 'selected'; } ?>>Company</option>
             <option value="Local" <?php if($record[0]['company'] == 'Local'){ echo 'selected'; } ?>>Local</option>
           </select>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Opening Quantity :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" value="<?php echo $record[0]['quantity'] ?>" name="quantity" id="quantity" placeholder="Batch No" >
                  </div>
                </div>  
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Batch No :</label>

                  <div class="col-sm-5">
                       <input type="text" class="form-control" value="<?php echo $record[0]['batch_no'] ?>" name="batch_no" id="batch_no" placeholder="Batch No" >
                  </div>
                </div>   
                 <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Expiry :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" value="<?php echo $record[0]['expiry'] ?>" name="expiry" id="expiry" placeholder="Expiry" data-toggle="datepicker">
                  </div>
                </div>   
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Low Stock Limit :</label>

                  <div class="col-sm-5">
                      <input type="number" class="form-control" value="<?php echo $record[0]['low_limit'] ?>" name="low_stock" id="low_stock"  placeholder="Stock Limit" >
                  </div>
                </div>   
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Medicine Type :</label>

                  <div class="col-sm-5">
                       <select name="med_type" id="med_type" class="form-control">
             <option value="1" <?php if($record[0]['med_type'] == '1'){ echo 'selected'; } ?>>General</option>
             <option value="2" <?php if($record[0]['med_type'] == '2'){ echo 'selected'; } ?>>Insuline</option>
             <option value="3" <?php if($record[0]['med_type'] == '3'){ echo 'selected'; } ?>>OPD</option>
             <option value="4" <?php if($record[0]['med_type'] == '4'){ echo 'selected'; } ?>>Hapatites</option>
             
           </select>
                  </div>
                </div>  
               <?php if(isset($item_id)){?>
  <div class="form-group">
                    <div class="row">
            
       <div class="col-md-6 col-md-offset-3" style="border: 1px solid darkgray;border-radius: 10px; padding: 5px;width: 200px">
            <ul>
            <li>EDG43</li>
            <li>AGE47</li>
            <li>GEGA4</li>
        </ul>
       </div>
       <div class="col-md-4" style="margin-top: 27px;">
           <span class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add</span>
       </div>
        </div> 
                 </div>
               <?php  } ?>
                 <div class="form-group">
                   <div class="col-md-4 col-md-offset-3">
                     <input type="submit" value="Save Item" name="save" style="width: 100px;color: green;font-weight: bold;height: 40px !important;border-radius:10px;font-size: 20px">
                   </div>
                 </div>
                </form>
   </div>
      
      <div class="col-md-3" >
        
          <div class="panel panel-warning" id="record" style="background: #F3F5F5">
            
        <div class="panel-body">
          <h3>Search Product</h3>
          <form action="">
            <div class="form-group">
              <label for="">Item Name:</label>
              <input type="text" class="form-control" id="medicine_name" placeholder="Enter Item Name Here">
            </div>
               <div class="form-group">
              <label for="">Item Category:</label>
              <select name="" class="form-control input-sm" id="medicine_type">
                <option value="">Select Medicine Type</option>
             <option value="1">General</option>
             <option value="2">Insuline</option>
             <option value="3">OPD</option>
             <option value="4">Hapatites</option>
              </select>
            </div>
            <button type="button" value="" id="search" class="btn btn-default btn-sm">Search</button>
            <button type="button" value="" id="show_all" class="btn btn-default btn-sm">Show All</button><hr>
            <div id="item" style="height: 415px; overflow: scroll;background:#EEEEEE;box-shadow: -4px 24px 31px 39px rgba(217,217,217,0.88);">
             <table class="table  table-striped">
               <thead style="background: #C5C5C5;">
                 <tr id="s_record">
                   <th>Item Name</th>
                   <th>Quantity</th>
                 </tr>
               </thead>
               <tbody id="show">
               </tbody>
             </table>
            </div>
          </form>
        </div>

        </div>
      </div>
 </div>

                
</div>
</div>
</div>
  <script>
    $(document).ready(function(){
       $('.labinfo').show();
      $('[data-toggle="datepicker"]').datepicker({
           format: 'yyyy-mm-dd'
        });

      $('#product_type').on('change',function(){
        var value=$(this).val();
        // alert(value);
        if(value==1)
        {
        $('.medinfo').show();
        $('.labinfo').show();
        }
        else{
          $('.medinfo').hide();
          $('.labinfo').show();
        }
      })

          $('#show_all').on('click',function(){
      var status=1;
      $.ajax({
          url:'<?php echo base_url('Product/get_all_product') ?>',
          method:'POST',
          dataType: "json",
          data:{status:status},
          success:function(data)
          {
            // result=$.parseJSON(data);
            $('#show').html('');
           $.each(data,function(index,item){
                        $("<tr id='s_rec' data-id='"+item.id+"' class='item'> ").append(
                        $("<td id='s_pro'>").text(item.dosage_form+' / '+item.generic_name+' / '+item.strength),
                        $("<td id='s_pro1'>").text(item.quantity)
                        ).appendTo("#show");

                       });
          }
      })
    })

      $('#search').on('click',function(){
      // alert()
      var val=$('#medicine_type').val();
      var inp=$('#medicine_name').val();
      if( val)
      {

          $.ajax({
          url:'<?php echo base_url('Product/get_product_type') ?>',
          method:'POST',
          dataType:'json',
          data:{val:val},
          success:function(data)
          {
            $('#show').html('');
            if(data!='')
                {
                  $.each(data,function(index,item){
                   $("<tr id='s_rec' data-id='"+item.id+"' class='item'> ").append(
                        $("<td id='s_pro'>").text(item.dosage_form+' / '+item.generic_name+' / '+item.strength+' / '+item.brand_name),
                        $("<td id='s_pro1'>").text(item.quantity)
                        ).appendTo("#show");

                       });
                }
                else{
                   $("<tr id='s_rec'> ").append(
                        $("<td colspan='2' >").html('<center><p style="color:red">No Record Found</p></center>')
                        
                        ).appendTo("#show");
                }


               
          }
      })

        
       
      }
      else if(inp){
        // $('#medicine_cat').val('');
         $.ajax({
          url:'<?php echo base_url('Product/get_product_name') ?>',
          method:'POST',
          dataType:'json',
          data:{inp:inp},
          success:function(data)
          {
            $('#show').html('');
            if(data!='')
                {
                  $.each(data,function(index,item){
                          $("<tr id='s_rec' data-id='"+item.id+"' class='item'> ").append(
                        $("<td id='s_pro'>").text(item.dosage_form+' / '+item.generic_name+' / '+item.strength+' / '+item.brand_name),
                        $("<td id='s_pro1'>").text(item.quantity)
                        ).appendTo("#show");

                       });
                }
                else{
                   $("<tr id='s_rec'> ").append(
                        $("<td colspan='2' >").html('<center><p style="color:red">No Record Found</p></center>')
                        
                        ).appendTo("#show");
                }


               
          }
      })
      }
     
    })     
   
    })
  </script>