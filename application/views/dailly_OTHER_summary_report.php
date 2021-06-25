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
        Search Records
      </h1>
    </section>
    <section class="content">
    <div class="box box-primary">
    <div class="box-body">
    <div class="col-md-12">
    <div class="row">
    <div class="panel-body">

<?php 
$from = $to = $dept_id = '';

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

    <form method="post" action="<?php echo base_url('OTHER_Report/dailly_summary_report') ?>">

    	<div class="col-md-3">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="from" id="from"  value="<?php echo $from; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <label>To Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="to" id="to"  value="<?php echo $to; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        

        <div class="col-md-3">
            <label>Department:</label>
            <select class="form-control" name="dept_id" id="dept_id" required="required">
                <label>Report Filter</label>
                <option value="">Select Department</option>
                <?php
                    foreach ($getDept as $key) 
                    {
                ?>
                    <option value="<?php echo $key->id; ?>" <?php if($dept_id == $key->id) {echo 'selected';} ?>><?php echo $key->dep_name; ?></option>
                <?php
                    }
                ?>
            </select>
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



    <section class="content">
    <div class="box box-primary">
    <div class="box-body">
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
    <div class="table table-striped table-bordered table-responsive table-condensed" style="background-color: #e4e0e040;">
        <table id="example1" class="table table-hover table-bordered  table-condensed" style="width: 100%;">
		<thead>
            <tr style="background-color: #3c8dbc; color: #FFFFFF; font-weight: bold; text-align: center;">
                <th>Date</th>
                <th colspan="2" style="text-align: center;">Morning Serial</th>
                <th colspan="3" style="text-align: center;">Morning</th>
                <th colspan="2" style="text-align: center;">Evening Serial</th>
                <th colspan="3" style="text-align: center;">Evening</th>
                <th colspan="2" style="text-align: center;">Night Serial</th>
                <th colspan="3" style="text-align: center;">Night</th>
                <th colspan="2" style="text-align: center;">Serial</th>
                <th colspan="2" style="text-align: center;">Paid</th>
                <th style="text-align: center;">Total</th>
            </tr>
            <tr style="font-weight: bold; width: 100%;">
                <th style="text-align: center;">&nbsp;</th>
                <th style="text-align: center;">Start</th>
                <th style="text-align: center;">End</th>
                <th style="text-align: center;">Paid</th>
                <th style="text-align: center;">Free</th>
                <th style="text-align: center;">Total</th>
                <th style="text-align: center;">Start</th>
                <th style="text-align: center;">End</th>
                <th style="text-align: center;">Paid</th>
                <th style="text-align: center;">Free</th>
                <th style="text-align: center;">Total</th>
                <th style="text-align: center;">Start</th>
                <th style="text-align: center;">End</th>
                <th style="text-align: center;">Paid</th>
                <th style="text-align: center;">Free</th>
                <th style="text-align: center;">Total</th>
                <th style="text-align: center;">Start</th>
                <th style="text-align: center;">End</th>
                <th style="text-align: center;">Paid</th>
                <th style="text-align: center;">Free</th>
                <th style="text-align: center;">Total</th>
            </tr>

        </thead>
			

		<tbody>
            <?php 
            $monthYear = $monthN = $monthYear2 = $monthN2 = "";
            $startTime =strtotime($from);
            $endTime = strtotime($to);

