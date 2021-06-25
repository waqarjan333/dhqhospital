 <link rel="stylesheet" href="<?php echo base_url('assets/pharmacy/style.css') ?>">
 <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css') ?>">
 <link rel="stylesheet" href="<?php echo base_url('assets/jquery-confirm.css') ?>">
  <section class="content">
        <style>
      .error{
    border: 1px solid red !important;
    transition: border-color .25s ease;
}
    </style>
   <div class="info">
    <div class="row">
      <div class="col-xs-2"><h4>Unit Indent Invoice</h4></div>
      <div class="col-xs-6 col-xs-offset-2" >
  
                  <button type="button" class="btn btn-info" name="new" id="new" value="New"><i class="fa fa-plus"> New</i></button>   
                  <button type="button" class="btn btn-default" name="save" id="save" value="Save"><i class="fa fa-save"> Save</i></button>           
                <button type="button" onclick="printContent();" class="btn btn-default" name="submit" id="print" value="Print"><i class="fa fa-print"> Print</i></button>
                <button type="button" class="btn btn-default" name="submit" value="" id="saveandnew"><i class="fa fa-save"> Save & New</i></button>
            </div>
            <div class="col-xs-2">
              <i class="fa fa-close fa-2x" id="close" style="color: darkred;float: right;padding-top: 4px;padding-right: 3px;cursor: pointer;" aria-hidden="true"></i>
            </div>
    </div>
    </div>
   <div class="well">
               
             
   <div class="row">
    <form action="" class="simple-form form-inline invoice_form" id="example_form">
    
      <div class="col-md-2">
         <?php 
         date_default_timezone_set('Asia/Karachi');
         $invno=$inv_no->row_array(); ?>
      <label for="">Recept #</label>
     <input type="text" style="width: 100px;" disabled="" id="inv_id" class="form-control input-sm" value="<?php echo $invno['receptNumber']+1; ?>">
    </div>       
    <div class="col-md-3">
     <label for="">Unit Indent:</label>
     <select name="indent_type" id="indent_type" class="select2 indent_type">
     <option value="" selected="">Select Unit Indent Type</option>
      <?php foreach($unit_ident->result() as $row){ ?>
      <option value="<?php echo $row->id ?>"><?php echo $row->dep_name ?></option>
    <?php } ?>
     </select>
    </div>
     <div class="col-sm-3">
       <label for="">Select Product Type:</label>
                           <select name="product_cat" id="product_cat" class="select2">
             <option value="">Product Category</option>
              <?php foreach ($getTypes as $row): ?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
              <?php endforeach; ?>
           </select>
      </div>
    <div class="col-md-3 ">
      <label for="">Date:</label>
     <input type="text" class="form-control input-sm" id="inv_date" readonly="" value="<?php echo date('Y-m-d h:i A') ?>" >
    </div>
   </div> 

   <div class="row" style="margin-top: 10px">
    <div class="col-md-2">

     <label for="">Unit Name</label>
     <select name="unit_name" data-id="unit_name" id="unit_name" class="select2 add_type" required="">
      <option value="">Select Unit</option>
      <option value="add_new">Add New</option>
      <?php foreach($unit_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
    <?php } ?>
     </select>
    </div>
    <div class="col-md-2">
     
     <label for="">Consulted Specialist</label>
     <select name="cons_specailist" id="cons_specailist" data-id="cons_specailist" class="select2 add_type" required="">
      <option value="">Select Consulted Specialist</option>
      <option value="add_new">Add New</option>
      <?php foreach($consult_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
    <?php } ?>
     </select>
    </div>
    <div class="col-md-2">
    <label for="">Store Keeper</label>
     <select name="store_keeper" id="store_keeper" data-id="store_keeper" class="select2 add_type" required="">
      <!-- <option value="add_new">Add New</option> -->
      <?php foreach($storkeeper_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
    <?php } ?>
     </select>
    </div>
     <div class="col-md-2">
     <label for="">Ward Incharge</label>
    <select name="incharge" class="select2 form-control add_type" data-id="ward_incharge" id="incharge">
      <option value="">Select Ward Incharge</option>
      <option value="add_new">Add New</option>
    <?php foreach($ward_incharge_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
    <?php } ?>    </select>
    </div> 
    <div class="col-md-2">
     <label for="">MS / DMS</label>
    <select name="dms" class="select2 form-control" id="dms">
    <?php foreach($issue_from_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
    <?php } ?>  
    </select>
    </div>
        
   </div>
   <!-- Invoice Date row   -->
