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
        Laboratory
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laboratory Records</li>
      </ol>
    </section>

    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
<?php 
$from = $to = $shift = $gander = $dept_id = $type = '';

if($this->input->post('from')!='')
$from = $this->input->post('from');
else
$from = date('m/d/Y');

if($this->input->post('to')!='')
$to = $this->input->post('to');
else
$to = date('m/d/Y');

if($this->input->post('shift')!='')
$shift = $this->input->post('shift');

if($this->input->post('gander')!='')
$gander = $this->input->post('gander');

if($this->input->post('type')!='')
$type = $this->input->post('type');

if($this->input->post('dept_id')!='')
$dept_id = $this->input->post('dept_id');
?>
    <form method="post" action="<?php echo base_url('LAB_Report/all_report') ?>">

        <div class="col-md-2">
            <label>From Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="from" required autocomplete="off" value="<?php echo $from; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div></br>
        </div>

        <div class="col-md-2">
            <label>To Date</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control" name="to" required autocomplete="off" value="<?php echo $to; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div></br>
        </div>

                <div class="col-md-2">
            <label>Shift:</label>
            <select id="shift" name="shift" class="form-control">
                <option value="" >Select Shift</option>                 
                <option value="Morning" <?php if($shift == 'Morning') {echo 'selected';} ?> id="Morning">Morning
                </option>
                <option value="Evening" <?php if($shift == 'Evening') {echo 'selected';} ?> id="Evening">Evening
                </option>
                <option value="Night" <?php if($shift == 'Night') {echo 'selected';} ?> id="Night">Night
                </option>
            </select>
            <br />
        </div>

        <div class="col-md-2">
            <label>Gender:</label>
            <select class="form-control" id="gander" name="gander">
                <option value="">Select Gender</option>
                <option value="Male" <?php if($gander == 'Male') {echo 'selected';} ?>>Male
                </option>
                <option value="Female" <?php if($gander == 'Female') {echo 'selected';} ?>>Female
                </option>
            </select><br />
        </div>

        <div class="col-md-2">
            <label>Department:</label>
            <select class="form-control" name="dept_id" id="dept_id">
                <label>Report Filter</label>
                <option value="" selected="" disabled="">Select Department</option>
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

        <div class="col-md-2">
             <label>Type:</label>
            <select class="form-control" id="type" name="type">
                <option value="">Select Type</option>
                <option value="Paid" <?php if($type == 'Paid') {echo 'selected';} ?>>Paid</option>
                <option value="Casualty" <?php if($type == 'Casualty') {echo 'selected';} ?>>Casualty</option>
                <option value="Ward" <?php if($type == 'Ward') {echo 'selected';} ?>>Ward</option>
                <option value="Labour_Room" <?php if($type == 'Labour_Room') {echo 'selected';} ?>>Labour Room</option>
                <option value="Entitled" <?php if($type == 'Entitled') {echo 'selected';} ?>>Entitled</option>
            </select>
        </div>


        
        <div class="col-md-12">
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

            $sql_lab_test = "SELECT * FROM `lab_entry_details` INNER JOIN testcategories On(lab_entry_details.test_id = testcategories.id) AND lab_entry_details.entry_id= '$row->receptNumber' WHERE lab_entry_details.is_deleted=0 AND lab_entry_details.dept_id= '$row->dept_id' AND lab_entry_details.yearly=".$row->yearly_no;

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
                 <td style="color: green"><?php echo $row->price; ?></td>
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
               <td>&nbsp;</td> <td>&nbsp;</td> 
               <td>0</td>
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
     //    $(function () {
        // $('#example1').DataTable({
        //   'paging'      : true,
        //   'lengthChange': true,
        //   'searching'   : true,
        //   'ordering'    : true,
        //   'info'        : true,
        //   'autoWidth'   : false,
        //   'stateSave'   : true
        // })
        // });
$(document).on("click",".lab-invoice",function(){

  var entryid=$(this).data('entryid');
  var yearly_no=$(this).data('yearly_no');
  var dept_id=$(this).data('dept_id');

  $.ajax({
    method:"post",
    url:'<?php echo base_url('LAB_Report/get_invoice') ?>',
    data:{entryid:entryid,yearly_no:yearly_no,dept_id:dept_id},
    beforeSend:function(){
        $('#loading').css('display','block');
    },
    success:function(data){
      $('#entry_modal').html(data);
      $('#loading').css('display','none');
      /*var url_for_login=full_path+"admin/user-login-from-admin/"+data.token_for_admin_login+'/'+data.user_id;
      $("#login_url").val(url_for_login);*/
      $("#modal-default").modal("show");
    // alert(data);
    },error: function(response) {
            console.log(response);
        }
  });
});

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
                  dept_id = 'Department : '+$("#dept_id option:selected").html().replace(/\s/g, '');   
            } else {
                  dept_id = 'Department :  LAB Departments';
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
        paging:   false,
        ordering: false,
        info:     false,
        dom: 'Bfrtip',
        buttons: [
            {
                    text: 'PDF',
                    extend:'pdfHtml5',
                    title:$("#logo_text").text(),
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
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
                        objLayout['paddingLeft'] = function(i) { return 5; };
                        objLayout['paddingRight'] = function(i) { return 10; };
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
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    filename : $("#dept_id option:selected").html().replace(/\s/g, '')+'-'+file_name,
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
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px">'+ dept_id + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + shift+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+gander+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+type,
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
                 messageTop: '<p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +from_date +'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">' +to_date+'</p><p style="font-size:13px;margin-left:150px;margin-top:-10px;">Print Date : ' +file_name+'</p><p style="font-size:13px;margin-left:150px">'+ dept_id + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + shift+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+gander+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+type,
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
            scrollY:        "500px",
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

            pageTotal2 = api.rows({ page: 'current' }).count();
            $( api.column( 0 ).footer() ).html(
                pageTotal2
            );
            
        }
        });


        $('#sync').on('click',function(e){
                e.preventDefault();
                $.ajax({
                url:'<?php echo base_url('login/syncAllOpdData') ?>',
                method:'POST',
                beforeSend:function(){
                $('#loading').css('display','block');
            },
                success:function(message)
                {
                $('#loading').css('display','none');
                location.reload();
                }
                })  
            })

       
    } );
    </script>