<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/exporting.js"></script>
<script src="<?php echo base_url();?>assets/js/export-data.js"></script>
<script src="<?php echo base_url();?>assets/js/data.js"></script>
<script src="<?php echo base_url();?>assets/js/drilldown.js"></script>
<?php 
$from = $to = $type = '';

if($this->input->post('from')!='')
$from = $this->input->post('from');
else
$from = date('m/d/Y');

if($this->input->post('to')!='')
$to = $this->input->post('to');
else
$to = date('m/d/Y');

if($this->input->post('type')!='')
$type = $this->input->post('type');
else
$type = "All";
?>
<section class="content-header">
      <h4 style="text-transform: uppercase;"><?php echo $message; ?></h4>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/Home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body" style="width: 100%;">
                <div class="col-md-12">
                    <div class="row">
                        <div class="panel-body">
                            <form method="post" action="<?php echo base_url('Dashboard/') ?>">
                                <div class="col-md-3">
                                    <label>From Date</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" name="from" id="from" value="<?php echo $from; ?>">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div></br>
                                </div>

                                <div class="col-md-3">
                                    <label>To Date</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" name="to" id="to" value="<?php echo $to; ?>">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div></br>
                                </div>

       

                                <div class="col-md-3">
                                    <label>Type:</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="All" <?php if($type == 'All') {echo 'selected';} ?>>All</option>
                                        <option value="Paid" <?php if($type == 'Paid') {echo 'selected';} ?>>Paid</option>
                                        <option value="Free" <?php if($type == 'Free') {echo 'selected';} ?>>Free</option>
                                    </select>
                                </div>

        
        
                                <div class="col-md-3" style="margin-top: 25px;">
                                <div align="center">
                                    <input type="submit" name="search" value="Advance Search" class="btn btn-success"  />
                                </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
$date = date('m/d/Y');
    $thisDate_from=date_create($from);
    date_add($thisDate_from,date_interval_create_from_date_string("+8 HOUR"));
    $thisDate_from =  date_format($thisDate_from,"Y-m-d H:i:s");

    $thisDate_to=date_create($to);
    date_add($thisDate_to,date_interval_create_from_date_string("+32 HOUR"));
    $thisDate_to = date_format($thisDate_to,"Y-m-d H:i:s");
