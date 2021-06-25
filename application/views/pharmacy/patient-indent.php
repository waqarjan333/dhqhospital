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
      <div class="col-xs-2"><h4>Patient Indent Invoice</h4></div>
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
    
      <div class="col-md-1">
         <?php $invno=$inv_no->row_array(); ?>
      <!-- <label for="">Invoice No</label> -->
     <input type="text" style="width: 100px;" disabled="" id="inv_id" class="form-control input-sm" value="<?php echo $invno['receptNumber']+1; ?>">
    </div> 
     <div class="col-sm-3">
       <label for="">Select Product Type:</label>
                           <select name="product_cat" id="product_cat" class="select2">
               <option value="">All</option>
              <?php foreach ($getTypes as $row): ?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
              <?php endforeach; ?>
           </select>
      </div>    
       <div class="col-md-2" id="hepatitis">
     <label for="">Type:</label>
     <select name="test_type" id="test_type" class="select2">
     <option value="">Select Type</option>
      <option value="1">Hepatitis B</option>
      <option value="2">Hepatitis C</option>
     </select>
      
    </div>
    
    <div class="col-md-3 ">
      <label for="">Date:</label>
     <input type="text" class="form-control input-sm" id="inv_date" value="<?php echo date('Y-m-d') ?>" data-toggle="datepicker">
    </div>
   </div> 

   <div class="row" style="margin-top: 10px">
    <div class="col-md-2">
     <label for="">Patient Name</label>
    <input type="text" id="patient_name" placeholder="Enter Patient Name"  class="form-control input-sm" >
    </div>
    <div class="col-md-2">
     <label for="">Father Name</label>
    <input type="text" name="father_name" id="father_name" placeholder="Enter Patient Father Name" class="form-control input-sm">
    </div>
    <div class="col-md-2">
     <label for="">ID Card</label>
    <input type="text" id="card" placeholder="Patient ID Card Number" class="form-control input-sm">
    </div>
     <div class="col-md-2">
     <label for="">Distric</label>
    <select name="distric" class="select2 form-control" id="distric">
      <option value="Dir Lower">Dir Lower</option>
      <option value="Dir Upper">Dir Upper</option>
      <option value="Malakand">Malakand</option>
    </select>
    </div>
    <div class="col-md-2">
     <label for="">Mobile No</label>
    <input type="text" id="mobile" placeholder="Patient Mobile Number" class="form-control input-sm">
    </div>
      <div class="col-md-2">
     <div class="form-group">
    <label for="gander">Gander</label>
    <select name="" id="gander" style="height:30px !important; " class="form-control input-sm">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
  </div>
    </div>
        
   </div>
   <div class="row" id="test">
     <div class="col-md-10">
      <label><strong>Test :</strong></label>
    <select  multiple="" name="test[]" class="select2"  style="width:80%">
     <option value="1">SGPT</option>
    <option value="2">ALT</option>
    <option value="3">Platelets</option>
    <option value="4">HB</option>
    <option value="5">TLC</option>
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
         <td width="2%">1</td>
         <td width="38%"><a class="cut"><span class="fa fa-minus"></span></a><select name="" class="select2 item" id="item" required="required" style="width:100%">
          <option value="">Select Medicine</option>
      
         </select></td>
         <td width="7%"><input type="text" id="qty" min="0" placeholder="Quantity" data-id="1" class="form-control qty"></td>
         <td width="4%"><input type="text" id="r_qty" class="form-control r_qty1" readonly="" value=""></td>
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
  </section>
  <script src="<?php echo base_url('application/views/pharmacy/pharmacy.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/arrow-table.js') ?>"></script>
  <script src="<?php echo base_url('assets/sweetalert.js') ?>"></script>
  <script src="<?php echo base_url('assets/jquery-confirm.js') ?>"></script>
