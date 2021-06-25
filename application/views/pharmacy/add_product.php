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
        <li class="active">Add Product</li>
      </ol>
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
     <form action="<?php echo base_url('Product/add_product') ?>" method="POST" class="form-horizontal">
                <div class="form-group">
                  <label for="Product Type" class="col-sm-2 control-label">Product Type :</label>
                  <div class="col-sm-5">
                     <select name="product_type" id="product_type" class="form-control">
             <option value="">Medicine Type</option>
             <option value="1" selected="">Medicine</option>
             <option value="2">LAB , XRAY , BB , ECG , B&C & Equipement</option>
           </select>
                  </div>
                </div>
                  <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Product Category :</label>

                  <div class="col-sm-5">
                      <div class="row">
                        <div class="col-sm-8">
                           <select name="product_cat" id="product_cat" class="select2" style="width: 100%" required="">
             <option value="">Product Category</option>
              <?php foreach ($getTypes as $row): ?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
              <?php endforeach; ?>
           </select>
                        </div>
                        <div class="col-sm-4">
                          <input type="button" data-toggle="modal" data-target="#typeModel" id="" class="btn-sm" value="Add Product Type" style="line-height: 10px;">
                        </div>
                      </div>
                  </div>
                </div> 
                   <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Medicine Category :</label>

                  <div class="col-sm-5">
                      <div class="row">
                        <div class="col-sm-8">
                           <select name="category" id="category" class="select2" style="width: 100%" required="">
             <option value="">Medicine Category</option>
              <?php foreach ($getCats as $row): ?>
                  <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
              <?php endforeach; ?>
           </select>
                        </div>
                        <div class="col-sm-3">
                          <input type="button" style="line-height: 10px;" data-toggle="modal" data-target="#catModel" class="btn-sm" value="Add Category">
                        </div>
                      </div>
                  </div>
                </div>  
                <div class="medinfo">
                  <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label">Dosage Form :</label>
                    <span id="name_error" style="color: red;font-size: 11px;"></span>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" placeholder="Dosage Form" name="dosage_form" id="dosage_form"  />
                    
                  </div>
                </div>

                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Generic Name :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" placeholder="Generic Name" name="generic_name" id="generic_name"  />
                  </div>
                </div> 
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Strength :</label>

                  <div class="col-sm-5">
                       <input type="text" class="form-control" name="strength" id="strength" placeholder="Strength"  />
                  </div>
                </div>  
                 <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Brand Name :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand Name" >
                  </div>
                </div> 
                </div>

                <div class="labinfo">
                   <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Product Name :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" placeholder="Product Name" name="lab_info" id="lab_info"  />
                  </div>
                </div> 
                </div>
                 
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Select Vendor :</label>

                  <div class="col-sm-5">
                       <select name="vendor" id="vendor" class="form-control">
             <option value="Company">Company</option>
             <option value="Local">Local</option>
           </select>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Opening Quantity :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Opening Quantity" >
                  </div>
                </div>  
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Batch No :</label>

                  <div class="col-sm-5">
                       <input type="text" class="form-control" name="batch_no" id="batch_no" placeholder="Batch No" >
                  </div>
                </div>   
                 <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Expiry :</label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control" name="expiry" id="expiry" placeholder="Expiry" data-toggle="datepicker">
                  </div>
                </div>   
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Low Stock Limit :</label>

                  <div class="col-sm-5">
                      <input type="number" class="form-control" name="low_stock" id="low_stock" placeholder="Stock Limit" >
                  </div>
                </div>   
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Medicine Type :</label>

                  <div class="col-sm-5">
                       <select name="med_type" id="med_type" class="form-control">
             <option value="1">General</option>
             <option value="2">Insuline</option>
             <option value="3">OPD</option>
             <option value="4">Hapatites</option>
             
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