for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
    $thisDate = date( 'Y-m-d', $i ); 

    $thisDate_from=date_create($thisDate);
    date_add($thisDate_from,date_interval_create_from_date_string("+8 HOUR"));
    $thisDate_from =  date_format($thisDate_from,"Y-m-d H:i:s");

    $thisDate_to=date_create($thisDate);
    date_add($thisDate_to,date_interval_create_from_date_string("+32 HOUR"));
    $thisDate_to = date_format($thisDate_to,"Y-m-d H:i:s");

    $userType = "";
    $is_admin=$this->session->userdata('is_admin');
    $user_id=$this->session->userdata('user_id');
    if($is_admin == 1)
    {
    $userType = "";
    } 
    else
    {
    $userType = "AND user_id='$user_id'";
    }

    if(!empty($dept_id)) {
          $dep = " AND dept_id='$dept_id'";
    } else {
         $dep = " AND dept_id='abc'";
    }

  $sql = "SELECT MIN(dated) AS date, 
        MIN(CASE WHEN shift='Morning' THEN `receptNumber` ELSE NULL END) AS MorningserialStart,
        MAX(CASE WHEN shift='Morning' THEN `receptNumber` ELSE NULL END) AS MorningserialEnd,
        MIN(CASE WHEN shift='Evening' THEN `receptNumber` ELSE NULL END) AS EveningserialStart,
        MAX(CASE WHEN shift='Evening' THEN `receptNumber` ELSE NULL END) AS EveningserialEnd,
        MIN(CASE WHEN shift='Night' THEN `receptNumber` ELSE NULL END) AS NightserialStart,
        MAX(CASE WHEN shift='Night' THEN `receptNumber` ELSE NULL END) AS NightserialEnd,
        COUNT(CASE WHEN type='Paid' AND shift='Morning' THEN `receptNumber` ELSE NULL END) AS MorningPaid,
        COUNT(CASE WHEN type!='Paid' AND shift='Morning' THEN `receptNumber` ELSE NULL END) AS MorningFree,
        COUNT(CASE WHEN shift='Morning' THEN `receptNumber` ELSE NULL END) AS TotalMorningOther,
        COUNT(CASE WHEN type='Paid' AND shift='Evening' THEN `receptNumber` ELSE NULL END) AS EveningPaid,
        COUNT(CASE WHEN type!='Paid' AND shift='Evening' THEN `receptNumber` ELSE NULL END) AS EveningFree,
        COUNT(CASE WHEN shift='Evening' THEN `receptNumber` ELSE NULL END) AS TotalEveningOther,
        COUNT(CASE WHEN type='Paid' AND shift='Night' THEN `receptNumber` ELSE NULL END) AS NightPaid,
        COUNT(CASE WHEN type!='Paid' AND shift='Night' THEN `receptNumber` ELSE NULL END) AS NightFree,
        COUNT(CASE WHEN shift='Night' THEN `receptNumber` ELSE NULL END) AS TotalNightOther,
        MIN(`receptNumber`) AS StartSerial,
        MAX(`receptNumber`) AS EndSerial,
        SUM(CASE WHEN UPPER(type) = 'Paid' THEN 1 ELSE 0 END) AS Paid,
        SUM(CASE WHEN UPPER(type) != 'Paid' THEN 1 ELSE 0 END) AS Free,
        COUNT(receptNumber) AS TotalShift 
        FROM other_entry WHERE `id`!='' AND `is_deleted`=0 ".$userType." ".$dep."";

    if($thisDate_from!='' && $thisDate_to!='') {
              $sql.=" AND date >= '$thisDate_from' and date <'$thisDate_to'"; 
      }

      
     $query=$this->db->query($sql);
     $result_array = $query->row();
     if ( $result_array->TotalShift >0) {
       $monthName = explode('-', $thisDate);
       if ($monthYear!=$monthName[0].'-'.$monthName[1]) {
           $monthYear = $monthName[0].'-'.$monthName[1];

  ?>
  <tr style="text-align: center; background-color: #3c8dbc; font-weight: bold; width: 100%; font-family: monospace; color: #FFFFFF;">
      <td>
        <?php 
        $monthN = explode('-', $monthYear);
        echo date("F", mktime(0, 0, 0, $monthN[1], 10)); 
        ?>
    </td>
      <td></td><td></td><td></td><td></td><td></td><td></td>
      <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
      <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
<?php } ?>
            <tr style="font-weight: bold; width: 100%;">
                <td style="text-align: center;"><?php echo $thisDate; ?></td>

                <td style="text-align: center;"><?php echo $result_array->MorningserialStart; ?></td>
                <td style="text-align: center;"><?php echo $result_array->MorningserialEnd; ?></td>

                <td style="text-align: center;"><?php echo $result_array->MorningPaid; ?></td>
                <td style="text-align: center;"><?php echo $result_array->MorningFree; ?></td>
                <td style="text-align: center;"><?php echo $result_array->TotalMorningOther; ?></td>
                
                <td style="text-align: center;"><?php echo $result_array->EveningserialStart; ?></td>
                <td style="text-align: center;"><?php echo $result_array->EveningserialEnd; ?></td>

                <td style="text-align: center;"><?php echo $result_array->EveningPaid; ?></td>
                <td style="text-align: center;"><?php echo $result_array->EveningFree; ?></td>
                <td style="text-align: center;"><?php echo $result_array->TotalEveningOther; ?></td>

                <td style="text-align: center;"><?php echo $result_array->NightserialStart; ?></td>
                <td style="text-align: center;"><?php echo $result_array->NightserialEnd; ?></td>

                <td style="text-align: center;"><?php echo $result_array->NightPaid; ?></td>
                <td style="text-align: center;"><?php echo $result_array->NightFree; ?></td>
                <td style="text-align: center;"><?php echo $result_array->TotalNightOther; ?></td>

                <td style="text-align: center;"><?php echo $result_array->StartSerial; ?></td>
                <td style="text-align: center;"><?php echo $result_array->EndSerial; ?></td>
                
                <td style="text-align: center;"><?php echo $result_array->Paid; ?></td>               
                <td style="text-align: center;"><?php echo $result_array->Free; ?></td>

                <td style="text-align: center;"><?php echo $result_array->TotalShift; ?></td>
            </tr>
            <?php  }  } ?>
        
        </tbody>
        <tfoot>
            <tr style="background-color: green; color: #FFFFFF; width: 100%;">
                <td style="text-align: center;">Total</td>
                <td style="text-align: center;">---</td>
                <td style="text-align: center;">---</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">---</td>
                <td style="text-align: center;">---</td>
                <td style="text-align: center;">0</td> 
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">---</td>
                <td style="text-align: center;">---</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">---</td>
                <td style="text-align: center;">---</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">0</td>
                <td style="text-align: center;">0</td>              
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
                  dept_id = 'Department : '+$("#dept_id option:selected").html().replace(/\s/g, '')+' OPD';   
            } else {
                  dept_id = 'Department :  All OTHER Departments';
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
        paging:   false,
        ordering: false,
        info:     false,
        dom: 'Bfrtip',
        fixedHeader: true,
        buttons: [
          {
              extend: 'pdf',
              text: 'PDF',
              filename : file_name,
              orientation : 'landscape',
              pageSize : 'LEGAL',
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
                                        text: from_date+'\n',
                                        bold: true,
                                        fontSize: 10
                                        },
                                        {
                                        text: to_date+'\n',
                                        bold: true,
                                        fontSize: 10
                                        },
                                        {
                                        text: 'Print Date '+' : '+file_name,
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
                                        text: dept_id,
                                        fontSize: 10,
                                        width:300,
                                        margin: [0,47,0,0]
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
                        // doc.content[0].layout.fontSize=[7];
                            // doc.content[0].table.widths = [
                            //             '5%',
                            //             '11%',
                            //             '15%',
                            //             '10%',
                            //             '12%',
                            //             '22%',
                            //             '9%',
                            //             '10%',
                            //             '6%'
                            //             ]  
                }
          },
          {
              extend: 'copy',
              text: 'Copy',
              filename : file_name,
              footer: true,
          },
          {
              extend: 'csv',
              text: 'CSV',
              footer: true,
              filename : file_name,
          },
          {
              extend: 'excel',
              text: 'Excel',
              filename : file_name,
              footer: true,
          },
          {
                extend: 'print',
                text: 'Print all',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                footer: true,
                 title: $("#logo_text").text(),
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">'+ dept_id,
                exportOptions: {
                    //columns: [0,1,2,3,4,5,6,7,8],
                    modifier: {
                        selected: null,
                       },

                },
           customize: function (win) {
                    $(win.document.body).find('th').addClass('display').css('text-align', 'left');
                    $(win.document.body).find('table').addClass('display').css({'font-size':'10px','font-weight':'bold'});
                    $(win.document.body).find('table').css({"position": "absolute", "top": "10%","left":"0"});
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
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">'+ dept_id,
                 exportOptions: {
                    //columns: [0,1,2,3,4,5,6,7,8],
                    
                    },
                      customize: function (win) {
                    $(win.document.body).find('th').addClass('display').css('text-align', 'left');
                    $(win.document.body).find('table').addClass('display').css({'font-size':'10px','font-weight':'bold'});
                    $(win.document.body).find('table').css({"position": "absolute", "top": "10%","left":"0"});
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


            pageTotal13 = api
                .column( 13, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api.column( 13 ).footer() ).html(
              pageTotal13 
              );


            pageTotal14 = api
                .column( 14, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 14 ).footer() ).html(
                pageTotal14
            );

            pageTotal15 = api
                .column( 15, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 15 ).footer() ).html(
                pageTotal15
            );

            pageTotal18 = api
                .column( 18, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( api.column( 18 ).footer() ).html(
              pageTotal18 
              );


            pageTotal19 = api
                .column( 19, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 19 ).footer() ).html(
                pageTotal19
            );

            pageTotal20 = api
                .column( 20, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 20 ).footer() ).html(
                pageTotal20
            );
            
        }
      });

       
    } );
    </script>