<!--    <div class="row ">

    </div> -->

    <!-- Invoice Body -->
    <div class="row invoice_body" style="margin-top: 10px !important;">
     <div class="col-md-12" style="height: 600px;overflow: auto; ">
      <table class="table table-condensed" id="invoicetable" style="border-collapse: collapse;">
       <thead >
        <tr id="table-head">
         <th></th>
        <th>Item</th>
        <th>Quantity</th>
        <th></th>
        <th>Batch No</th>
        <th>Expiry</th>
        <th>Comment</th>
        <th></th>
        </tr>
       </thead>
       
       <tbody id="inv_detail">
        <tr >
         <td width="5%"><span class="fa fa-star star hover"></span></td>
         <td width="35%"><a class="cut"><span class="fa fa-minus"></span></a><select name="item" class="select2 item" id="item" required="required" style="width:100%">
         </select></td>
         <td width="7%"><input type="text" id="qty"  placeholder="Quantity" data-id="0" class="form-control qty qtyies"></td>
         <td width="5%"><input type="text" id="r_qty" class="form-control" readonly="" value=""></td>
         <td width="10%" id="batch_col"><select name="" id="batch" class="form-control batch" style="height: 30px !important;">
         <td width="10%" id=""><select name="" id="expiry" class="form-control expiry" style="height: 30px !important;">
          
         </select></td>
         
         <td width="35%"><input type="text" id="comment" class="form-control comment" placeholder="Enter comment here"></td>
         
        </tr> 
            
       </tbody>
      </form>
      </table>
      <a class="add"><span class="fa fa-plus"></span></a>
      
     </div>
    </div>
   </div>
   <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form class="form-horizontal" id="submitProductForm"  method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-plus"></i> Add Unit Name</h4>
        </div>

        <div class="modal-body" style="max-height:450px; overflow:auto;">

          <div id="add-product-messages"></div>
                         
          <p id="success_msg"></p>
          <div class="form-group">
            <label for="productName" class="col-sm-3 control-label">Name: </label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" style="text-transform: capitalize;" id="type_name" placeholder="Type Name" name="productName" autocomplete="off">
            </div>
          </div> <!-- /form-group-->      

                                           
                                           
        </div> <!-- /modal-body -->
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
          
          <button type="button"  class="btn btn-primary" id="create" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
        </div> <!-- /modal-footer -->       
      </form> <!-- /.form -->      
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div>
  </section>
  <script src="<?php echo base_url('application/views/pharmacy/pharmacy.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/arrow-table.js') ?>"></script>
  <script src="<?php echo base_url('assets/sweetalert.js') ?>"></script>
  <script src="<?php echo base_url('assets/jquery-confirm.js') ?>"></script>

  
  <script>
    $(document).ready(function($) {
 
      $('[data-toggle="tooltip"]').tooltip(); 
       $('#print').prop('disabled', true);

      
        $(document).on('change','.add_type',function(){
          var type=$(this).data('id');
          var title=$(this).val();
           // alert(type);
             if(title=="add_new")
            {
            // $('.modal-title').html('title');
            $('.modal').modal('show');  
            }
            $('#success_msg').hide();
            $('#create').on('click',function(){
    var value=$('#type_name').val();

    if(value=='')
    {
      $('#success_msg').html('Not Be Empty').css('color','red').fadeToggle(2000).fadeOut(2000);
      $('#success_msg').show();
    }
    else{
      $.ajax({
        url:'<?php echo base_url('UnitIndent/add_unit') ?>',
        method:'POST',
        data:{value:value,type:type},
        success:function($data)
        {
          if($data==false)
          {
           $('#success_msg').html('Already Exist').css('color','red').fadeToggle(2000).fadeOut(2000);     
          }
          else if($data==true){
           $('#success_msg').html('Success Fully Added').css('color','green').fadeToggle(2000).fadeOut(2000);
           all_region(); 
          }
          
        
        }
      })
    }
  })
        })
       //Close Page
       $('#close').click(function(){
        window.location.href='<?php echo base_url('Pharmacy/'); ?>';
       })

         $('#new').click(function(){
              location.reload();
       })
       //Fetch Medicine By Type
       $(document).on('change','#indent_type',function(){
        // alert()
      
        var unit_id=$(this).val();
       
          //Fetch Recept Number of Every Product Type
           $.ajax({
         url:"<?php echo base_url('UnitIndent/fetch_recept_by_indent_type') ?>",
         method:"POST",
         data:{unit_id:unit_id},
         success:function(data)
         {
          $('#inv_id').val('');
            
               $('#inv_id').val(data);
                                      
                                       

         }        
       })
        });//Fetch Medicine by type end here


       
         $("#item").on('change',function(){
        // alert()
            var id=$(this).val();
             var items=[];
            var store_item=items.push(id);
             localStorage.setItem("item_id",store_item);
            // localStorage.setItem('item_id',1);
            // alert(id)
              $.ajax({
                               url:"<?php echo base_url('Product/fetch_item_batch') ?>",
                               method:"POST",
                               dataType:'json',
                               data:{id:id},
                               success:function(data)
                               {
                                  $('#batch').html('');

                                  $.each(data,function(index,item){
                                     $('#batch').append('<option value="'+ item.id+'">'+ item.batch_no +'</option>');
                                     $('#expiry').append('<option value="'+ item.id+'">'+ item.expiry +'</option>');
                                 });                              
                                                             

                               }

                         });
              //Fetch Quantity of each Product
                 $.ajax({
                               url:"<?php echo base_url('Product/fetch_product_qty') ?>",
                               method:"POST",
                               data:{id:id},
                               success:function(data)
                               {
                                     $('#r_qty').val(data); 

                               }

                         });
            
        }) //GET BATCH NUMBER FUNCTION END HERE

        
 $(document).on("change", "#products", function() {
        // alert()
            var id=$(this).val();
            var term = $(this).data('id');
              $.ajax({
                               url:"<?php echo base_url('Product/fetch_item_batch') ?>",
                               method:"POST",
                               dataType:'json',
                               data:{id:id},
                               success:function(data)
                               {
                                  $('#batch'+term).html('');

                                  $.each(data,function(index,item){
                                     $('#batch'+term).append('<option value="'+ item.id+'">'+ item.batch_no +'</option>');
                                     $('#expiry'+term).append('<option value="'+ item.id+'">'+ item.expiry +'</option>');
                                 });                              
                                                             

                               }

                         });
              //Fetch Quantity of each Product
                 $.ajax({
                               url:"<?php echo base_url('Product/fetch_product_qty') ?>",
                               method:"POST",
                               data:{id:id},
                               success:function(data)
                               {
                                      $('#r_qty'+term).val(data); 

                               }

                         });
            
            // $('select option:selected').prop('disabled', true);
        }) //GET BATCH NUMBER FUNCTION END HERE 

  $(document).on('keyup','.qtyies',function(e){
        var id=$(this).data('id');
        var r_qty=$('#r_qty'+id).val();
        var qty=$('#qty'+id).val();
        // alert()
        if(e.keyCode!=8)
         {
         var qty=$(this).val();
            
         var r_qty=$('#r_qty').val();
         if(Number(qty)>Number(r_qty) && r_qty>0)
         {
             Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Quantity Will Not Be Greater Then '+r_qty
                 });
         $(this).val(''); 
         // $('#row_qty'+id).val('');  

         }
         else if(r_qty<1){
             Swal.fire({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Zero Quantity in Stock'
                     });
               // $('#row_qty'+id).val('');
             $(this).val(''); 
         }
        }
        
      }) 
       $(document).on('keyup','.qtys',function(e){
        var id=$(this).data('id');
        var r_qty=$('#r_qty'+id).val();
        var qty=$('#qty'+id).val();
        // alert()
        if(e.keyCode!=8)
         {
         var qty=$(this).val();
            
         var r_qty=$('#r_qty'+id).val();
         if(Number(qty)>Number(r_qty) && r_qty>0)
         {
             Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Quantity Will Not Be Greater Then '+r_qty
                 });
         $(this).val(''); 
         // $('#row_qty'+id).val('');  

         }
         else if(r_qty<1){
             Swal.fire({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Zero Quantity in Stock'
                     });
               // $('#row_qty'+id).val('');
             $(this).val(''); 
         }
        }
        
      })
          
    });
  </script>
  <script>
   $(document).ready(function() {
    // alert()
     var med_id='';
fetchProduct(med_id);
 $('[data-toggle="datepicker"]').datepicker({
           format: 'yyyy-mm-dd'
        }); 
    var n=1;
    $('.hover').popover({
     title :'My Title',
     html :'My Content',
     trigger:'hover',
     placement :'right'
   });
    
       function error(message)
  {
        $.confirm({
    title: 'Warning',
    icon:'fa fa-warning',
    animation:'rotate',
    type: 'orange',
    typeAnimated:true,
    content: message,
    autoClose: 'OkAction|1500',
    buttons: {
        OkAction: function () {
        }
    }
});
  }
    // GET BATCH NUMBER START HERE
   

        //ADD NEW ROW FUNCTION START HERE
         function add_new_row()
          {
                n=n+1;
               var row='<tr style="padding-top:-20px">'+
                '<td width="5%"><span id="popover" class="fa fa-star star hover"></span></td>'+
                '<td width="35%"><a class="cut" id="remove"><span class="fa fa-minus"></span></a><select name="" class="select2 product'+n+' item" id="products" style="width:100%" data-id="'+n+'">'+
                '</select></td>'+
                '<td width="7%"><input type="text" placeholder="Quantity" data-id="'+n+'" id="qty'+n+'" class="form-control qty qtys"></td>'+
                '<td width="5%"><input type="text" class="form-control" readonly="" value="" id="r_qty'+n+'"></td>'+
                '<td width="10%" id="batch_col"><select name="" id="batch'+n+'" class="form-control batch" style="height: 30px !important;">'+
                '<td width="10%" id=""><select name="" id="expiry'+n+'" class="form-control expiry" style="height: 30px !important;">'+
                
                '<td width="35%"><input type="text" id="comment" class="form-control comment" placeholder="Enter comment here"></td>'+
                    '<td><span style="cursor: pointer;font-size:15px" type="button" id="remove"><i class="fa fa-trash"></></span></td>'+

            '</tr>';

                $(this).closest('select').find(".select2").each(function(index)
                  {
                      $(this).select2('destroy');
                  }); 

               $('#inv_detail').append(row);
               $("select.select2").select2({
                theme: "classic"
                      });  

            var med_id=$('#product_cat').val();
            var no=n;
          fetchProducts(med_id,no);            
          
           } //ADD NEW FUNCTION ROW END HERE 


           //ADD ROW FUNCTION
            $('.add').on('click',function(){

               var supplier=$('#indent_type').val();
               var unit_name=$('#unit_name').val();
               var cons_specailist=$('#cons_specailist').val();
               var incharge=$('#incharge').val();
               if(supplier==''){
    var message="Indent Type Required";
   error(message);
   // e.preventDefault();

  }
  else if(unit_name=='')
  {
      var message="Unit Name Required";
   error(message);
  }
    else if(cons_specailist=='')
  {
      var message="Consultant Specailist Required";
   error(message);
  }
    else if(cons_specailist=='')
  {
      var message="Consultant Specailist Required";
   error(message);
  }
    else if(incharge=='')
  {
      var message="Incharge Required";
   error(message);
  }
   else{
          $('table > #inv_detail  > tr').each(function(index, row) { 
 tr =  row;
// console.log(row);
});

    var field = [
          '.item', '.qty'
        ];
        $($('.item').data('select2')).css('background-color', 'red');

        var flag = false;
        for(var i = 0; i < field.length; i++) {
          var ele = $.trim($(tr).find(field[i]).val());
          if(!ele.length) {
            flag = true;
            $(tr).find(field[i]).addClass('error');
          } else {
            $(tr).find(field[i]).removeClass('error');
          }
        }
        if (!flag) {

        add_new_row()
     }
  }
      
    }); //ADD ROW FUNCTIN END HERE    var med_id=$('#product_cat').val();
   $('#product_cat').on('change',function(){
     $('.item').html('');

    var med_id=$('#product_cat').val();
    fetchProduct(med_id);     
  })


  function fetchProduct(med_id)
  {
    $.ajax({
         url:"<?php echo base_url('Product/fetch_item_by_type') ?>",
         method:"POST",
         data:{med_id:med_id},
         success:function(data)
         {
            
               // $('.item').append(data);
             $(document).find('.item').append(data);                         
                                       

         }        
       })
  }  
  function fetchProducts(med_id,no)
  {
    $.ajax({
         url:"<?php echo base_url('Product/fetch_item_by_type') ?>",
         method:"POST",
         data:{med_id:med_id},
         success:function(data)
         {
            
               // $('.item').append(data);
             $(document).find('.product'+n).append(data);                         
                                       

         }        
       })
  } 



        //REMOVE FUNCTION START HERE    
      $(document).on('click', '#remove', function () {
           $(this).closest('tr').remove();
          //return false;
          // alert();
         
          n=n-1;
        }); //REMOVE ROW FUNCTIN END HERE


      $('#indent_type').on('focus',function(){
        $('#indent_type').css({'border':'','border-style':''});
      })
      // INSERT DATA Findent_typeUNCTION

   $('#save').click(function(){
      save_invoice();

 }); //INSERT DATA FUNCTION HERE

  //Error Function
  function error(message)
  {
        $.confirm({
    title: 'Warning',
    icon:'fa fa-warning',
    animation:'rotate',
    type: 'orange',
    typeAnimated:true,
    content: message,
    autoClose: 'OkAction|1500',
    buttons: {
        OkAction: function () {
        }
    }
});
  }

   function save_invoice()
   {
     var inv_id=$('#inv_id').val();
    var inv_date=$('#inv_date').val();
    var indent_type=$('#indent_type').val();
    var unit_name=$('#unit_name').val();
    var cons_specailist=$('#cons_specailist').val();
    var store_keeper=$('#store_keeper').val();
    var ward_incharge=$('#incharge').val();
    var dms=$('#dms').val();
  var item_name = [];
  var item_qty = [];
  var item_batch = [];
  var item_expiry = [];
  var item_comment = [];
  if(indent_type ==''){
   // alert() 
   var message="Indent Type Required";
   error(message);
   e.preventDefault();
  }

  else if(unit_name ==''){
   // alert() 
   var message="Unit Name Required";
   error(message);
   e.preventDefault();
  }
  else{

  $('.item').each(function(){
   item_name.push($(this).val());
    console.log(item_name)
  });
   $('.qty').each(function(){
   item_qty.push($(this).val());
   // console.log(item_name)
  });
  $('.batch option:selected').each(function(){
   item_batch.push($(this).text());
   // console.log(item_name)
  });
    $('.expiry option:selected').each(function(){
   item_expiry.push($(this).text());
   // console.log(item_name)
  });
   $('.comment').each(function(){
   item_comment.push($(this).val());
   // console.log(item_name)
  });
  $.ajax({
   url:"<?php echo base_url('UnitIndent/save_invoice') ?>",
   method:"POST",
   data:{inv_id:inv_id,inv_date:inv_date,unit_name:unit_name,cons_specailist:cons_specailist,store_keeper:store_keeper,ward_incharge:ward_incharge,dms:dms, item_name:item_name,item_qty:item_qty,item_batch:item_batch,item_expiry:item_expiry,item_comment:item_comment,indent_type:indent_type},
   success:function(data){
    console.log(data);
    localStorage.setItem("inv_id",data);

    $('#print').prop('disabled', false);
   const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  width: 300,
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
   }
  });
}
   }

   $(document).on('click','#saveandnew',function(){
    $('#print').prop('disabled', true);
    var f=$('#med_type').val();
   $('#example_form')[0].reset();
   $(".select2").val('');
      $('#med_type').val(f);
   })
   });
  

  

  </script>
  <script>
    //PRINT INVOICE FUNCTION START HERE
function printContent(id){ 
      var inv_id=localStorage.getItem("inv_id");
      // console.log(inv_id);
     $.ajax({
            type: "POST",
            url: '<?php echo base_url('UnitIndent/print_suplier_invoice') ?>',
            data: {inv_id:inv_id},
            type: 'POST',
            success: function( response ) {
       


      var contents = response;


      var idname = name;
 

            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><title></title>');
           
      // frameDoc.document.write('<style>table {  border-collapse: collapse;  border-spacing: 0; width:100%; margin-top:20px;} .table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{ padding:8px 18px;  } .table-bordered, .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {     border: 1px solid #e2e2e2;} </style>');
       
        // your title
      frameDoc.document.title = "Print Content with ajax in php";
      
      
        frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false; 

      
        
        
            }
        });
  
} //PRINT INVOICE FUNCTION END HERE
</script>
