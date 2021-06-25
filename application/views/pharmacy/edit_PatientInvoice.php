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
     <input type="text" style="width: 100px;" disabled="" id="inv_id" class="form-control input-sm" value="<?php echo $record[0]['receptNumber']; ?>">
    </div>
    <input type="hidden" value="<?php echo $record[0]['invoice_id']?>" id="edit_invid">     
       <div class="col-md-2" id="hepatitis">
     <label for="">Type:</label>
     <select name="test_type" id="test_type" class="select2">
     <option value="">Select Type</option>
      <option value="1">Hepatitis B</option>
      <option value="2">Hepatitis C</option>
     </select>
      
    </div>
    <div class="col-md-3">
     <div class="form-group">
       <label for="">Advise By:</label>
     <select name="advisor" id="advisor" class="select2" required="">
      <option value="">Select Advisor</option>
      <option value="raza" >Raza</option>
      <option value="saud" >Saud</option>
     </select>
     </div>
    </div>
    
    <div class="col-md-3 ">
      <label for="">Date:</label>
     <input type="text" class="form-control input-sm" id="inv_date" value="<?php echo date('Y-m-d') ?>" data-toggle="datepicker">
    </div>
   </div> 

   <div class="row" style="margin-top: 10px">
    <div class="col-md-2">
     <label for="">Patient Name</label>
    <input type="text" id="patient_name" placeholder="Enter Patient Name" value="<?php echo $record[0]['name']; ?>"  class="form-control input-sm" >
    </div>
    <div class="col-md-2">
     <label for="">Father Name</label>
    <input type="text" name="father_name" id="father_name" value="<?php echo $record[0]['f_name']; ?>" placeholder="Enter Patient Father Name" class="form-control input-sm">
    </div>
    <div class="col-md-2">
     <label for="">ID Card</label>
    <input type="text" id="card" placeholder="Patient ID Card Number" value="<?php echo $record[0]['id_card']; ?>" class="form-control input-sm">
    </div>
     <div class="col-md-2">
     <label for="">Distric</label>
    <select name="distric" class="select2 form-control" id="distric">
      <option value="Dir Lower" <?php if($record[0]['address']=='Dir Lower'){?> selected="" <?php } ?>>Dir Lower</option>
      <option value="Dir Upper" <?php if($record[0]['address']=='Dir Upper'){?> selected="" <?php } ?>>Dir Upper</option>
      <option value="Malakand" <?php if($record[0]['address']=='Malakand'){?> selected="" <?php } ?>>Malakand</option>
    </select>
    </div>
    <div class="col-md-2">
     <label for="">Mobile No</label>
    <input type="text" id="mobile" value="<?php echo $record[0]['mobile_no'] ?>" placeholder="Patient Mobile Number" class="form-control input-sm">
    </div>
      <div class="col-md-2">
     <div class="form-group">
    <label for="gander">Gander</label>
    <select name="" id="gander" style="height:30px !important; " class="form-control input-sm">
      <option value="Male" <?php if($record[0]['address']=='Male'){?> selected="" <?php } ?>>Male</option>
      <option value="Female" <?php if($record[0]['address']=='Female'){?> selected="" <?php } ?>>Female</option>
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
        <th>Date</th>
        <th></th>
        </tr>
       </thead>
       
       <tbody id="inv_detail">
       	 <?php $i=0; foreach($record2 as $row){
       	 	$i++;
       	 	   $query = $this->db->query("select * from item_batch where item_id=".$row->item_id);
            $batch = $query->result();
       	  ?>
        <tr >
         <td width="2%" class="s_no"><?php echo $i; ?></td>
         <td width="38%"><a class="cut"><span class="fa fa-minus"></span></a><select name="" class="select2 item" id="item" required="required" style="width:100%">
          <option value="">Select Medicine</option>
         

            <?php foreach ($items as $value) {
              
             ?>
          <option value="<?php echo $value->id ?>" class="item_list" <?php if($row->item_id==$value->id){?> selected=""<?php } ?>><?php echo $value->name; ?></option>
        <?php } ?>
         </select></td>
         <td width="7%"><input type="text" id="qty" value="<?php echo $row->qty ?>" min="0" placeholder="Quantity" data-id="0" class="form-control qty"></td>
         <td width="4%"><input type="text" id="r_qty" class="form-control" readonly="" value=""></td>
         <td width="10%" id="batch_col"><select name="" id="batch" class="form-control batch" style="height: 30px !important;">
         	<?php foreach ($batch as $row1) {?>
              <option value="<?php $row1->id ?>" <?php if($row1->batch_no==$row->batch_no){?> selected=""<?php } ?>><?php echo $row1->batch_no ?></option>
             <?php }?>
         </select></td>
         <td width="10%" id=""><select name="" id="expiry" class="form-control expiry" style="height: 30px !important;">
          <?php foreach ($batch as $row1) {?>
              <option value="<?php $row1->id ?>" <?php if($row1->item_id==$row->item_id){?> selected=""<?php } ?>><?php echo $row1->expiry ?></option>
             <?php }?>
         </select></td>
         
         <td width="35%"><input type="text" value="<?php echo $row->comment ?>" id="comment" class="form-control comment" placeholder="Enter comment here"></td>
         <td width="10%"><input type="text" value="<?php echo $row->date ?>" class="date" data-toggle="datepicker" readonly="readonly"></td>
         <td><span style="cursor: pointer;font-size:15px" type="button" id="remove"><i class="fa fa-trash"></></span></td>
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
       // $('#print').prop('disabled', true);
       $('#test').hide();
       $('#hepatitis').hide();

       //Close Page
       $('#close').click(function(){
        window.location.href='<?php echo base_url('Pharmacy/'); ?>';
       })
       //Fetch Medicine By Type
       $(document).on('change','#med_type',function(){
        // alert()
        $('.item').html('');
        var med_id=$(this).val();
        if(med_id==4)
        {
         $('#hepatitis').show(); 
        }
        else{
         $('#hepatitis').hide();  
        }
          $.ajax({
         url:"<?php echo base_url('Product/fetch_item_by_type') ?>",
         method:"POST",
         data:{med_id:med_id},
         success:function(data)
         {
            
               $('.item').append(data);
                                      
                                       

         }        
       })
          //Fetch Recept Number of Every Product Type
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
    var n=$('.s_no:last').text();
    $('.hover').popover({
     title :'My Title',
     html :'My Content',
     trigger:'hover',
     placement :'bottom'
   });
    
    // GET BATCH NUMBER START HERE
   

        //ADD NEW ROW FUNCTION START HERE
         function add_new_row()
          {
          		console.log(n);
                n=Number(n)+1;
               var row='<tr style="padding-top:-20px">'+
                '<td width="2%">'+n+'</td>'+
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
                '<td width="10%"><input type="text"  data-toggle="datepicker" readonly="readonly" class="date"></td>'+
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
            var message='Item & Quantity Field Required';
            error(message);
            break;
            // $(tr).find(field[i]).addClass('error');
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
    var med_type=$('#med_type').val();
    var edit_invid=$('#edit_invid').val();
  var item_name = [];
  var item_qty = [];
  var item_batch = [];
  var item_expiry = [];
  var item_comment = [];
  var date = [];
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
  $('.date').each(function(){
   date.push($(this).val());
   // console.log(item_name)
  }); 
  $.ajax({
   url:"<?php echo base_url('Pharmacy/update_patientInvoice') ?>",
   method:"POST",
   data:{edit_invid:edit_invid,inv_id:inv_id,test_type:test_type,advisor:advisor,inv_date:inv_date,patient_name:patient_name,father_name:father_name,card:card,mobile:mobile,
         gander:gander,item_name:item_name,item_qty:item_qty,item_batch:item_batch,item_expiry:item_expiry,item_comment:item_comment,distric:distric,med_type:med_type,date:date},
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