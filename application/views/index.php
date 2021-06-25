<!DOCTYPE html>
<html>
<?php
include_once("head.php");
include_once("foot.php");
include_once("header.php");
include_once("sidebar.php");
?>
<body class="hold-transition skin-blue sidebar-mini">
<div id="loading"></div>

<div id="contents">

    
<div class="wrapper">
 
<div class="content-wrapper">

<?php 
  include_once $page_name.'.php';
?>

</div>
 
<!-- <div class="control-sidebar-bg">
</div> -->
</div>
</div>
<!-- ./wrapper -->
<?php
include_once("footer.php");
?>

</body>
</html>