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
   <div class="info" style="margin-bottom: -10px">
    <div class="row" >
      <div class="col-xs-2"><h4>Supplier Order</h4></div>
      <div class="col-xs-6 col-xs-offset-2" >
  
                  <button type="button" class="btn btn-default btn-sm" name="reset" id="reset" value="New"><i class="fa fa-plus"> New</i></button> 
                  <button type="button" class="btn btn-default btn-sm" name="save" id="save" value="Save"><i class="fa fa-save"> Save</i></button>           
                <button type="button" onclick="printContent();" class="btn btn-default btn-sm" name="submit" id="print" value="Print"><i class="fa fa-print"> Print</i></button>
                <button type="button" class="btn btn-default btn-sm" name="submit" value="" id="saveandnew"><i class="fa fa-save"> Save & New</i></button>
            </div>
            <div class="col-xs-2">
              <i class="fa fa-close fa-2x" id="close" style="color: darkred;float: right;padding-top: 4px;padding-right: 3px;cursor: pointer;" aria-hidden="true"></i>
            </div>
    </div>
    </div>
   <div class="well">
               
             
   <div class="row">
    <form action="" class="simple-form form-inline invoice_form" id="example_form">
    
      <div class="col-md-1">
         <?php 
         date_default_timezone_set('Asia/Karachi');
         $invno=$inv_no->row_array(); ?>
      <label for="">Recept #</label>
     <input type="text" style="width: 100px;" disabled="" id="inv_id" class="form-control input-sm" value="<?php echo $invno['receptNumber']+1; ?>">
    </div>       
    <div class="col-md-2">
     <label for="">Select Supplier:</label>
     <select name="supplier_type" id="supplier_type" class="select2 supplier_type">
     <option value="" >Select Supplier Type</option>
      <?php foreach($supplier as $row){ ?>
                <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
              <?php } ?>
     </select>
    </div>
    <input type="hidden" value="" id="product_type_id">
       <div class="col-md-2">
     <label for="">Select Vendor:</label>
      <select name="vendor" id="vendor" class="select2">
                      <option value="">Select Vendor</option>
                      <option value="add_new">Add New</option>
                       <?php foreach($vendor->result() as $row){ ?>
      <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
    <?php } ?>
       </select>
    </div>
     <div class="col-sm-2">
       <label for="">Select Product Type:</label>
                           <select name="product_cat" id="product_cat" class="select2">
             <option value="">Product Category</option>
              <?php foreach ($getTypes as $row): ?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
              <?php endforeach; ?>
           </select>
      </div>

    <div class="col-md-1 ">
      <label for="">Date:</label>
     <input type="text" class="form-control input-sm" id="inv_date" readonly="" value="<?php echo date('Y-m-d h:i A') ?>" >
    </div>
    <div class="col-md-2 col-md-offset-1">
     <label for="">subject Memo</label>
    <input type="text" placeholder="Subject Memo" id="subject_memo" class="form-control input-sm" style="width: 100%;">
    </div>
   </div> 

   <div class="row" style="margin-top: 10px">
    <div class="col-md-9">
      <textarea name="" id="statement" cols="100" class="form-control" rows="3">
        As per the selection of the end-users and on the approval by the District Purchase Committee, you are hereby directed to supply the following Medicines/other Items for the use in DHQ Hospital Upper Dir, according to the agreement with the Govt: Health Deptt: MCC KP Peshawar on the approved rateâ€™s for the year 2018-019 under the letter No: , dated: 12/01/2020.<br>
<strong>Note:</strong>   All the codel formalities/agreement and other rules and regulations must be observed strictly.<br>
Shorts expiry/payment of bilty of medicines/other Item charges will be the responsibility of the concerned firms/suppliers.</textarea>
    </div>
    <div class="col-md-3" id="inv_stamp">
      <img src="<?php echo base_url('images/open_Stamp.png') ?>" height="100" alt="">
    </div>
  </div>
   <!-- Invoice Date row   -->
