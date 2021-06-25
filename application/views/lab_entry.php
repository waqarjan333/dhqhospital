<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<style type="text/css">
.content {
    min-height: 120px !important;
    padding: 0px!important;
    font-size: 9px !important;
}
table.table tbody tr:nth-child(even):hover td{
    background-color: #3c8dbc !important;
}

table.table tbody tr:nth-child(odd):hover td {
    background-color: #3c8dbc !important;
}
</style>
    <section class="content-header">
      <h1 class="text-success">
        <?php 
            $dept_id = $this->uri->segment(3); // for getting the id 
            $this->db->select('view, dept_price');
            $this->db->where('id',$dept_id);
            $this->db->where('is_deleted',0);
            $info = $this->db->get('departments')->result_array();
        ?>
        <?php echo $info[0]['view']; ?> 
        Informations
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">LAB Informations</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">

    <span id="loading" style="display:none;"></span>
    
    <!-- <div class="col-md-1"></div> -->
    <div class="col-md-12" style="margin-top:5px;">
    <div class="row">
    <!-- <div class="panel panel-success"> -->
   <!--  <div class="panel-heading" align="center" style="color:red;"> Add Class Here </div> -->
    <div class="panel-body">

    <form method="post" action="" id="lab_form">
        <input type="hidden" name="dept_id" id="dept_id" value="<?php echo $dept_id; ?>">
        <div class="col-md-4">
        <?php $invno=$inv_no->row_array();
        if($invno==NULL)
        { ?>
        <label>Recept #:</label>
        <input type="text" class="form-control" name="receptNumber" id="receptNumber" readonly value="<?php echo $nick[0]['dept_nick']; ?>-<?php echo date('y'); ?>-1" />

        <?php } else {
        if($invno['yearly_no']=='')
        {
        $year= date('y');
        }else{
        $year=$invno['yearly_no'];
        }
        ?>
        <label>Recept #:</label>
        <input type="text" class="form-control" name="receptNumber" id="receptNumber" readonly value="<?php echo $nick[0]['dept_nick']; ?>-<?php echo $year; ?>-<?php echo $invno['receptNumber']+1; ?>" />

        <?php }
        ?>
        </div>

        <div class="col-md-4">
            <label>Date:</label>
            <input type="text" class="form-control" name="testDate" id="testDate" readonly value="<?php echo date('h:i A d-m-Y D'); ?>"  /><br />
        </div>

        <div class="col-md-4">
            <label>Shift:</label>
            <select name="shift" class="form-control" required="" disabled >                 
                <option value="Morning"  id="morning">Morning</option>
                <option value="Evening" id="evening">Evening</option>
                <option value="Night" id="night">Night</option>
            </select>
            <input type="hidden" id="shift" name="shift" value="" />
            <br />
        </div>

        <div class="col-md-2">
            <label>Paitent Name:</label>
            <input type="text" class="form-control" name="name" id="name" autofocus required placeholder="Paitent Name" style="text-transform:uppercase;"  />
        </div>
        <div class="col-md-2">
            <label>Refrence:</label>
            <input type="text" class="form-control" name="refrence"  />
        </div>
        <div class="col-md-4">
            <label>Lab Test:</label>
            <select id="test_id" name="test_id[]" class="form-control select2" required="" multiple="multiple" data-placeholder="Select a Test">  
           <?php foreach ($tests as $test) { ?>
                    <option value="<?php echo $test->id; ?>"><?php echo $test->name; ?></option>
                <?php } ?>
            </select>
            <br />
        </div>

        <div class="col-md-2">
            <label>Type:</label>
            <select class="form-control" id="type" name="type" required="required">
                <option value="">Select Type</option>
                <option value="Paid" selected="selected">Paid</option>
                <option value="Casualty">Casualty</option>
                <option value="Ward">Ward</option>
                <option value="Labour_Room">Labour Room</option>
                <option value="Entitled">Entitled</option>
            </select>
        </div>
        <div class="col-md-2">
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander" required="required">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br />
        </div>

        
        

        <div class="col-md-4">
            <label>Address:</label>
            <select id="address" name="address" class="form-control" required="required" >  
           <?php foreach ($districts as $value) { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                <?php } ?>
            </select>
            <br />
        </div>

        
