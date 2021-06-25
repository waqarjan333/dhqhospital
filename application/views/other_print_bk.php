<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <style type="text/css">
    .center-block {
      width: 60%;
      padding:10px;
      background-color:#eceadc;
    }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
 

    <div class="container">
    <div class="row">
    <div class="center-block">
      <h2 style="text-align: center; text-decoration: underline; margin-bottom: 30px;">DHQ HOSPITAL BATKHELA</h2>
      <div style="width: 100%; border: 1px solid black;  margin-bottom: 20px;"></div>
      <?php foreach($query->result() as $row ){ if($name!=$row->patient_name){ ?>
<table style="width:100%; margin-bottom: 20px;">
  <tr>
    <td align="left" style="font-weight: bold;">Name</td>
    <td align="left" style="text-decoration: underline;"><?php echo $name = $row->patient_name; ?></td>
    <td align="left" style="font-weight: bold;">Recept #</td>
    <td align="left" style="text-decoration: underline;"><?php echo  $nick[0]['dept_nick'];?>-<?php echo $row->receptNumber; ?></td>
  </tr>
  <tr>
    <td align="left" style="font-weight: bold;">Address</td>
    <td align="left" style="text-decoration: underline;"><?php echo $row->dis_name; ?></td>
    <td align="left" style="font-weight: bold;">Gander</td>
    <td align="left"  style="text-decoration: underline;"><?php echo $row->gander; ?></td>
  </tr>
  <tr>
    <td align="left" style="font-weight: bold;">Date </td>
    <td align="left"  style="text-decoration: underline;"><?php $old_time = $row->date; $old_time_timestamp = strtotime($old_time); $new_time = date('d-M-Y h:i A', $old_time_timestamp); echo $new_time;  ?></td>
    <td align="left" style="font-weight: bold;">Age</td>
    <td align="left"  style="text-decoration: underline;"><?php echo $row->age; ?></td>
  </tr>

  <?php
    $this->db->select('dep_name');
    $this->db->from('departments');
    $this->db->where('id',$row->dept_id);
    $dep_name = $this->db->get()->result_array();
  ?>

  <tr>
    <td align="left" style="font-weight: bold;">Department </td>
    <td align="left"  style="text-decoration: underline;"><?php echo $dep_name[0]['dep_name'] ?></td>
  </tr>

</table>
<div style="width: 100%; border: 1px solid black;"></div>
<?php $name = $row->patient_name; } ?>
    <table class="table table-striped">
      
  <thead>
    
    <tr>
      <?php $abc = "UNIT";  if($abc != $unit_name){ ?>
      <th width="65%"><?php echo $unit_name = $abc; ?></th>
      <th width="35%">CHARGE</th> 
      <?php $abc = $unit_name; } ?>
    </tr> 
  </thead>

  <tbody>
    <tr>
      <th width="65%"><?php echo $row->cat_name; ?></th>
      <th width="35%"><?php echo $row->price; ?></th>
    </tr>
  </tbody>
</table>
<?php } ?>

    </div>

    </div>
    <div style="width: 35%; float: right; border: 1px; margin-top: 20px;">
      <p style="font-family: monospace; font-weight: bold;">Powered & Developed By<br>
      Aursoft Private (LTD)<br>
      www.aursoft.com<br>
      03439176964</p>
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
$(function() {
    
    var pri=document.getElementById('container');
    window.print(pri);
    window.close();
  });

</script>
  </body>
</html>