$opd_query=$this->db->query("SELECT COUNT( * ) AS opd_count, opd.dept_id AS dept_id, dept.dep_name AS dept_name
                FROM `opd_entry` AS opd
                LEFT JOIN `departments` AS dept ON ( opd.dept_id = dept.id )
                WHERE opd.date >= '$thisDate_from'
                AND opd.date < '$thisDate_to'
                GROUP BY opd.`dept_id`");
$opd_result = $opd_query->result();


$other_query=$this->db->query("SELECT COUNT( * ) AS other_count, other.dept_id AS dept_id, dept.dep_name AS dept_name
                FROM `other_entry` AS other
                LEFT JOIN `departments` AS dept ON ( other.dept_id = dept.id )
                WHERE other.date >= '$thisDate_from'
                AND other.date < '$thisDate_to'
                GROUP BY other.`dept_id`");
$other_result = $other_query->result();


?>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
    <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                <?php if(count($opd_result)>0) { foreach ($opd_result as $opd_row) { ?>
                  <p><?php echo $opd_row->dept_name; ?> : <?php echo $opd_row->opd_count; ?></p>
                <?php } } else { echo "<p><b>No OPD Record Found</b></p>"; } ?>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <!-- for customers -->
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                <?php if(count($other_result)>0) { foreach ($other_result as $other_row) { ?>
                  <p><?php echo $other_row->dept_name; ?> : <?php echo $other_row->other_count; ?></p>
                <?php } } else { echo "<p><b>No OTHER Record Found</b></p>"; } ?>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <!-- ./col -->
      
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php  //echo $total_other_entry; ?></h3>
              <p><b>Today Other Enteries</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-medkit"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php //echo $total_sub_departement; ?></h3>
              <p><b>Sub Departments</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-hospital-o"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <!-- ./col -->
    </div>
     <!-- /.row -->

    <div class="row">
      <div class="col-lg-6 col-xs-6">
        <?php 
        $sql="SELECT COUNT(*) as entry ,d.dep_name 
        FROM `opd_entry` as o 
        LEFT JOIN departments as d on(o.dept_id=d.id) 
        And d.view = 'OPD'
        GROUP by o.dept_id";
        $query_data_opd=$this->db->query($sql);
        ?>
        <div id="opd_pie_container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <script type="text/javascript">
        // Build the chart
        Highcharts.chart('opd_pie_container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'OPD DEPARTMENTS'
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Department',
        colorByPoint: true,
        data: [<?php foreach ($query_data_opd->result() as $k) {
  ?>
                {
                    name: "<?php echo $k->dep_name;?>",
                    y: <?php echo $k->entry;?>
                },
<?php }?>]
    }]
});
  </script>
      </div>
      <div class="col-lg-6 col-xs-6">
        <?php 
        $sql="SELECT COUNT(*) as entry ,d.dep_name 
        FROM `other_entry` as o 
        LEFT JOIN departments as d on(o.dept_id=d.id) 
        And d.view = 'OTHER'
        And d.parent_id = '0'
        GROUP by o.dept_id";
        $query_data_opd=$this->db->query($sql);
        ?>
        <div id="other_pie_container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <script type="text/javascript">
        // Build the chart
        Highcharts.chart('other_pie_container', {
        chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'OTHER DEPARTMENTS'
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Department',
        colorByPoint: true,
        data: [<?php foreach ($query_data_opd->result() as $k) {
  ?>
                {
                    name: "<?php echo $k->dep_name;?>",
                    y: <?php echo $k->entry;?>
                },
<?php }?>]
    }]
});
  </script>
      </div>
    </div>
    <div class="row" style="margin-top: 10px;">
      <div class="col-lg-12 col-xs-12">
        
 <?php 
        $other_main_series = '';
        
        $other_main_series .= '
        {
            name: "Department",
            colorByPoint: true,
            data: [';


        $other_drilldown_series = '';


        $sql_other="SELECT COUNT(*) as entry ,d.id as dept_id,d.dep_name as dept_title 
        FROM `other_entry` as o 
        INNER JOIN departments as d on(o.dept_id=d.id) 
        And d.view = 'OTHER'
        And d.parent_id = '0'
        GROUP by o.dept_id";
        $query_data_other=$this->db->query($sql_other);
        foreach ($query_data_other->result() as $k) {
        $other_main_series .= '
               {
                    name: "'.$k->dept_title.'",
                    y: '.$k->entry.',
                    drilldown: "'.$k->dept_title.'"
                },';



       

        $sql_other_subdepart="SELECT COUNT(*) as entry ,d.dep_name as
        sub_dept  FROM `other_entry` as o  INNER JOIN departments as d
        on(o.sub_dept_id=d.id)  And d.view = 'OTHER' And d.parent_id =
        '".$k->dept_id."' GROUP by o.sub_dept_id";
        $res_osubdept=$this->db->query($sql_other_subdepart);
        if($res_osubdept->num_rows() > 0) {
        $other_drilldown_series .= '{ name: "'.$k->dept_title.'", id:
        "'.$k->dept_title.'", data: ['; foreach
        ($res_osubdept->result() as $k_sub) {          
                    $other_drilldown_series .= '[
                        "'.$k_sub->sub_dept.'",
                        '.$k_sub->entry.'
                    ],';  
        }

        $other_drilldown_series .= ']
            },';
        

        }
        
        }
        $other_main_series .= ']}';
         //echo $other_main_series.'<br>';
         //echo  $other_drilldown_series;
  ?>

<div id="container_other_dept" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <script type="text/javascript">// Create the chart
Highcharts.chart('container_other_dept', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'OTHER DEPARTMENTS'
    },
    subtitle: {
        text: 'Click the columns to view Sub Department.'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Entry Report'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },
    tooltip: {
     headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },
    series: [<?php echo $other_main_series; ?>],
    drilldown: {
        series: [<?php echo $other_drilldown_series; ?>

/*            {
                name: "Chrome",
                id: "Chrome",
                data: [
                    [
                        "v65.0",
                        0.1
                    ],
                    [
                        "v64.0",
                        1.3
                    ]
                ]
            },
            {
                name: "Firefox",
                id: "Firefox",
                data: [
                    [
                        "v58.0",
                        1.02
                    ],
                    [
                        "v57.0",
                        7.36
                    ],
                    [
                        "v56.0",
                        0.35
                    ],
                    [
                        "v55.0",
                        0.11
                    ],
                    [
                        "v54.0",
                        0.1
                    ],
                    [
                        "v52.0",
                        0.95
                    ],
                    [
                        "v51.0",
                        0.15
                    ],
                    [
                        "v50.0",
                        0.1
                    ],
                    [
                        "v48.0",
                        0.31
                    ],
                    [
                        "v47.0",
                        0.12
                    ]
                ]
            },
            {
                name: "Internet Explorer",
                id: "Internet Explorer",
                data: [
                    [
                        "v11.0",
                        6.2
                    ],
                    [
                        "v10.0",
                        0.29
                    ],
                    [
                        "v9.0",
                        0.27
                    ],
                    [
                        "v8.0",
                        0.47
                    ]
                ]
            },
            {
                name: "Safari",
                id: "Safari",
                data: [
                    [
                        "v11.0",
                        3.39
                    ],
                    [
                        "v10.1",
                        0.96
                    ],
                    [
                        "v10.0",
                        0.36
                    ],
                    [
                        "v9.1",
                        0.54
                    ],
                    [
                        "v9.0",
                        0.13
                    ],
                    [
                        "v5.1",
                        0.2
                    ]
                ]
            },
            {
                name: "Edge",
                id: "Edge",
                data: [
                    [
                        "v16",
                        2.6
                    ],
                    [
                        "v15",
                        0.92
                    ],
                    [
                        "v14",
                        0.4
                    ],
                    [
                        "v13",
                        0.1
                    ]
                ]
            },
            {
                name: "Opera",
                id: "Opera",
                data: [
                    [
                        "v50.0",
                        0.96
                    ],
                    [
                        "v49.0",
                        0.82
                    ],
                    [
                        "v12.1",
                        0.14
                    ]
                ]
            }*/
        ]
    }
});</script>
      </div>
    </div>