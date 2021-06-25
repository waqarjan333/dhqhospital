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


            $this->db->select('*');
            $this->db->where('parent_id',$dept_id);
            $this->db->where('is_deleted',0);
            $getSub = $this->db->get('departments')->result();
        ?>
        <?php echo $info[0]['view']; ?> 
        Informations
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">OTHER Informations</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 30px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">

    <span id="loading" style="display:none;"></span>
    
    <div class="col-md-12" style="margin-top:30px;">
    <div class="row">
    <div class="panel-body">

    <form method="post" action=""  id="other_form" autocomplete="off">
        <input type="hidden" name="dept_id" id="dept_id" value="<?php echo $dept_id; ?>">

        <div class="col-md-4">
            <?php $invno=$inv_no->row_array(); ?>
            <label>Recept #:</label>
            <input type="text" class="form-control" name="receptNumber" id="receptNumber" readonly value="<?php echo $nick[0]['dept_nick']; ?>-<?php if($invno['yearly_no']==''){ echo substr(date('Y'), 2); } else { echo $invno['yearly_no']; }  ?>-<?php echo $invno['receptNumber']+1; ?>" />
        </div>

        <div class="col-md-4">
            <label>Date:</label>
            <input type="text" class="form-control" name="testDate" id="testDate" readonly value="<?php echo date('h:i A d-m-Y D'); ?>"  />
        </div>

        <div class="col-md-4">
            <label>Shift:</label>
            <select name="shift" class="form-control" required="" disabled >                 
                <option value="Morning"  id="morning">Morning</option>
                <option value="Evening" id="evening">Evening</option>
                <option value="Night" id="night">Night</option>
            </select>
            <input type="hidden" id="shift" name="shift" value="" />
        </div>

        <?php if($getSub != null) { ?>
            <input type="hidden" name="is_subDept" id="is_subDept" value="1">
        <?php } else { ?>
            <input type="hidden" name="is_subDept" id="is_subDept" value="0">
        <?php } ?>

        <?php 
            if($getSub != null) 
            {
        ?>
            <div class="col-md-4">
            <label>Sub Departments:</label>
            <select id="subdep" name="subdep" class="form-control" required="">  
                <option value="" selected="" disabled="">Select Department</option>               
                <?php foreach($getSub as $value) { ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->dep_name; ?></option>
                <?php }?>
            </select>
            </div>
        <?php
            }
        ?>

        <div class="col-md-2">
            <label>Paitent Name:</label>
            <input type="text" class="form-control" name="name" id="name" autofocus required placeholder="Paitent Name" style="text-transform:uppercase;"  />
        </div>

        <div class="col-md-2">
            <label>Refrence:</label>
            <input type="text" class="form-control" name="refrence"  />
        </div>

        <div class="col-md-1">
            <label>Age:</label>
            <input type="text" class="form-control" name="age" id="age"  />
        </div>

        <div class="col-md-2">
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander" required="">
                <option value="Male">Male</option>
                <option <?php if($dept_id=="10" || $dept_id=="13"){ echo "selected='selected'"; } ?> value="Female">Female</option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Type:</label>
            <select class="form-control" id="type" name="type" required="">
                <option value="Paid">Paid</option>
                <option value="Casualty">Casualty</option>
                <option value="Ward">Ward</option>
                <option value="Labour_Room">Labour Room</option>
                <option value="Entitled">Entitled</option>
            </select>
        </div>

        <div class="col-md-1">
            <label>Price:</label>
            <input type="number" class="form-control" readonly name="price" id="price" value="<?php echo $info[0]['dept_price']; ?>"  />
        </div>

        <div class="col-md-2">
            <label>Address:</label>
            <select id="address" name="address" class="form-control" required="" >  
           <?php foreach ($districts as $value) { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-md-12" style="margin-top: 15px;">
        <div align="center">
            <input type="submit" name="save" id="save" value="Save" class="btn btn-success"  />
        </div>
        </div>
        
    </form>

    </div>
    </div>
    </div>

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
            <th width="10%">Ref #</th>
            <th width="15%">Patient</th>
            <th width="5%">Gander</th>
            <th width="10%">Date</th>
            <th width="15%">Department</th>
            <th width="5%">Shift</th>
            <th width="5%">Type</th>
            <th width="5%">Price</th>
            <th width="5%">Print</th>
            <th width="10%">Sync</th>
            </tr>
        </thead>

        <tbody>
            <?php $count = 1;  if($query->num_rows()>0) {   
                foreach($query->result() as $row){
                    $get_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$row->dept_id)->get()->result_array();
                if($row->sub_dept_id!=NULL) {
                    $get_sub_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$row->sub_dept_id)->get()->result_array(); 
                    $sub_dept_name = $get_sub_Dept[0]['dep_name'];
                } else {
                    $sub_dept_name = '';
                } 

            $get_User = $this->db->SELECT('*')->FROM('user')->where('id',$row->user_id)->get()->result_array();  
            $get_District = $this->db->SELECT('*')->FROM('districts')->where('id',$row->address)->get()->result_array();  
            $c_dept_id = $get_Dept[0]['id'];
             
             ?>
            <tr style="font-weight: bold;">
                <td><?php echo $count; ?></td>
                <td><?php echo  $get_Dept[0]['dept_nick']."-".$row->yearly_no."-".$row->receptNumber; ?></td>
                <td><?php echo $row->refrence; ?></td>
                <td style="text-transform: uppercase;"><?php echo $row->patient_name ?></td>
                <td><?php echo $row->gander ?></td>
                <td><?php $old_date = $row->date; $old_date_timestamp = strtotime($old_date); $new_date = date('j M, Y g:i A', $old_date_timestamp); echo $new_date;  ?></td>
                <td><?php echo $get_Dept[0]['dep_name']; if($sub_dept_name!='') echo '-('.$sub_dept_name.')'; ?></td>
                <td><?php echo ucfirst($row->shift) ?></td>
                <td><?php echo ucfirst($row->type) ?></td>  
                <td><?php echo ucfirst($row->price) ?></td> 
                <td style="color: green">
                    <a href="<?php echo base_url('OTHER_Report/other_print_report/'.$c_dept_id.'/'.$row->receptNumber.'/'.$row->yearly_no) ?>" target="_blank"><i class="fa fa-print" aria-hidden="true" style="color: black;"></i></a>
                    <?php  $is_admin=$this->session->userdata('is_admin'); 
                    if($is_admin==1){ ?>  
                     <a href="<?php echo base_url('OTHER_Report/other_print_report_delete_all/'.$c_dept_id.'/'.$row->receptNumber.'/'.$row->yearly_no) ?>"><i class="fa fa-trash" aria-hidden="true" style="color: black;"></i></a>
                    <?php }  ?>
                    
                 </td>               
                 <td style="color: green"><?php if($row->sync_status == '0') echo 'UNDONE'; else if($row->sync_status == '1') echo 'DONE'; ?></td>                
            </tr>
            <?php $count++; } } ?>
            
        </tbody>
        <tfoot>
            <tr style="background-color: green; color: #FFFFFF;">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>0</th>
                <th></th>
                <th></th>                
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
<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.js"></script>
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
                dom: 'Bfrtip',
                autoWidth: true,
                paging:   false,
                ordering: false,
                info:     false,
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
                     doc.styles.tableHeader.fontSize = 6;
                     doc.defaultStyle.fontSize = 6;
                                                         
                    doc.pageMargins = [5,80,5,12]

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
                                            text: file_name,
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
                                        '10%',
                                        '15%',
                                        '5%',
                                        '15%',
                                        '25%',
                                        '5%',
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
            "footerCallback": function ( tfoot, row, data, start, end, display ) {
            var api = this.api(), data;

     

            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            pageTotal9 = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api.column( 9 ).footer() ).html(
              pageTotal9 
              );

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
});