<!--    <div class="row ">

    </div> -->

    <!-- Invoice Body -->
    <div class="row invoice_body" >
     <div class="col-md-12" style="height: 500px;overflow: auto; ">
      <table class="table table-condensed" id="invoicetable" style="border-collapse: collapse;">
       <thead >
        <tr id="table-head">
         <th></th>
        <th>Item</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Discount(%)</th>
        <th>Sub Total</th>
        <th></th>
        </tr>
       </thead>
       
       <tbody id="inv_detail">
        <tr class="inv_row">
         <td width="5%">1</td>
         <td width="40%"><a class="cut"><span class="fa fa-minus"></span></a><select name="" required="" class="select2 item" id="item" style="width:100%" >
          <option value="" disabled="" selected>Select Medicine</option>
            
         </select></td>
         <td width="10%"><input  style="width: 100%" type="number" id="qty" min="0" placeholder="Quantity" data-id="0" class="form-control qty"></td>
         <td width="15%"><input style="width: 100%"  type="text" class="amount amt" name="amount" placeholder="Enter Amount Here">
         
         <td width="14%"><input style="width: 100%"  type="text" class="discount disc" name="discount" placeholder="Enter Discount in %">
         <td width="15%" id=""><input style="width: 100%"  type="text" name="sub_total" readonly="readonly" id="sub_total" class="sub_total"></td>
         <td width="2%"><input style="width: 100%"  type="hidden" class="total_amount" name="total_amount">
         <td width="2%"><input style="width: 100%"  type="hidden" class="before_disc_amount" name="before_disc_amount">
        
        </tr> 
            
       </tbody>
     <!--   <tfoot>
         <tr>
          <td></td>
          <td></td>
           <td>450</td>
           <td></td>
           <td></td>
           <td></td>
         </tr>
       </tfoot> -->
      </form>
      </table>
      <a class="add"><span class="fa fa-plus"></span></a>
      
     </div>
     <div class="col-md-4 col-md-offset-8" style="margin-top: 10px;">
       <table class="table-condensed" style="background-color: #E8F1F9">
         <tr style=""><td style="font-weight: bold;">Total Quantity</td ><td class="sum_qty"></td>
          <td style="font-weight: bold;">Sub Total:</td>
                <td><input type="text" readonly="" id="total" name="total" value="" class="form-control input-sm total"></td>

         </tr>
         <div class="row">
           <div class="col-md-12">
             <div class="col-md-4">
                <tr>
                

              </tr>
               <tr>
                <td style="font-weight: bold;">Discount:</td>
                <td><input type="text" readonly="" id="total_discount" name="total_discount" value="" class="form-control input-sm total_discount"></td>
                 <td style="font-weight: bold;">Net Amount:</td>
                <td><input type="text" readonly="" id="net_total" name="net_total" value="" class="form-control input-sm net_total"></td>

              </tr>
             </div>
           </div>
         </div>
       </table>
     </div>
    </div>
   </div>
     <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form class="form-horizontal" id="submitProductForm"  method="POST">
        <div class="modal-header">
          <button type="button" class="close" style="color: red;width: 40px;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Vendor</h4>
        </div>

        <div class="modal-body" style="max-height:450px; overflow:auto;">

          <div id="add-product-messages"></div>
                         
          <p id="success_msg"></p>
          <div class="form-group">
            <label for="productName" class="col-sm-3 control-label">Name </label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" style="text-transform: capitalize;" id="vendor_name" placeholder="Type Name" name="productName" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="Vendortype" class="col-sm-3 control-label">Vendor Type </label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8 ">
              <select name="vendor_type" id="vendor_type" style="height: 40px !important" required="" class="form-control">
     <option value="" >Select Supplier Type</option>
      <?php foreach($supplier as $row){ ?>
                <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
              <?php } ?>
     </select>
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
      
        $('#vendor').on('change',function(){
          var title=$(this).val();
           if(title=="add_new")
            {
            // $('.modal-title').html('title');
            $('.modal').modal({
               backdrop: 'static',
            keyboard: false
            });  
            }
              $('#success_msg').hide();
            $('#create').on('click',function(){
    var vendor_name=$('#vendor_name').val();
    var vendor_type=$('#vendor_type').val();

    if(vendor_name=='')
    {
      $('#success_msg').html('Not Be Empty').css('color','red').fadeToggle(2000).fadeOut(2000);
      $('#success_msg').show();
    }
    else{
      $.ajax({
        url:'<?php echo base_url('SupplierInvoice/add_vendor') ?>',
        method:'POST',
        data:{vendor_name:vendor_name,vendor_type:vendor_type},
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


           $(document).on("keyup",".amount",function(){
         var price=$('.qty').val();
         var qty=$(this).val();
        var amt=qty*price;
       $('.sub_total').val(amt);
       $('.before_disc_amount').val(amt);
          //  g_total();
          total();
     })
        $(document).on("keyup",".amounts",function(){
        var term=$(this).data('amount');
        var qty=$('#qty'+term).val();
        var price=$('#amount'+term).val();
        var amt=qty*price;
       $('#sub_total'+term).val(amt);
       $('#before_disc_amount'+term).val(amt);
          //  g_total();
          total();
     })

        $(document).on('keyup','.discounts',function(){
           var term=$(this).data('discount');
         var discount=$('#discount'+term).val()/100;
         var price=$('#amount'+term).val();
          var dec=price*discount;
           var net_amt=price-dec;
           var qty=$('#qty'+term).val();
           var total=qty*net_amt;
        $('#sub_total'+term).val(total.toFixed(2));
        // total();
      })

       $('.discount').on('keyup',function(){
         var discount=$('.discount').val()/100;
         var price=$('.amount').val();
          var dec=price*discount;
           var net_amt=price-dec;
           var qty=$('.qty').val();
           var total=qty*net_amt;
        $('.sub_total').val(total.toFixed(2));
        $('.total_amount').val(dec*qty);
              var dd=0;
      $('.total_amount').each(function(i,element){
          var des=$(this).val()-0;
          dd +=des;

      });
              var gg=0;
      $('.sub_total').each(function(i,element){
          var amt=$(this).val()-0;
          gg +=amt;

      });
    $('.net_total').val(gg);
    $('.total_discount').val(dd.toFixed(2));
      })




       $(document).on("keyup",".discounts",function(){
     var term = $(this).data('discount');
   
     var discount=$('#discount'+term).val()/100;
     var price=$('#amount'+term).val();
       var dec=price*discount;
     var net_amt=price-dec;
     var qty=$('#qty'+term).val();
      var total=qty*net_amt;
       $('#sub_total'+term).val(total.toFixed(2));
       $('#total_amount'+term).val(dec*qty);
        var dd=0;
      $('.total_amount').each(function(i,element){
          var des=$(this).val()-0;
          dd +=des;

      });
        var gg=0;
      $('.sub_total').each(function(i,element){
          var amt=$(this).val()-0;
          gg +=amt;

      });
    $('.net_total').val(gg);
    $('.total_discount').val(dd.toFixed(2))
    }) 

    function total()
    {
      var gg=bb=0;
      $('.sub_total').each(function(i,element){
          var amt=$(this).val()-0;
          gg +=amt;

      });

      $('.before_disc_amount').each(function(i,element){
          var bef=$(this).val()-0;
          bb +=bef;

      });
    $('.total').val(bb);
    $('.net_total').val(gg);

    }
    $(document).on("blur", ".qty", function() {
    var sum = 0;
    $(".qty").each(function(){
        sum += +$(this).val();
    });
    $(".sum_qty").text(sum);
});
      $('#reset').click(function(){
        // $("#supplier_type").val('0');
       location.reload();
        // alert()
      })

       //Close Page
       $('#close').click(function(){
        window.location.href='<?php echo base_url('Pharmacy/'); ?>';
       })
       //Fetch Medicine By Type
       $(document).on('change','#supplier_type',function(){
        // alert()
      
        var unit_id=$(this).val();
       
          //Fetch Recept Number of Every Product Type
           $.ajax({
         url:"<?php echo base_url('SupplierInvoice/fetch_recept_by_supplier_type') ?>",
         method:"POST",
         data:{unit_id:unit_id},
         success:function(data)
         {
          $('#inv_id').val('');
            
               $('#inv_id').val(data);
                                      
                                       

         }        
       })

           $('#vendor').html('');
    $.ajax({

         url:"<?php echo base_url('SupplierInvoice/fetchVendor') ?>",
         method:"POST",
         data:{unit_id:unit_id},
         success:function(data)
         {
            $('#vendor').append(data);
                                      
                                       

         }        
       })

        });//Fetch Medicine by type end here

       //Fetch Vendor Base on Supplier Type

 
          
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
    var n=1
    $('.hover').popover({
     title :'Qty',
     html :'10',
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
                '<td width="5%">'+n+'</td>'+
                '<td width="35%"><a class="cut" id="remove"><span class="fa fa-minus"></span></a><select name="" class="select2 product'+n+' item" id="products" style="width:100%" data-id="'+n+'">'+
                '<option value="">Select Medicine</option>'+
                 
                '</select></td>'+
                '<td width="7%"><input type="number" min="0" placeholder="Quantity" data-id="'+n+'" id="qty'+n+'" class="form-control qty"></td>'+
                '<td width="10%"><input type="text" style="width:100%" class="amounts amt" id="amount'+n+'" name="amount" data-amount="'+n+'" placeholder="Enter Amount Here">'+
                
                '<td width="15%"><input type="text" style="width:100%" class="discounts disc" id="discount'+n+'" data-discount="'+n+'" name="discount" placeholder="Enter Discount Here">'+
                '<td width="12%" id=""><input type="text" style="width:100%" name="sub_total" id="sub_total'+n+'" class="sub_total" ></td>'+
                '<td><span style="cursor: pointer;font-size:15px" type="button" id="remove"><i class="fa fa-trash"></></span></td>'+
                '<td width="2%"><input style="width: 100%"  type="hide" class="total_amount" id="total_amount'+n+'" name="total_amount" >'+
                '<td width="2%"><input style="width: 100%"  type="hidden" class="before_disc_amount" id="before_disc_amount'+n+'" name="before_disc_amount">'+

            '</tr>';

                $(this).closest('select').find(".select2").each(function(index)
                  {
                      $(this).select2('destroy');
                  }); 

               $('#inv_detail').append(row);
               $("select.select2").select2({
                theme: "classic"
                      });  

                  $('[data-toggle="datepicker"]').datepicker({
           format: 'yyyy-mm-dd'
        });         
          var med_id=$('#product_cat').val();
          fetchProduct(med_id);
           } //ADD NEW FUNCTION ROW END HERE 


           //ADD ROW FUNCTION
            $('.add').on('click',function(){
              // var item='';
  //             var qty='';
  //             $(".qty").each(function(){
  //           qty = +$(this).val();
  //         });
              var item=$('#item').val();
              var supplier=$('#supplier_type').val();
  if(supplier==''){
    var message="Supplier Type Required";
   error(message);
   // e.preventDefault();

  }  
  else if(qty ==''){
   var message="Select Qty First";
   error(message);
   // e.preventDefault();
  }
   else if(item ==''){
  var message="Select Item First";
   error(message);
   // e.preventDefault();
  }
  else{
      $('table > #inv_detail  > tr').each(function(index, row) { 
 tr =  row;
console.log(row);
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
          $(tr).find(field[i]).removeClass('error');
        add_new_row()
     }
  }


  
     
    }); //ADD ROW FUNCTIN END HERE

        //REMOVE FUNCTION START HERE    
      $(document).on('click', '#remove', function () {
           $(this).closest('tr').remove();
          //return false;
          // alert();
         
          n=n-1;
        }); //REMOVE ROW FUNCTIN END HERE


      // INSERT DATA Findent_typeUNCTION

   $('#save').click(function(e){
    var save_status=1;
      save_invoice(save_status,e);

 }); //INSERT DATA FUNCTION HERE

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

   function save_invoice(save_status,e)
   {
    console.log(save_status);
     var inv_id=$('#inv_id').val();
    var inv_date=$('#inv_date').val();
    var supplier_type=$('#supplier_type').val();
    var vendor=$('#vendor').val();
    var product_cat=$('#product_cat').val();
    var subject_memo=$('#subject_memo').val();
    var statement=$('#statement').text();
  var item_name = [];
  var item_qty = [];
  var amount = [];
  var sub_total = [];
  var discount = [];
  if(supplier_type ==''){
   // alert() 
   var message="Indent Type Required";
   error(message);
   e.preventDefault();
  }
  else{

  $('.item').each(function(){
   item_name.push($(this).val());
   // console.log(item_name)
  });
   $('.qty').each(function(){
   item_qty.push($(this).val());
   // console.log(item_name)
  });
  $('.amt').each(function(){
   amount.push($(this).val());
   // console.log(item_name)
  });
    $('.sub_total').each(function(){
   sub_total.push($(this).val());
   // console.log(item_name)
  });
   $('.disc').each(function(){
   discount.push($(this).val());
   // console.log(item_name)
  });
  $.ajax({
   url:"<?php echo base_url('SupplierInvoice/save_supplierOrder_invoice') ?>",
   method:"POST",
   data:{inv_id:inv_id,inv_date:inv_date,supplier_type:supplier_type,vendor:vendor,product_cat:product_cat,subject_memo:subject_memo,statement:statement,item_name:item_name,item_qty:item_qty,amount:amount,discount:discount,sub_total:sub_total},
   success:function(data){
    console.log(data);
    localStorage.setItem("inv_id",data);
    $('#inv_stamp').html('');
    $('#inv_stamp').html('<img src="<?php echo base_url('images/pending_Stamp.png') ?>" height="100" alt="">');
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
            url: '<?php echo base_url('SupplierInvoice/print_Ordernvoice') ?>',
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
