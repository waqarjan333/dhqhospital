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
  background-image: url('../images/text-bg.gif') !important;
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
   background-image: url('../images/text-bg.gif') !important;
  background-position:center !important;
  height: 26px !important;

}
textarea{
    background-image: linear-gradient(#FCFCFD, #F7F7F7) !important;

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
  background: #E9E9E9;
  cursor: pointer;
}
#s_pro{
  width: 30%;
  border-right: 3px solid #DED9DF;
  font-weight:bold;
}
#s_pro1{
  width: 30%;
}
#medlist{
    position: absolute;
    left: 164px;
    top: 250px;
    width: 400px;
    background: red;
}
  .list-unstyled{
    background: #FAFAFA;
    cursor: pointer;
  }
  .li_unstyle{
    padding: 12px;
  }
  @media(max-width: 1600px)
  {
    #categories{
      position: absolute;
      left: -100px;
    }
  }
</style>

    

    <!-- Main content -->
    <section class="content">
        <div class="box-body" >
       
        <div class="col-md-12" >
        
          <div class="panel panel-default" id="record" style="background: #F3F5F5">
          <div class="panel-heading" style="height: 30px !important;">
            <p style="line-height: 10px;">Product List  <a href="<?php echo base_url('login/dashboard') ?>"><span class="pull-right" style="font-size: 25px;color: darkred" title="Close Product List">&times;</span></a></p>

          </div>           
        <div class="panel-body"> 
                 <form action="" class="form-horizontal">
            <div class="form-group">
              <label for="" class="label-control col-sm-1" style="margin-top: 5px;">Adjust Date:</label>
              <div class="col-sm-2">
              <input type="text"  class="form-control" readonly="" value="<?php echo date('Y-m-d') ?>">  
              </div>
                <input type="hidden" id="p_id">
                <input type="hidden" id="cat">
                <input type="hidden" id="p_name_id">
                <input type="hidden" id="cat_id">
               <label for=""  class="label-control col-sm-1" style="margin-top: 5px;">Item Category:</label>
              <div class="col-sm-4">
                <select name="" class="form-control input-sm" id="medicine_cat">
                <option value="all">All</option>
                  <?php foreach($category as $row){ ?>
                      
                      <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                    <?php } ?>
              </select>
              </div>
                <label for=""  class="label-control col-sm-1" style="margin-top: 5px;">Memo:</label>
                <div class="col-sm-3">
                <textarea name="" id="memo" cols="10" rows="4" style="resize: none;" class="form-control"></textarea>      
              </div>
            </div>
                <button type="button" id="adjust" class="btn btn-default col-sm-offset-5 btn-sm col-sm-2" style="font-size: 14px;font-weight: bold;">Adjust</button>        
           
          
            
          </form>
        </div>

        </div>
        <div class="row">
          <div class="col-md-12">
              <div id="item" style="margin-top: 20px;height: 515px; overflow: scroll;background:#EEEEEE;box-shadow: -4px 24px 31px 39px rgba(217,217,217,0.88);">
              <div class="form-group">
                <label for="" class="col-sm-2" style="margin-top: 5px;">Search Item :</label>
                  <div class="col-sm-4 col-sm-pull-1">
              <!--  <div class="input-group">
              <input type="search" placeholder="Search Item" id="search" class="form-control">
              <span class="input-group-btn">
              <button class="btn btn-default btn-xs" style="margin-top: 5px;height: 24px;" id="search_btn" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true">
              </span></button>
              </span>
 -->       <select name="item" class="select2 item" id="item_search" required="required" style="width:100%">
                <option value="">Select Product</option>
                <?php foreach($product as $row)
                {?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                <?php } ?>
         </select>
            </div>
                  </div>
             <table class="table table-bordered table-striped">
               <thead style="background: #E4E5E6;box-shadow: 1px 3px 4px 4px rgba(217,217,217,0.88);height: 10px !important;">

               
                 <tr id="s_record">
                   <td >Item</td>
                   <td>Current Qty</td>
                   <td>New Qty</td>
                   <td>Qty Difference</td>
                 </tr>
               </thead>
               <tbody id="show">
                                  <!-- 
                    <tr>
                      <td id="med_name"></td>
                    </tr>                 -->

               </tbody>
             </table>
            </div>
       
          </div>
        </div>
      </div>
      <!-- Default box -->

      <!-- /.box -->

    </section>
      <script src="<?php echo base_url('assets/sweetalert.js') ?>"></script>
  <script src="<?php echo base_url('assets/jquery-confirm.js') ?>"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
  $(document).ready(function(){

    $('#search').on('keyup',function(e){
    var query=$(this).val();
    // var id=$(this).data('id');
      if(query!='' && e.keyCode !=8)
      {
        $.ajax({
          url:'<?php echo base_url('Product/fetch_product') ?>',
          method:'POST',
          data:{query:query},
          success:function(data)
          {
            $('#medlist').fadeIn();
            $('#medlist').html(data);
          }
        });
      }   
    })
    $(document).on('click','li',function(){
      // var id=$(this).data('id');
      $('#search').val($(this).text());
        
      $('#medlist').fadeOut();
      
      
    })

  $(document).on('keyup',function(){
      if($('#search').val()==='')
      {
        // alert();
      $('#medlist').fadeOut();  
      } 
      })
   $(document).on('keyup',function(e){

    if(e.keyCode == 8)
    {
      $('#medlist').html('');
    }
   })       

     })