<div class="col-md-2">
            <label>Age:</label>
            <input type="text" class="form-control" name="age" id="age"  /><br />
        </div>


        


        <div class="col-md-2">
            <label>Price:</label>
            <input type="number" class="form-control" readonly name="price" id="price" value="<?php echo $info[0]['dept_price']; ?>"  /><br />
        </div>
        
        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" id="save" value="Save" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    <!-- </div> -->
    </div>
    </div>
    <!-- <div class="col-md-1"></div> -->

    </div>

    </div>
    </section>
    <section class="content" >
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12">
    <?php 
        $get_logo = $this->db->SELECT('*')->FROM('hospital_info')->get()->result_array(); 
        $logo = $get_logo[0]['logo'];
         $name = $get_logo[0]['name'];       
        $img = file_get_contents($logo);  
        $data = base64_encode($img);
     ?>   
        <div id="logo_data" style="display: none;"><?php echo "data:image/png;base64,".$data; ?></div>
        <div id="logo_text" style="display: none;"><?php echo $get_logo[0]['name']; ?></div>   
    <div class="row">
    <div class="panel-body">
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040;">
       
        <table id="example1" class="table table-hover table-bordered" style="width: 100% !important;">
        <thead>
            <tr style="background-color: #3c8dbc; color: #FFFFFF; font-weight: bold;">
            <th width="5%">S.No</th>
            <th width="10%">Recept</th>
            <th width="10%">Patient</th>
            <th width="5%">Gander</th>
            <th width="10%">Date</th>
            <th width="10%">Dept</th>
            <th width="10%">Shift</th>
            <th width="20%">LAB Test</th>
            <th width="5%">Type</th>
            <th width="5%">Price</th>
            <th width="5%">Invoice</th>
            <th width="5%">Sync</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            $total = $totalTests = 0; 
            if($query->num_rows()>0)
            {
            $count=0;   
            foreach($query->result() as $row){

                
            $count++;   

            $get_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$row->dept_id)->get()->result_array();  
            // print_r($get_Dept);
            $get_User = $this->db->SELECT('*')->FROM('user')->where('id',$row->user_id)->get()->result_array();  
            $get_District = $this->db->SELECT('*')->FROM('districts')->where('id',$row->address)->get()->result_array();  

            $sql_lab_test = "SELECT * FROM `lab_entry_details` INNER JOIN tests On(lab_entry_details.test_id = tests.id) AND lab_entry_details.entry_id= '$row->receptNumber' WHERE lab_entry_details.is_deleted=0 AND lab_entry_details.dept_id= '$row->dept_id' AND lab_entry_details.yearly=".$row->yearly_no;

            $query_lab_test = $this->db->query($sql_lab_test);

             ?>
            <tr style="font-weight: bold; text-align: left;">
                <td><?php echo $count; ?></td>
                <td>

                <?php       
                  echo $get_Dept[0]['dept_nick']."-".$row->yearly_no."-".$row->receptNumber;
                ?> 

                
                </td>
                 <td style="text-transform: uppercase;"><?php echo $row->patient_name ?></td>
                 <td><?php echo $row->gander ?></td>
                 <td><?php $old_date = $row->date; $old_date_timestamp = strtotime($old_date); $new_date = date('j M, Y g:i A', $old_date_timestamp); echo $new_date;  ?></td>
                <td>
                <?php
                $opd = "---";

                $result = $this->db->SELECT('*')->FROM('departments')->where('id',$row->dept_id)->get()->result();
                foreach ($result as $value) {
                $opd = $value->dep_name;
                }
                ?>
                    <?php echo $opd; ?></td>
                 <td><?php echo ucfirst($row->shift) ?></td>
                 <td><?php
                 foreach($query_lab_test->result() as $row_lab_test){
                echo $row_lab_test->name.'<br>';
                }
                $totalTests += $query_lab_test->num_rows();
                  ?></td>
                  <td><?php echo $row->type ?></td>
                 <td style="color: green"><?php echo $row->price."/="; ?></td>
                  <td style="color: green;">
                    <a data-entryid="<?php echo $row->receptNumber; ?>" data-dept_id="<?php echo $row->dept_id; ?>" data-yearly_no="<?php echo $row->yearly_no; ?>" class="lab-invoice" title="Ivoice"><i class="fa  fa-file-text-o"></i></a> | 
                    <?php  $is_admin=$this->session->userdata('is_admin'); 
                    if($is_admin==1){ ?>  
                        <a href="<?php echo base_url('LAB_Report/lab_print_report_delete_all/'.$row->receptNumber.'/'.$row->yearly_no).'/'.$row->dept_id ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <?php }  ?>
                    </td>  
                 <td style="color: green"><?php 
                 if($row->sync_status == '0')
                 echo 'UN DONE';
                 else if($row->sync_status == '1')
                 echo 'DONE'; ?></td> 
                                  
            </tr>
            <?php $total += $row->price; } } ?>
            
        </tbody>
        <tfoot>
            <tr style="background-color: green; color: #FFFFFF;text-align: left;">
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>&nbsp;</td>  
               <td><?php echo $totalTests; ?></td> <td>&nbsp;</td> 
               <td><?php echo $total; ?></td>
               <td>&nbsp;</td><td>&nbsp;</td>
            </tr>
        </tfoot>
        </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>  
    </section>
     <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content" >
               <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LAB Invoice</h4>
              </div>
              <div class="modal-body invoice" id="entry_modal">
    <!-- /.content -->
    <div class="clearfix"></div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> 
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

   
    <!-- Datatables CDN START -->
   
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.select.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.colVis.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var dept_name = 'Department Of : Laboratory';
function DisplayCurrentTime() {
        var date = new Date();
        var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
        var am_pm = date.getHours() >= 12 ? "PM" : "AM";
        hours = hours < 10 ? "0" + hours : hours;
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + "-" + minutes + "-" + seconds + " " + am_pm;
        return time;
    };
        var date = new Date();
        var month = new Array();
        month[0] = "Jan";  
        month[1] = "Feb";  
        month[2] = "Mar";  
        month[3] = "Apr";  
        month[4] = "May";  
        month[5] = "June";  
        month[6] = "July";  
        month[7] = "Aug";  
        month[8] = "Sep";  
        month[9] = "Oct";  
        month[10] = "Nov";  
        month[11] = "Dec";
        var file_name = date.getDate()+'-'+month[date.getMonth()]+'-'+date.getFullYear()+' '+DisplayCurrentTime();

        $('#example1').DataTable( {
        paging:   false,
        ordering: false,
        info:     false,
        dom: 'Bfrtip',
        buttons: [
            {
                    text: 'PDF',
                    extend:'pdfHtml5',
                    title:$("#logo_text").text(),
                    filename : file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },

                    customize: function ( doc ) {
                     doc.content.splice(0,1); 
                     doc.defaultStyle.alignment = 'left';
                     doc.styles.tableHeader.fontSize = 7;
                     doc.defaultStyle.fontSize = 6;
                                                         
                    doc.pageMargins = [12,80,0,12]

                    doc['header']=(function() {
                            return {
                                columns: [
                                    {
                                        image: $("#logo_data").text(),
                                        width: 70,
                                        margin:[0,-5,0,0],
                                    },
                                    {
                                        alignment: 'left',
                                        italics: true,
                                        text: $("#logo_text").text(),
                                        fontSize: 22,
                                        width:280,
                                        margin: [5,0,-20,0]
                                    },
                                    {
                                        text: [
                                        {
                                            text: 'Print Date : '+file_name+'\n',
                                            bold: true,
                                            fontSize: 10
                                        },
                                        {
                                            text: dept_name,
                                            bold: true,
                                            fontSize: 10
                                        }
                                        ],
                                        margin: [-270,25,0,0],
                                        alignment: 'left',
                                        width:130
                                    }
                                ],
                                margin: 10
                            }
                        });
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) { return .5; };
                        objLayout['vLineWidth'] = function(i) { return .5; };
                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                        objLayout['paddingLeft'] = function(i) { return 5; };
                        objLayout['paddingRight'] = function(i) { return 5; };
                        doc.content[0].layout = objLayout;
                            doc.content[0].table.widths = [
                                        '5%',
                                        '10%',
                                        '15%',
                                        '10%',
                                        '10%',
                                        '10%',
                                        '10%',
                                        '20%',
                                        '5%',
                                        '5%',
                                        '0%',
                                        '0%'
                                        ]  
                }
            },
                {
                    extend: 'copy',
                    text: 'Copy',
                    filename : file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    filename : file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename : file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },
            {
                extend: 'print',
                text: 'Print all',
                footer: true,
                 title: $("#logo_text").text(),
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +file_name +'</p>',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9],
                    modifier: {
                        selected: null,
                       },

                },
           customize: function (win) {
                    $(win.document.body).find('th').addClass('display').css('text-align', 'left');
                    $(win.document.body).find('table').addClass('display').css({'font-size':'9px','font-weight':'bold'});
                    $(win.document.body).find('table').css({"position": "absolute", "top": "14%","left":"0"});
                    $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                        $(this).css('background-color', '#D0D0D0');
                    });
                    $(win.document.body).find('h1').css('margin-left','150px');
                    $(win.document.body).prepend(
                        '<img src="<?php echo $logo;?>"  width=125 style="position:absolute; top:0; left:0;" />'
                        );
                   
                        }
            },
            {
                extend: 'print',
                text: 'Print selected',
                footer: true,
                 title: $("#logo_text").text(),
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +file_name +'</p>',
                 exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9],
                    
                    },
                      customize: function (win) {
                    $(win.document.body).find('th').addClass('display').css('text-align', 'left');
                    $(win.document.body).find('table').addClass('display').css({'font-size':'9px','font-weight':'bold'});
                    $(win.document.body).find('table').css({"position": "absolute", "top": "14%","left":"0"});
                    $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                        $(this).css('background-color', '#D0D0D0');
                    });
                    $(win.document.body).find('h1').css('margin-left','150px');
                    $(win.document.body).prepend(
                        '<img src="<?php echo $logo;?>"  width=125 style="position:absolute; top:0; left:0;" />'
                        );
                   
                        }
        },
            {
              extend: 'colvis',
              text: 'Hide/Show Columns',
              footer: true,
          }
            ],
            scrollY:        "300px",
                scrollX:        true,
                scrollCollapse: true,
                paging:         false,
                fixedColumns:   {
                    heightMatch: 'none'
                },
            select: true,
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
              var index = iDisplayIndex +1;
              $('td:eq(0)',nRow).html(index);
              return nRow;
            },
            "footerCallback": function ( tfoot, row, data, start, end, display ) {
            var api = this.api(), data;

     

            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            

            pageTotal2 = api.rows({ page: 'current' }).count();
            $( api.column( 0 ).footer() ).html(
                pageTotal2
            );
            
        }
        });            

