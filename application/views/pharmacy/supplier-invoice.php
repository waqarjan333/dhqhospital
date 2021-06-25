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
      <div class="col-xs-2"><h4>Supplier Invoice</h4></div>
      <div class="col-xs-6 col-xs-offset-2" >
  
                  <button type="button" class="btn btn-default" name="reset" id="reset" value="New"><i class="fa fa-plus"> New</i></button> 
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
    <div class="col-md-12">
      <label for="">Statement</label>
      <textarea name="" id="statement" cols="100" class="form-control" rows="4">
        As per the selection of the end-users and on the approval by the District Purchase Committee, you are hereby directed to supply the following Medicines/other Items for the use in DHQ Hospital Upper Dir, according to the agreement with the Govt: Health Deptt: MCC KP Peshawar on the approved rateâ€™s for the year 2018-019 under the letter No: , dated: 12/01/2020.<br>
<strong>Note:</strong>   All the codel formalities/agreement and other rules and regulations must be observed strictly.<br>
Shorts expiry/payment of bilty of medicines/other Item charges will be the responsibility of the concerned firms/suppliers.</textarea>
    </div>
  </div>
   <!-- Invoice Date row   -->
<!--    <div class="row ">

    </div> -->

    <!-- Invoice Body -->
    <div class="row invoice_body" style="margin-top: 10px !important;">
     <div class="col-md-12" style="height: 500px;overflow: auto; ">
      <table class="table table-condensed" id="invoicetable" style="border-collapse: collapse;">
       <thead >
        <tr id="table-head">
         <th></th>
        <th>Item</th>
        <th>Quantity</th>
        <th>Batch No</th>
        <th>Expiry</th>
        <th>Comment</th>
        <th></th>
        </tr>
       </thead>
       
       <tbody id="inv_detail">
        <tr class="inv_row">
         <td width="5%">1</td>
         <td width="35%"><a class="cut"><span class="fa fa-minus"></span></a><select name="" required="" class="select2 item" id="item" style="width:100%" >
          <option value="" disabled="" selected>Select Medicine</option>
            
         </select></td>
         <td width="7%"><input type="number" id="qty" min="0" placeholder="Quantity" data-id="0" class="form-control qty"></td>
         <td width="10%"><input type="text" class="batch_no" name="batch_no" placeholder="Enter Batch Number">
         <td width="10%" id=""><input type="text" name="expiry" readonly="readonly" class="expiry" id="expiry" data-toggle="datepicker" ></td>
         
         <td width="35%"><input type="text" id="comment" class="comment" placeholder="Enter comment here"></td>
        
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
     <div class="col-md-3 col-md-offset-4" style="margin-top: 10px;">
       <table>
         <tr style=""><td>Total Quantity</td><td class="sum_qty"></td></tr>
       </table>
     </div>
    </div>
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
      
      // $('#supplier_type').on('change',function(){
      //     alert()
      // })
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
                '<td width="7%"><input type="number" min="0" placeholder="Quantity" data-id="'+n+'" class="form-control qty"></td>'+
                '<td width="10%"><input type="text" class="batch_no" name="batch_no" placeholder="Enter Batch Number">'+
                '<td width="10%" id=""><input type="text" name="expiry" id="expiry" class="expiry" data-toggle="datepicker" ></td>'+
                
                '<td width="35%"><input type="text" id="comment" class="comment" placeholder="Enter comment here"></td>'+
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
              var cat=$('#product_cat').val();
              var supplier=$('#supplier_type').val();
  if(supplier==''){
    var message="Supplier Type Required";
   error(message);
   // e.preventDefault();

  }  
  else if(cat ==''){
   var message="Product Type Required";
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
  var item_batch = [];
  var item_expiry = [];
  var item_comment = [];
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
  $('.batch_no').each(function(){
   item_batch.push($(this).val());
   // console.log(item_name)
  });
    $('.expiry').each(function(){
   item_expiry.push($(this).val());
   // console.log(item_name)
  });
   $('.comment').each(function(){
   item_comment.push($(this).val());
   // console.log(item_name)
  });
  $.ajax({
   url:"<?php echo base_url('SupplierInvoice/save_supplier_invoice') ?>",
   method:"POST",
   data:{inv_id:inv_id,inv_date:inv_date,supplier_type:supplier_type,vendor:vendor,product_cat:product_cat,subject_memo:subject_memo,statement:statement,item_name:item_name,item_qty:item_qty,item_batch:item_batch,item_expiry:item_expiry,item_comment:item_comment},
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
            url: '<?php echo base_url('Pharmacy/print_invoice') ?>',
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