$('#subdep').on('change',function(e){
    e.preventDefault();
    var id = $('#subdep').val();       
    $.ajax({
        url:'<?php echo base_url('OTHER/getPriceOFSubDept/') ?>'+id,
        method:'GET',    
        success:function(data){
                $('#price').val(data);
            }
        })
});


        $('#save').on('click',function(e){
            e.preventDefault();
        
        var dept_id = $('#dept_id').val();
        var receptNumber=$('#receptNumber').val();
        var name=$('#name').val();
        var address=$('#address').val();
        var age=$('#age').val();
        var shift=$('#shift').val();
        var gander=$('#gander').val();
        var price = $('#price').val();
        var type = $('#type').val();

        if($('#is_subDept').val() == 1)
        {
            var subdep = $('#subdep').val();
            // validations
            if(subdep == '' || subdep == null)
            {
                alert('Please Select Sub Department')
                return false;
            }
        }


        if(name.length < 3 || name == '' || name == null)
        {
            alert('Please Enter Paitent Name, Patient name should be greater than 3 latters')
            return false;
        }


        $('.btn-success').css('display','none');
        
        $.ajax({
            url:'<?php echo base_url('OTHER/add') ?>',
            method:'POST',
            data:$("#other_form").serialize(),/*
            data:{receptNumber:receptNumber,name:name,address:address,age:age,shift:shift,gander:gander,dept_id:dept_id,price:price,type:type,subdep:subdep},*/
            beforeSend:function(){   
            $('#loading').css('display','block');
            },
            success:function()
            {
                $('#loading').css('display','none');
                window.open('<?php echo base_url('OTHER/other_print/'.$dept_id) ?>');
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