<!-- Modal For Batch Number and Expiry -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Batch Number</h4>
        </div>
        <div class="modal-body">
         <div class="row">
             <div class="col-md-12">
                  <form action="">
                <div class="col-md-6">
            <label>Batch No:</label>
            <input type="number" class="form-control" name="low_stock" id="price" placeholder="Stock Limit" >
        </div>

          </form>
             </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
      <!-- MODEL FOR ADD CATEGORY -->
    <div class="modal fade" id="catModel" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Category Form</h4>
        </div>
        <div class="modal-body">
         <div class="row">
             <div class="col-md-12">
              <p id="catMessage" style="color: green;font-weight: bold;">Added</p>
                  <form action="">
                <div class="col-md-10">
            <label>Category Name:</label>
            <input type="text" class="form-control" name="catName" id="catName" placeholder="Enter Category Name" >
            <span id="catError" style="color: red;font-weight: bold;">Category Required</span>
        </div>

          </form>
             </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="catSave" class="btn btn-primary btn-sm">Save</button>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
        <!-- Product For Type Model -->
  <div class="modal fade" id="typeModel" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Product Type Form</h4>
        </div>
        <div class="modal-body">
         <div class="row">
             <div class="col-md-12">
              <p id="typeMessage" style="color: green;font-weight: bold;">Added</p>
                  <form action="">
                <div class="col-md-12">
            <label>Type Name:</label>
            <input type="text" class="form-control" required="" name="typeName" id="typeName" placeholder="Enter Category Name" >
            <span id="typeError" style="color: red;font-weight: bold;">Type Required</span>
        </div>
          <div class="col-md-12">
     <label for="">Select Unit Indent:</label>
      <select name="indent_type" id="indent_type" class="select2" style="width: 100%">
                      <option value="">Select Indent Type</option>
                       <?php foreach($unit_ident->result() as $row){ ?>
      <option value="<?php echo $row->id ?>"><?php echo $row->dep_name ?></option>
    <?php } ?>
       </select>
       <span id="indentError" style="color: red;font-weight: bold;">Indent Required</span>
    </div>

          </form>
             </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="typeSave" class="btn btn-primary btn-sm">Save</button>
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
       $('.labinfo').hide();
       $('#catMessage').hide();
       $('#typeMessage').hide();
       $('#typeError').hide();
       $('#catError').hide();
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
            var name='';
            // result=$.parseJSON(data);
            $('#show').html('');
           $.each(data,function(index,item){
                  if(item.product_type==1)
                  {
                    var result = item.name.split('/');
                    name=result[0]+' / '+result[1]+' / '+result[2]+' / '+result[3];
                  }
                  else{
                    name=item.name;
                  }
                        $("<tr id='s_rec' data-id='"+item.id+"' class='item'> ").append(
                        $("<td id='s_pro'>").text(name),
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
                        $("<td id='s_pro'>").text(item.name),
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

         $(document).on('click','#catSave',function(){
    // alert()
    var name=$('#catName').val();
    if(name==''){
       $('#catError').show()
     $("#catError").fadeOut(2000);
   // e.preventDefault();
    }else{
      $.ajax({
          url:'<?php echo base_url('Product/save_category') ?>',
          method:'POST',
          data:{name:name},
          success:function(data)
          {
            $('#catMessage').show()
             setTimeout(function() { 
         
           $("#catMessage").fadeOut(2000);
           $('#catName').val('');
    }, 2000); 
          
           
          }
   })
         $.ajax({
          url:'<?php echo base_url('Product/getCat') ?>',
          method:'POST',
          dataType:'json',
          data:{name:name},
          success:function(data)
          {
            $('#category').html('');
            $.each(data,function(index,item){
                  $('#category').append('<option value="'+ item.id+'">'+ item.name +'</option>');
                                 }); 
          }
   }) 
    }
       
    })


     $(document).on('click','#typeSave',function(){
    // alert()
    var name=$('#typeName').val();
    var indent_type=$('#indent_type').val();
    if(name==''){
      $('#typeError').show()
     $("#typeError").fadeOut(2000);
   e.preventDefault();
    }
    else if(indent_type==''){
      $('#indentError').show()
     $("#indentError").fadeOut(2000);
   e.preventDefault();
    }else{
            $.ajax({
          url:'<?php echo base_url('Product/save_type') ?>',
          method:'POST',
          data:{name:name,indent_type:indent_type},
          success:function(data)
          {
            $('#typeMessage').show()
             setTimeout(function() { 
         
           $("#typeMessage").fadeOut(2000);
           $('#typeName').val('');
    }, 2000); 
          
           
          }
   })  
   
    $.ajax({
          url:'<?php echo base_url('Product/getType') ?>',
          method:'POST',
          dataType:'json',
          data:{name:name},
          success:function(data)
          {
            $('#product_cat').html('');
            $.each(data,function(index,item){
                  $('#product_cat').append('<option value="'+ item.id+'">'+ item.name +'</option>');
                                 }); 
          }
   })  
    }


   
        


      
    })
   })

  </script>