var thehours = new Date().getHours();

if (thehours >= 8 && thehours < 14) {
$('#morning').attr('selected','selected');
$('#shift').val('Morning');
} else if (thehours >= 14 && thehours < 20) {
$('#evening').attr('selected','selected');
$('#shift').val('Evening');
} else if (thehours >= 20 && thehours < 24) {
    $('#night').attr('selected','selected');
 $('#shift').val('Night');
} else if (thehours >= 0 && thehours < 8) {
$('#night').attr('selected','selected');
$('#shift').val('Night');
}

        // multi values, with last selected
var old_values = [];
var test = $("#test_id");
test.on("select2:select", function(event) {
  var values = [];
  $(event.currentTarget).find("option:selected").each(function(i, selected){ 
    values[i] = $(selected).val();
  });
$.ajax({
            url:'<?php echo base_url('LAB/get_lab_price') ?>',
            method:'POST',
            data:{values:values},
            beforeSend:function(){   
            $('#loading').css('display','block');
            },
            success:function(data)
            {
                $('#loading').css('display','none');
                var tem_price  = parseInt(data);
                $('#price').val(tem_price);
            }
        })
});
test.on("select2:unselect", function(event) {
  var values = [];
  $(event.currentTarget).find("option:selected").each(function(i, selected){ 
    values[i] = $(selected).val();
  });
   $.ajax({
            url:'<?php echo base_url('LAB/get_lab_price') ?>',
            method:'POST',
            data:{values:values},
            beforeSend:function(){   
            $('#loading').css('display','block');
            },
            success:function(data)
            {
                $('#loading').css('display','none');
                var tem_price  = parseInt(data);
                $('#price').val(tem_price);
            }
        })
});
});
        $('#save').on('click',function(e){
            e.preventDefault();
        var test = $("#test_id");
        var dept_id = $('#dept_id').val();
        
        var receptNumber=$('#receptNumber').val();
        var name=$('#name').val();
        var address=$('#address').val();
        var age=$('#age').val();
        var shift=$('#shift').val();
        var gander=$('#gander').val();
        var price = $('#price').val();
        var test_id = $('#test_id').val();
        // validations
        if(name.length < 3 || name == '' || name == null)
        {
            alert('Please Enter Paitent Name, Patient name should be greater than 3 latters')
            return false;
        }

        if(test_id == '' || test_id == null)
        {
            alert('Please Add Atleast 1 XRAY Type');
            return false;
        }
        

        $('.btn-success').css('display','none');
        $.ajax({
            url:'<?php echo base_url('LAB/add') ?>',
            method:'POST',
            data:$("#lab_form").serialize(),
            beforeSend:function(){   
            $('#loading').css('display','block');
            },
            success:function()
            {
                $('#loading').css('display','none');
                window.open('<?php echo base_url('LAB/lab_print/') ?>');
                location.reload();
            }
        })
        });
        $(function() {
            document.onkeydown = function(event) {
        switch (event.keyCode) {
           case 38:
                document.getElementById("gander").options[0].selected=true;
              break;
           case 40:
                document.getElementById("gander").options[1].selected=true;
              break;
        }
    };
   }); 
    </script>