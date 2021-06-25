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
    <form action="" class="simple-form  invoice_form" id="example_form">
    
      <div class="col-md-2">
         <?php 
         date_default_timezone_set('Asia/Karachi');
?>
      <label for="">Recept #</label>
     <input type="text" style="width: 100px;" disabled="" id="inv_id" class="form-control input-sm" value="<?php echo $record[0]['receptNumber']; ?>">
    </div>
    <input type="hidden" value="<?php echo $record[0]['id']?>" id="edit_invid">       
    <div class="col-md-2">
     <label for="">Unit Indent:</label>
     <select name="indent_type" id="indent_type" class="select2 indent_type">
     <option value="" selected="">Select Unit Indent Type</option>
      <?php foreach($unit_ident->result() as $row){ ?>
      <option value="<?php echo $row->id ?>" <?php if($record[0]['indent_type']==$row->id){?> selected="" <?php } ?>><?php echo $row->dep_name ?></option>
    <?php } ?>
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
     <select name="unit_name" id="unit_name" class="select2" required="">
      <option value="">Select Unit</option>
      <?php foreach($unit_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>" <?php if($record[0]['unit_id']==$row->id){?> selected="" <?php } ?>><?php echo $row->name ?></option>
    <?php } ?>
     </select>
    </div>
    <div class="col-md-2">
     
     <label for="">Consulted Specialist</label>
     <select name="cons_specailist" id="cons_specailist" class="select2" required="">
      <option value="">Select Consulted Specialist</option>
      <?php foreach($consult_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>" <?php if($record[0]['unit_incharge']==$row->id){?> selected="" <?php } ?>><?php echo $row->name ?></option>
    <?php } ?>
     </select>
    </div>
    <div class="col-md-2">
    <label for="">Store Keeper</label>
     <select name="store_keeper" id="store_keeper" class="select2" required="">
      <?php foreach($storkeeper_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>" <?php if($record[0]['issuing_authority']==$row->id){?> selected="" <?php } ?>><?php echo $row->name ?></option>
    <?php } ?>
     </select>
    </div>
     <div class="col-md-2">
     <label for="">Ward Incharge</label>
    <select name="incharge" class="select2 form-control" id="incharge">
      <option value="">Select Ward Incharge</option>
    <?php foreach($ward_incharge_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>" <?php if($record[0]['invoice_reciever']==$row->id){?> selected="" <?php } ?>><?php echo $row->name ?></option>
    <?php } ?>    </select>
    </div> 
    <div class="col-md-2">
     <label for="">MS / DMS</label>
    <select name="dms" class="select2 form-control" id="dms">
    <?php foreach($issue_from_name->result() as $row){ ?>
      <option value="<?php echo $row->id ?>" <?php if($record[0]['issue_from']==$row->id){?> selected="" <?php } ?>><?php echo $row->name ?></option>
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
        <?php $i=0; foreach($record2 as $row){
          $i++;
             $query = $this->db->query("select * from item_batch where item_id=".$row->product);
            $batch = $query->result();
          ?>
        <tr >
         <td width="5%" class="s_no"><?php echo $i; ?></td>
         <td width="35%"><a class="cut"><span class="fa fa-minus"></span></a><select name="" class="select2 item" id="item" required="required" style="width:100%">
          <option value="">Select Medicine</option>
            <?php foreach ($items as $value) {
             
             ?>
          <option value="<?php echo $value->id ?>" class="item_list" <?php if($row->product==$value->id){?>selected="" <?php } ?>><?php echo $value->name; ?></option>
        <?php } ?>
         </select></td>
         <td width="7%"><input type="text" id="qty" value="<?php echo $row->quantity ?>" placeholder="Quantity" data-id="0" class="form-control qty"></td>
         <td width="5%"><input type="text" id="r_qty" class="form-control" readonly="" value=""></td>
          <td width="10%" id="batch_col"><select name="" id="batch" class="form-control batch" style="height: 30px !important;">
          <?php foreach ($batch as $row1) {?>
              <option value="<?php $row1->id ?>" <?php if($row1->batch_no==$row->batch_no){?> selected=""<?php } ?>><?php echo $row1->batch_no ?></option>
             <?php }?>
         </select></td>
         <td width="10%" id=""><select name="" id="expiry" class="form-control expiry" style="height: 30px !important;">
          <?php foreach ($batch as $row1) {?>
              <option value="<?php $row1->id ?>" <?php if($row1->item_id==$row->product){?> selected=""<?php } ?>><?php echo $row1->expiry ?></option>
             <?php }?>
         </select></td>
         
         <td width="35%"><input type="text" id="comment" class="form-control comment" value="<?php echo $row->comment ?>" placeholder="Enter comment here"></td>
         
        </tr> 
         <?php } ?>   
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

  
  <script>
    $(document).ready(function($) {
 
      $('[data-toggle="tooltip"]').tooltip(); 
       $('#print').prop('disabled', true);
      

       //Close Page
       $('#close').click(function(){
        window.location.href='<?php echo base_url('UnitIndent/show_IndentInvoices'); ?>';
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
    var n=$('.s_no:last').text();
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
                n=Number(n)+1;
               var row='<tr style="padding-top:-20px">'+
                '<td width="5%">'+n+'</td>'+
                '<td width="35%"><a class="cut" id="remove"><span class="fa fa-minus"></span></a><select name="" class="select2 product'+n+' item" id="products" style="width:100%" data-id="'+n+'">'+
                '<option value="">Select Medicine</option>'+
                 '<?php foreach( $items as $value){  ?>'+
                  '<option value="<?php echo $value->id ?>" ><?php echo $value->name; ?></option>'+
                  '<?php   } ?>'+
                '</select></td>'+
                '<td width="7%"><input type="text" placeholder="Quantity" data-id="'+n+'" class="form-control qty"></td>'+
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
      
    }); //ADD ROW FUNCTIN END HERE

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
    var inv_date=$('#inv_date').val();
    var indent_type=$('#indent_type').val();
    var unit_name=$('#unit_name').val();
    var cons_specailist=$('#cons_specailist').val();
    var store_keeper=$('#store_keeper').val();
    var ward_incharge=$('#incharge').val();
    var dms=$('#dms').val();
    var edit_invid=$('#edit_invid').val();
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
   // console.log(item_name)
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
   url:"<?php echo base_url('UnitIndent/updateIndentInvoice') ?>",
   method:"POST",
   data:{edit_invid:edit_invid,inv_id:inv_id,inv_date:inv_date,unit_name:unit_name,cons_specailist:cons_specailist,store_keeper:store_keeper,ward_incharge:ward_incharge,dms:dms, item_name:item_name,item_qty:item_qty,item_batch:item_batch,item_expiry:item_expiry,item_comment:item_comment,indent_type:indent_type},
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


setTimeout(function(){ window.location.href='<?php echo base_url('UnitIndent/show_IndentInvoices'); ?>'; }, 3000);

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
