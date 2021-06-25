
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
        OPD Records
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Search Records</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">

<?php 

$from = $to = $dept_id = $shift = $type = $gander = '';

if($this->input->post('from')!='')
$from = $this->input->post('from');
else
$from = date('m/d/Y');

if($this->input->post('to')!='')
$to = $this->input->post('to');
else
$to = date('m/d/Y');

if($this->input->post('dept_id')!='')
$dept_id = $this->input->post('dept_id');
else 
$dept_id = '';


if($this->input->post('shift')!='')
$shift = $this->input->post('shift');
else
$shift = '';


if($this->input->post('type')!='')
$type = $this->input->post('type');
else
$type = '';

if($this->input->post('gander')!='')
$gander = $this->input->post('gander');
else 
$gander = '';




?>

    <form method="post" action="<?php echo base_url('OPD_Report/all_report') ?>">
        <div class="col-md-2">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="from" id="from" value="<?php echo $from; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <label>To Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="to" id="to" value="<?php echo $to; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        

        <div class="col-md-2">
            <label>Department:</label>
            <select class="form-control" name="dept_id" id="dept_id">
                <option value="">Select Department</option>
                <?php foreach ($getDept as $key) { ?>
                    <option <?php if($dept_id == $key->id) {echo 'selected';} ?> value="<?php echo $key->id; ?>"><?php echo $key->dep_name; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-2">
            <label>Shift:</label>
            <select name="shift" class="form-control" id="shift">  
            <option value="">Select Shift</option>             
                <option value="Morning"  <?php if($shift == 'Morning') {echo 'selected';} ?>>Morning</option>
                <option value="Evening" <?php if($shift == 'Evening') {echo 'selected';} ?>>Evening</option>
                <option value="Night" <?php if($shift == 'Night') {echo 'selected';} ?>>Night</option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Type:</label>
            <select class="form-control" id="type" name="type">
                <option value="">Select Type</option>
                <option value="OPD" <?php if($type == 'OPD') {echo 'selected';} ?>>OPD</option>
                <option value="Aged" <?php if($type == 'Aged') {echo 'selected';} ?>>Aged</option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander">
                <option value="">Select Gander</option>
                <option value="Male" <?php if($gander == 'Male') {echo 'selected';} ?>>Male</option>
                <option value="Female" <?php if($gander == 'Female') {echo 'selected';} ?>>Female</option>
            </select>
        </div>
        
        <div class="col-md-12" style="margin-top: 10px;">
        <div align="center">
            <input type="submit" name="search" id="search" value="Advance Search" class="btn btn-success"  />
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

    <?php
    $date = date('y-m-d');
    
    // $this->db->select("*");
    // $this->db->from("opd_entry");
    // $this->db->where('sync_status', 0);
    // $this->db->where('is_deleted', 0);
    // $query1 = $this->db->get();
    // if(count($query1->result_array()) > 0)
    // {                           
    ?>
    <button class="btn btn-primary" id="sync" style="float: right; display: none;">Synchronize All Data</button> 
    <?php //} ?>

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
            <th width="15%">Patient</th>
            <th width="5%">Gander</th>
            <th width="10%">Address</th>
            <th width="20%">Date</th>
            <th width="10%">Dept</th>
            <th width="5%">Shift</th>
            <th width="5%">Type</th>
            <th width="5%">Action</th>
            <th width="10%">Sync</th>
            
            </tr>
        </thead>

         <tbody>
            <?php 
            
            if($query->num_rows()>0)
            { 
             $count=1;   
            foreach($query->result() as $row){  
                $dept_id = $row->dept_id;
            ?>
            <tr style=" font-weight: bold; ">
                <td width="5%"><?php echo $count; ?></td>
                <td width="10%"><?php echo $row->dept_nick."-".$row->yearly_no."-".$row->receptNumber; ?></td>
                <td style="text-transform: uppercase;" width="15%"><?php echo $row->patient_name ?></td>
                <td width="5%"><?php echo $row->gander ?></td>
                <td width="10%"><?php echo $row->district; ?></td>
                <td width="20%"><?php $old_date = $row->date; $old_date_timestamp = strtotime($old_date); $new_date = date('j M, Y g:i A', $old_date_timestamp); echo $new_date;  ?></td>
                <td width="10%"><?php  echo $row->dept_name; ?></td>
                 <td width="5%"><?php echo ucfirst($row->shift) ?></td>
                 <td width="5%"><?php echo ucfirst($row->type) ?></td>
                 <td width="5%" style="color: green"><a href="<?php echo base_url('OPD_Report/opd_print_report/'.$dept_id.'/'.$row->receptNumber.'/'.$row->yearly_no) ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                    <?php 
                    $is_admin=$this->session->userdata('is_admin'); 
                    if($is_admin==1){ ?>  
                        || <a href="<?php echo base_url('OPD_Report/opd_delete_report_all/'.$dept_id.'/'.$row->receptNumber.'/'.$row->yearly_no) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <?php }
                    ?>
                 </td>
                 
                 <td width="10%" style="color: green"><?php 
                 if($row->sync_status == '0')
                 echo 'UN DONE';
                 else if($row->sync_status == '1')
                 echo 'DONE'; ?></td>
                                 
            </tr>
            <?php $count++;  } } ?>
        
        </tbody>
        <tfoot>
            <tr style="background-color: green; color: #FFFFFF;">
                <td>---</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>              
                <td></td>              
                <td></td>              
                <td></td>               
                               
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
   
    <!-- Datatables CDN START -->
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
     
        $(document).ready(function() {
           
            var from_date;
            var to_date;
            var shift;
            var gander;
            var type;
            var dept_id;
            if( $("#from").val()!="" ) {
                  from_date = '<?php echo 'From Date : '. $from; ?>';   
            } else {
                 from_date = '';
            }

            if( $("#to").val()!="" ) {
                  to_date = '<?php echo 'To Date '.' '.' '.' '.' '.' '.': '. $to; ?>';   
            } else {
                 to_date = '';
            }

            if( $("#dept_id").val()!="" ) {
                  dept_id = 'Department : '+$("#dept_id option:selected").html().replace(/\s/g, '')+' OPD';   
            } else {
                  dept_id = 'Department :  All OPD Departments';
            }

            if( $("#shift").val()!="" ) {
                  shift = 'Shift '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' : '+$("#shift option:selected").html().replace(/\s/g, '');     
            } else {
                  shift = 'Shift '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+': All Shift'; 
            }

            if( $("#type").val()!="" ) {
                  type = 'Type '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' : '+$("#type option:selected").html().replace(/\s/g, '');
            } else {
                 type = type = 'Type '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' : Paid & Free'; 
            }
            
            if( $("#gander").val()!="") {
                  gander = 'Gander '+' '+' '+' '+' '+' '+' '+' '+' '+' : '+$("#gander option:selected").html().replace(/\s/g, '');   
            } else {
                 gander = '';
            }

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
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    },

                    customize: function ( doc ) {
                     doc.content.splice(0,1); 
                     doc.defaultStyle.alignment = 'left';
                     doc.styles.tableHeader.fontSize = 7;
                     doc.defaultStyle.fontSize = 6;
                                                         
                    doc.pageMargins = [12,80,12,12]

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
                                            text: dept_id+'\n',
                                            bold: true,
                                            fontSize: 10
                                        },
                                        {
                                            text: type+'\n',
                                            bold: true,
                                            fontSize: 10
                                        },
                                        {
                                            text: gander,
                                            bold: true,
                                            fontSize: 10
                                        }
                                        ],
                                        margin: [-270,25,0,0],
                                        alignment: 'left',
                                        width:130
                                    },
                                    {
                                        alignment: 'left',
                                         bold: true,
                                        text: from_date + '\n' + to_date + '\n Print Date '+' : ' + file_name+'\n'+shift,
                                        fontSize: 10,
                                        width:300,
                                        margin: [-80,0,3,0]
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
                        objLayout['paddingLeft'] = function(i) { return 10; };
                        objLayout['paddingRight'] = function(i) { return 10; };
                        doc.content[0].layout = objLayout;
                            doc.content[0].table.widths = [
                                        '5%',
                                        '11%',
                                        '15%',
                                        '10%',
                                        '12%',
                                        '22%',
                                        '9%',
                                        '10%',
                                        '6%'
                                        ]  
                }
            },
                {
                    extend: 'copy',
                    text: 'Copy',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    },
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    }
                },
            {
                extend: 'print',
                text: 'Print all',
                 title: $("#logo_text").text(),
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px">'+ dept_id + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + shift+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+gander+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+type,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8],
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
                 title: $("#logo_text").text(),
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px">'+ dept_id + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + shift+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+gander+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+type,
                 exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8],
                    
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
            scrollY:        "400px",
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

            pageTotal2 = api.rows({ page: 'current' }).count();
            $( api.column( 0 ).footer() ).html(
                pageTotal2
            );
        }
        } );



       
    } );
    </script>