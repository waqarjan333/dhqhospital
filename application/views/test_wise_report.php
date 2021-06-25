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
        Date Wise Record
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
$from = $to = $test_id = $dept_id = '';

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

?>

    <form method="post" action="<?php echo base_url('LAB_Report/test_wise_report') ?>">

        <div class="col-md-3">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="from" id="from" value="<?php echo $from; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
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
            <select class="form-control" name="dept_id" id="dept_id" required="">
                <label>Report Filter</label>
                <option selected="" disabled="">Select Department</option>
                <?php
                    foreach ($getDept as $key) 
                    {
                ?>
                    <option <?php if($dept_id==$key->id){ echo "selected"; } ?> value="<?php echo $key->id; ?>"><?php echo $key->dep_name; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label>Lab Test:</label>
            <select name="test_id[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Test">  
              <option value="">Select A Test</option>
           <?php foreach ($tests as $test) { ?>
                    <option value="<?php echo $test->id; ?>"><?php echo $test->name; ?></option>
                <?php } ?>
            </select>
            <br />
        </div>
        
        <div class="col-md-12" style="margin-top: 15px;">
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



    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
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
    <div class="table table-striped table-bordered table-responsive" style="width: 100%; background-color: #e4e0e040; margin-top: 10px;">
        <table id="example1" class="table table-hover table-bordered" style="width: 100%;">
        <thead>
              <tr style="background-color: #3c8dbc; color: #FFFFFF; font-weight: bold; text-align: left;">
                <td width="16%">Test Name</td>
                <td width="14%" colspan="2">Wards</td>
                <td width="14%" colspan="2">Casualty</td>
                <td width="14%" colspan="2">Labour Room</td>
                <td width="14%" colspan="2">Entitled</td>
                <td width="14%" colspan="2">Paid</td>
                <td width="14%" colspan="2">Total</td>
            
            </tr>
            <tr style="font-weight: bold; text-align: left;">
                <td width="16%">Test Name</td>
                 <td width="7%">Count</td><td width="7%">Amount</td>
                 <td width="7%">Count</td><td width="7%">Amount</td>
                 <td width="7%">Count</td><td width="7%">Amount</td>
                 <td width="7%">Count</td><td width="7%">Amount</td>
                 <td width="7%">Count</td><td width="7%">Amount</td>
                 <td width="7%">Count</td><td width="7%">Amount</td>               
            </tr>

        </thead>

        <tbody>
            <?php  

            foreach ($query as $result_array) { 

                $from1=date_create($from_date);
                date_add($from1,date_interval_create_from_date_string("+8 HOUR"));
                $from1 =  date_format($from1,"Y-m-d H:i:s");



                $to1=date_create($to_date);
                date_add($to1,date_interval_create_from_date_string("+32 HOUR"));
                $to1 = date_format($to1,"Y-m-d H:i:s");

                if(isset($dept_id) && !empty($dept_id)){
                      $dept =" AND `dept_id` =".$dept_id; 
                  }

                $Ward_sql = "SELECT COUNT(test_id) AS Count FROM `lab_entry_details`  WHERE `types`='Ward' AND `is_deleted`=0 AND date>='$from1' AND date<'$to1' AND test_id=".$result_array->test_id.$dept;
                $Ward_query = $this->db->query($Ward_sql)->result_array();

                $Casualty_sql = "SELECT COUNT(test_id) AS Count FROM `lab_entry_details`  WHERE `types`='Casualty' AND `is_deleted`=0 AND date>='$from1' AND date<'$to1' AND test_id=".$result_array->test_id.$dept;
                $Casualty_query = $this->db->query($Casualty_sql)->result_array();

                $LRoom_sql = "SELECT COUNT(test_id) AS Count FROM `lab_entry_details`  WHERE `types`='Labour_Room' AND `is_deleted`=0 AND date>='$from1' AND date<'$to1' AND test_id=".$result_array->test_id.$dept;
                $LRoom_query = $this->db->query($LRoom_sql)->result_array();

                $Entitled_sql = "SELECT COUNT(test_id) AS Count FROM `lab_entry_details`  WHERE `types`='Entitled' AND `is_deleted`=0 AND date>='$from1' AND date<'$to1' AND test_id=".$result_array->test_id.$dept;
                $Entitled_query = $this->db->query($Entitled_sql)->result_array();

                $Paid_sql = "SELECT COUNT(test_id) AS Count FROM `lab_entry_details`  WHERE `types`='Paid' AND `is_deleted`=0 AND date>='$from1' AND date<'$to1' AND test_id=".$result_array->test_id.$dept;
                $Paid_query = $this->db->query($Paid_sql)->result_array();

                $Total_sql = "SELECT COUNT(test_id) AS Count FROM `lab_entry_details`  WHERE `is_deleted`=0 AND date>='$from1' AND date<'$to1' AND test_id=".$result_array->test_id.$dept;
                $Total_query = $this->db->query($Total_sql)->result_array();

            ?>
  
            <tr style="font-weight: bold; text-align: left;">
                <td width="16%"><?php echo $result_array->test_name; ?></td>

                <td width="7%"><?php echo $Ward_query[0]['Count']; ?></td>
                <td width="7%"><?php echo $Ward_query[0]['Count']*$result_array->test_price; ?></td>
                
                <td width="7%"><?php echo $Casualty_query[0]['Count']; ?></td>
                <td width="7%"><?php echo $Casualty_query[0]['Count']*$result_array->test_price; ?></td>

                <td width="7%"><?php echo $LRoom_query[0]['Count']; ?></td>
                <td width="7%"><?php echo $LRoom_query[0]['Count']*$result_array->test_price; ?></td>

                <td width="7%"><?php echo $Entitled_query[0]['Count']; ?></td>
                <td width="7%"><?php echo $Entitled_query[0]['Count']*$result_array->test_price; ?></td>
                
                <td width="7%"><?php echo $Paid_query[0]['Count']; ?></td>
                <td width="7%"><?php echo $Paid_query[0]['Count']*$result_array->test_price; ?></td>

                <td width="7%"><?php echo $Total_query[0]['Count']; ?></td>
                <td width="7%"><?php echo $Total_query[0]['Count']*$result_array->test_price; ?></td> 
            </tr>
            <?php  } ?>
          
        </tbody>
        <tfoot>
            <tr style="background-color: green; color: #FFFFFF;">
                <td width="16%">Total</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>
                <td width="7%">0</td>            
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
                  dept_id = 'Department : '+$("#dept_id option:selected").html().replace(/\s/g, '');   
            } else {
                  dept_id = 'Department :  LAB Departments';
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


        $('#example1').DataTable({
        paging:   false,
        ordering: false,
        info:     false,
        dom: 'Bfrtip',
        fixedHeader: true,
        buttons: [
          {
                    text: 'PDF',
                    extend:'pdfHtml5',
                    title:$("#logo_text").text(),
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
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
                                            text: dept_id+'\n',
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
                        objLayout['paddingLeft'] = function(i) { return 5; };
                        objLayout['paddingRight'] = function(i) { return 5; };
                        doc.content[0].layout = objLayout;
                            doc.content[0].table.widths = [
                                        '16%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%',
                                        '7%'
                                        ]  
                }
            },
                {
                    extend: 'copy',
                    text: 'Copy',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        
                    },
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        
                    }
                },
            {
                extend: 'print',
                text: 'Print all',
                footer: true,
                 title: $("#logo_text").text(),
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px">'+ dept_id,
                exportOptions: {
                    
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
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px">'+ dept_id,
                 exportOptions: {
                    
                    
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
            $( api.column( 11 ).footer() ).html(
              pageTotal11 
              );


            pageTotal12 = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 12 ).footer() ).html(
                pageTotal12
            );


            
        }
      });

       
    } );
    </script>