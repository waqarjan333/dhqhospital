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
        Shift/Gender Wise Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Search Records</li>
      </ol>
    </section>
    </section>

    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
<?php 
$from = $to = $dept_id = $type = '';

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

if($this->input->post('type')!='')
$type = $this->input->post('type');
else
$type = '';
?>
    <form method="post" action="<?php echo base_url('OPD_Report/shift_gender') ?>">

        <div class="col-md-3">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" id="from" name="from" value="<?php echo $from; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <label>To Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" id="to" name="to" value="<?php echo $to; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        

        <div class="col-md-2">
            <label>Department:</label>
            <select class="form-control" name="dept_id" id="dept_id">
                <label>Report Filter</label>
                <option value="">Select Department</option>
                <?php foreach ($getDept as $key) { ?>
                    <option value="<?php echo $key->id; ?>" <?php if($dept_id == $key->id) {echo 'selected';} ?>><?php echo $key->dep_name; ?></option>
                <?php }  ?>
            </select>
        </div>

        <div class="col-md-2">
            <label>Type:</label>
            <select class="form-control" id="type" name="type">
                <option value="">Select Type</option>
                <option value="OPD" <?php if($type == 'OPD') {echo 'selected';} ?>>OPD
                </option>
                <option value="Aged" <?php if($type == 'Aged') {echo 'selected';} ?>>Aged
                </option>
            </select><br />
        </div>
        
        <div class="col-md-2" style="margin-top: 18px;">
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
            <tr style="background-color: #3c8dbc; color: #FFFFFF; font-weight: bold; text-align: left;">
            <th width="10%">Dept</th>
            <th width="5%">MM</th>
            <th width="5%">MF</th>
            <th width="10%">Morning</th>
            <th width="5%">EM</th>
            <th width="5%">EF</th>
            <th width="10%">Evening</th>
            <th width="5%">NM</th>
            <th width="5%">NF</th>
            <th width="10%">Night</th>
            <th width="10%">Male</th>
            <th width="10%">Female</th> 
            <th width="10%">Total</th>    
            </tr>
        </thead>

        <tbody>
            <?php 
            
            if($query->num_rows()>0)
            {
            $count=0;   
            foreach($query->result() as $row){                
            $count++;   
            

            $get_Dept = $this->db->SELECT('*')->FROM('departments')->where('id',$row->dept_id)->get()->result_array(); ?>
            <tr style="text-align: left; font-weight: bold;">
                 <td><?php echo $get_Dept[0]['dep_name'];?></td>
                 <td><?php echo $row->MM ?></td>
                 <td><?php echo $row->MF ?></td>
                 <td><?php echo $row->TM ?></td>
                 <td><?php echo $row->EM ?></td>
                 <td><?php echo $row->EF ?></td>
                 <td><?php echo $row->TE ?></td>
                 <td><?php echo $row->NM ?></td>
                 <td><?php echo $row->NF ?></td>
                 <td><?php echo $row->TN ?></td>
                 <td><?php echo $row->TMale; ?></td>
                 <td><?php echo $row->TFemale; ?></td>
                 <td><?php echo $row->Total; ?></td>                 
            </tr>
            <?php  }  } ?>
        
        </tbody>
            
          <tfoot>
            <tr style="background-color: green; color: #FFFFFF; font-weight: bold; text-align: left;">
                <th>Total</th>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>                
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

    </script>

    <script type="text/javascript">
     

        $(document).ready(function() {

            var from_date;
            var to_date;
            var dept_id;
            var type;
            
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

            if( $("#type").val()!="" ) {
                  type = 'Type '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' : '+$("#type option:selected").html().replace(/\s/g, '');
            } else {
                 type = type = 'Type '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' '+' : Paid & Free'; 
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
            customize: function ( doc ) {
                doc.content.splice(0,1); 
                doc.defaultStyle.alignment = 'left';
                doc.styles.tableHeader.fontSize = 7;
                doc.defaultStyle.fontSize = 7;
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
                                        }
                                        ],
                                        margin: [-270,25,0,0],
                                        alignment: 'left',
                                        width:130
                                    },
                                    {
                                        alignment: 'left',
                                         bold: true,
                                        text: from_date + '\n' + to_date + '\n Print Date '+' : ' + file_name,
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
                                        '10%',
                                        '5%',
                                        '5%',
                                        '10%',
                                        '5%',
                                        '5%',
                                        '10%',
                                        '5%',
                                        '5%',
                                        '10%',
                                        '10%',
                                        '10%',
                                        '10%'
                                        ]  
                        }
                    },
                {
                    extend: 'copy',
                    text: 'Copy',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true
                },
            {
                extend: 'print',
                text: 'Print all',
                footer: true,
                 title: $("#logo_text").text(),
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px">'+ dept_id + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+type,
                exportOptions: {
                    modifier: {
                        selected: null,
                       },

                },
           customize: function (win) {
                    $(win.document.body).find('th').addClass('display').css('text-align', 'left');
                    $(win.document.body).find('table').addClass('display').css({'font-size':'10px','font-weight':'bold'});
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
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px">'+ dept_id + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+type,
                 
                      customize: function (win) {
                    $(win.document.body).find('th').addClass('display').css('text-align', 'left');
                    $(win.document.body).find('table').addClass('display').css({'font-size':'10px','font-weight':'bold'});
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
            scrollY:        "500px",
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

            pageTotal1 = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api.column( 1 ).footer() ).html(
              pageTotal1 
              );


            pageTotal2 = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 2 ).footer() ).html(
                pageTotal2
            );

            pageTotal3 = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api.column( 3 ).footer() ).html(
              pageTotal3 
              );


            pageTotal4 = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 4 ).footer() ).html(
                pageTotal4
            );

            pageTotal5 = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api.column( 5 ).footer() ).html(
              pageTotal5 
              );


            pageTotal6 = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 6 ).footer() ).html(
                pageTotal6
            );

            pageTotal7 = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 7 ).footer() ).html(
                pageTotal7
            );

            pageTotal8 = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 8 ).footer() ).html(
                pageTotal8
            );
            

            pageTotal9 = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 9 ).footer() ).html(
                pageTotal9
            );


            pageTotal10 = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 10 ).footer() ).html(
                pageTotal10
            );


            pageTotal11 = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 11 ).footer() ).html(
                pageTotal11
            );



            pageTotal12 = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api.column( 12 ).footer() ).html(
                pageTotal12
            );




        }
        });


        // $('#sync').on('click',function(e){
        //         e.preventDefault();
        //         $.ajax({
        //         url:'<?php //echo base_url('login/syncAllOpdData') ?>',
        //         method:'POST',
        //         beforeSend:function(){
        //         $('#loading').css('display','block');
        //     },
        //         success:function(message)
        //         {
        //         $('#loading').css('display','none');
        //         location.reload();
        //         }
        //         })  
        //     })

       
    } );
    </script>