</script>
<script>
    $(document).ready(function(){
       $('#date').datepicker({
      autoclose: true,
       format: 'yyyy/mm/dd'
    })
       $('#date1').datepicker({
      autoclose: true,
       format: 'yyyy/mm/dd'
    }) 
    });
  </script>
  <script>
  $(document).ready(function(){


    localStorage.removeItem('p_name');
    localStorage.removeItem('new_qty');
    localStorage.removeItem('qty_diff');
    localStorage.removeItem('p_cat');
    localStorage.removeItem('all');

    $('#item_search').on('change',function(){
    var inp=$(this).val();
    $('#p_name_id').val(inp);
    get_product_name(inp)
   })

   function get_product_name(inp)
   {
     $.ajax({
          url:'<?php echo base_url('product/get_product_name') ?>',
          method:'POST',
          dataType:'json',
          data:{inp:inp},
          success:function(data)
          {
            $('#show').html('');
            if(data!='')
                {
                  localStorage.setItem('p_name',2);
                   $.each(data,function(index,item){
                   var total_qty=Number(item.op_qty)+Number(item.supplier_qty)-Number(item.p_qty)-Number(item.ind_qty)+Number(item.adj_qty);
                        $("<tr id='s_rec'  class='item'> ").append(
                         
                        $("<td  id='s_pro1' >").text(item.name),
                        $("<td  id='s_pro1' class='name"+item.id+"'>").text(total_qty),
                        $("<td  id='new_qty"+item.id+"' class='new_qty' data-id='"+item.id+"'  contenteditable>").text('0'),
                        $("<td  id='diff_qty"+item.id+"'>").text(''),
                        ).appendTo("#show");

                       });
                }
                else{
                   $("<tr id='s_rec'> ").append(
                        $("<td colspan='4' >").html('<center><p style="color:red">No Record Found</p></center>')
                        
                        ).appendTo("#show");
                }


               
          }
      })
   }



    $(document).on('focusout','.new_qty',function(e){
      var id=$(this).attr('data-id');
      $('#p_id').val(id);
      
      var cur_qty=$('.name'+id).text();
      var new_qty=$('#new_qty'+id).text();
      if(new_qty!=null && new_qty!=0)
      {
         var total=new_qty-cur_qty;
      $('#diff_qty'+id).text(total);
      localStorage.setItem('new_qty',new_qty);
      localStorage.setItem('qty_diff',total);
      }
     
      
      // alert(new_qty)
    })

    $('#adjust').on('click',function(){
      var med_id=$('#p_id').val();
      var new_qty=localStorage.getItem('new_qty');
      var qty_diff=localStorage.getItem('qty_diff');
      var memo=$('#memo').val();
      // alert(qty_diff);
      if(med_id=='')
      {
      alert('Please Select Any Item');       
      }
      else{
        $.ajax({
          url:'<?php echo base_url('Product/adjust_stock') ?>',
          method:'POST',
          data:{med_id:med_id,new_qty:new_qty,qty_diff:qty_diff,memo:memo},
          success:function(data)
          {
            
            $('#p_id').val('');
            localStorage.removeItem('new_qty');
            localStorage.removeItem('qty_diff');
            $('#memo').val(''); 
              {
              Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Product has been Updated',
                showConfirmButton: false,
                timer: 1500
              });
          } 

            var cat=localStorage.getItem('p_cat');
            var name=localStorage.getItem('p_name');
            var all=localStorage.getItem('all');
            if(cat)
            {
              var val=$('#cat').val();
              if(val!=='all')
              {
               product_by_cat(val); 
              }
              else{
                show_all();
              }
              $('#cat_id').val('');
            }
            else if(name)
            {
              localStorage.removeItem('p_cat')
               var val=$('#p_name_id').val();
              get_product_name(val);
              localStorage.removeItem('p_name')
            }
            
            else{
              show_all()
            }

                
              
              
          }
        })
      }
    })


   show_all();
    function show_all()
    {
       $.ajax({
          url:'<?php echo base_url('Product/get_all_product') ?>',
          method:'POST',
          dataType: "json",
          success:function(data)
          {
            // result=$.parseJSON(data);
            $('#show').html('');
           $.each(data,function(index,item){

                        var total_qty=Number(item.op_qty)+Number(item.supplier_qty)-Number(item.p_qty)-Number(item.ind_qty)+Number(item.adj_qty);
                        $("<tr id='s_rec'  class='item'> ").append(
                         
                        $("<td  id='s_pro1' >").text(item.name),
                        $("<td  id='s_pro1' class='name"+item.id+"'>").text(total_qty),
                        $("<td  id='new_qty"+item.id+"' class='new_qty' data-id='"+item.id+"'  contenteditable>").text('0'),
                        $("<td  id='diff_qty"+item.id+"'>").text(''),
                        ).appendTo("#show");

                       });
          }
      }) 
    }
    $('#show_all').on('click',function(){
     show_all()
    })
   
    
   
    $('#medicine_cat').on('change',function(e){
      // alert()
      var val=$(this).val();
      var cat=$('#cat').val(val);
      if(val=="all")
      {
        localStorage.setItem('all',3);
        show_all()
      }
      else if(val!=='all'){
         product_by_cat(val)
         // alert()
      }
     
    })

    function product_by_cat(val)
    {

          $.ajax({
          url:'<?php echo base_url('product/get_product_cat') ?>',
          method:'POST',
          dataType:'json',
          data:{val:val},
          success:function(data)
          {
            localStorage.setItem('p_cat',1);
            $('#show').html('');
            if(data!='')
                {
                  $.each(data,function(index,item){
                  var total_qty=Number(item.op_qty)+Number(item.supplier_qty)-Number(item.p_qty)-Number(item.ind_qty)+Number(item.adj_qty);
                        $("<tr id='s_rec'  class='item'> ").append(
                         
                        $("<td  id='s_pro1' >").text(item.name),
                        $("<td  id='s_pro1' class='name"+item.id+"'>").text(total_qty),
                        $("<td  id='new_qty"+item.id+"' class='new_qty' data-id='"+item.id+"'  contenteditable>").text('0'),
                        $("<td  id='diff_qty"+item.id+"'>").text(''),
                        ).appendTo("#show");

                       });

                }
                else{
                   $("<tr id='s_rec'> ").append(
                        $("<td colspan='4' >").html('<center><p style="color:red">No Record Found</p></center>')
                        
                        ).appendTo("#show");
                }


               
          }
      })
    }

  })

</script>
</body>
</html>