<script type="text/javascript">
    $(function () {
        $("#card").on('keypress',function (e) {
            // var isValid = false;
            var regex = /^[0-9-+()]*$/;
          var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
          if (regex.test(str)) {
             return true;
          }
          e.preventDefault();
          return false;
            // $("#spnError").css("display", !isValid ? "block" : "none");
            // return isValid;
        });

        $(document).on('keyup','.qtys',function(e){
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

    });
</script>
  
  <script>
    $(document).ready(function($) {
      
      var med_id='';
fetchProduct(med_id);

      $('[data-toggle="tooltip"]').tooltip(); 
       $('#print').prop('disabled', true);
       $('#test').hide();
       $('#hepatitis').hide();

       //Close Page
       $('#close').click(function(){
        window.location.href='<?php echo base_url('Pharmacy/'); ?>';
       })

       //New Page Reload
        $('#new').click(function(){
              location.reload();
       })
       //Fetch Medicine By Type
       $(document).on('change','#product_cat',function(){
        var med_id=$('#product_cat').val();
           $.ajax({
         url:"<?php echo base_url('Pharmacy/fetch_recept_by_type') ?>",
         method:"POST",
         data:{med_id:med_id},
         success:function(data)
         {
          $('#inv_id').val('');
            
               $('#inv_id').val(data);
                                      
                                       

         }        
       })
        });//Fetch Medicine by type end here

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

       $('#type').on('change',function(){
          var value=$(this).val()   
          if(value==3)
          {
            $('#test').hide();
          } 
          else{
            $('#test').show();
          }    
       })
         $("#item").on('change',function(){
        // alert()
            var id=$(this).val();
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
            
        }) //GET BATCH NUMBER FUNCTION END HERE 
          
    });
  </script>
  <script>
   $(document).ready(function() {
    // alert()

 $('[data-toggle="datepicker"]').datepicker({
           format: 'yyyy-mm-dd'
        }); 
    var n=1
    $('.hover').popover({
     title :'My Title',
     html :'My Content',
     trigger:'hover',
     placement :'bottom'
   });
    
    // GET BATCH NUMBER START HERE
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

        //ADD NEW ROW FUNCTION START HERE
         function add_new_row()
          {
                n=n+1;
               var row='<tr style="padding-top:-20px">'+
                '<td width="2%">'+n+'</td>'+
                '<td width="35%"><a class="cut" id="remove"><span class="fa fa-minus"></span></a><select name="" class="select2 product'+n+' item" id="products" style="width:100%" data-id="'+n+'">'+
                '<option value="">Select Medicine</option>'+
                '<td width="7%"><input type="text" id="qty'+n+' row_qty" placeholder="Quantity" data-id="'+n+'" class="form-control qty qtys"></td>'+
                '<td width="5%"><input type="text" class="form-control r_qty'+n+'" readonly="" value="" id="r_qty'+n+'"></td>'+
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
               fetchProduct(med_id);         
          
           } //ADD NEW FUNCTION ROW END HERE 


           //ADD ROW FUNCTION
            $('.add').on('click',function(){
              var item=$('#item').val();
              var patientName=$('#patient_name').val();
 
    if(patientName ==''){
  var message="Fill Patient Name Field Please";
   error(message);
   // e.preventDefault();
  }
  

    // var field = [
    //       '.item', '.qty'
    //     ];
    //     $($('.item').data('select2')).css('background-color', 'red');

    //     var flag = false;
    //     for(var i = 0; i < field.length; i++) {
    //       var ele = $.trim($(tr).find(field[i]).val());
    //       if(!ele.length) {
    //         flag = true;
    //         // var message='Item & Quantity Field Required';
    //         // error(message);
    //         // break;
    //         $(tr).find(field[i]).addClass('error');
    //       } else {
    //         $(tr).find(field[i]).removeClass('error');
    //       }
    //     }
    //     if (!flag) {
    //     add_new_row()
    //  }
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


      $('#patient_name').on('focus',function(){
        $('#patient_name').css({'border':'','border-style':''});
      })
      // INSERT DATA FUNCTION

   $('#save').click(function(e){
    var save_status=1;
      save_invoice(save_status,e);

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

   function save_invoice(save_status,e)
   {
    console.log(save_status);
     var inv_id=$('#inv_id').val();
    var test_type=$('#test_type').val();
    var advisor=$('#advisor').val();
    var inv_date=$('#inv_date').val();
    var patient_name=$('#patient_name').val();
    var father_name=$('#father_name').val();
    var card=$('#card').val();
    var mobile=$('#mobile').val();
    var gander=$('#gander').val();
    var distric=$('#distric').val();
    var med_type=$('#product_cat').val();
  var item_name = [];
  var item_qty = [];
  var item_batch = [];
  var item_expiry = [];
  var item_comment = [];
  if(patient_name==''){
   // alert() 
   $('#patient_name').css({'border':'3px solid red','border-style':'dashed'});
   
   e.preventDefault();
  }  
  

  else if(advisor ==''){
   // alert() 
   var message="Advisor Required";
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
  $('.batch').each(function(){
   item_batch.push($(this).text());
   // console.log(item_name)
  });
    $('.expiry').each(function(){
   item_expiry.push($(this).text());
   // console.log(item_name)
  });
   $('.comment').each(function(){
   item_comment.push($(this).val());
   // console.log(item_name)
  });
  $.ajax({
   url:"<?php echo base_url('Pharmacy/save_invoice') ?>",
   method:"POST",
   data:{inv_id:inv_id,test_type:test_type,advisor:advisor,inv_date:inv_date,patient_name:patient_name,father_name:father_name,card:card,mobile:mobile,
         gander:gander,item_name:item_name,item_qty:item_qty,item_batch:item_batch,item_expiry:item_expiry,item_comment:item_comment,distric:distric,med_type:med_type},
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
