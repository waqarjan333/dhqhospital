<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<style type="text/css">
    table tr {
    height: 8px !important;
    font-size: 12px;
}
.content {
    min-height: 120px !important;
    padding: 0px!important;
}
table.dataTable tbody tr, table.dataTable thead tr, table.dataTable tfoot tr {
  font-size: 9px;
}
</style>
    <section class="content-header">
      <h1 class="text-success">
        Laboratory
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"> /</i> Home</a></li>
        / <li class="active">Test Result Entry</li>
      </ol>
    </section>
    <section class="content" style="margin-top: 5px;">
    <div class="box box-primary">
    <div class="box-body" style="width: 100%;">
    <div class="col-md-12" style="margin-top: 5px;">
    <div class="row">
    <div class="panel-body">
     <table class="table table-bordered table-condensed">
        <?php

        $parent_category='';
        $subtest_category='';
         $sql = "SELECT lab.*,test.name AS parent_cat,subtest.name AS sub_cat,adds.name AS test_name FROM `lab_entry_details` lab INNER JOIN testcategories test On(lab.test_id = test.id) LEFT JOIN testcategories subtest ON (subtest.parent_id=test.id) LEFT JOIN add_tests adds ON (adds.sub_cat_id=subtest.id) AND lab.entry_id= '1' WHERE lab.is_deleted=0 AND lab.yearly=20 ORDER BY lab.test_id,subtest.id ASC"; 
                    $query_lab_test = $this->db->query($sql);
foreach($query_lab_test->result() as $row_lab_test){
        if($parent_category !=$row_lab_test->parent_cat)
        {
            $parent_category=$row_lab_test->parent_cat;
        ?>

         <tr>
<th align="left" colspan="4" style="font-family: 'Arial Narrow', Arial, sans-serif;font-size:18px;font-weight: 600; background-color:#ccc;text-transform:uppercase;">
          <?php echo $parent_category ?>  
            </th>
         </tr>
         <?php
         } 
         $abc = "TEST NAME";
        if($abc != $name){
         ?>
<tr>
<td width="30%" style="font-family: 'Arial Narrow', Arial, sans-serif;font-size:18px;font-weight: 400;text-align:left;"><strong><?php echo $name = $abc; ?>
</strong></td>
<td width="20%" style="font-family: 'Arial Narrow', Arial, sans-serif;font-size:18px;font-weight: 400;text-align:center;"><strong>RESULT</strong></td>
<td width="20%" style="font-family: 'Arial Narrow', Arial, sans-serif;font-size:18px;font-weight: 400;text-align:left;"><strong>UNIT</strong></td>
<td width="30%" style="font-family: 'Arial Narrow', Arial, sans-serif;font-size:18px;font-weight: 400;text-align:left;"><strong>REF.VALUE</strong></td>
</tr>
<?php } if($subtest_category !=$row_lab_test->sub_cat){ $subtest_category=$row_lab_test->sub_cat; ?>
      <tr style="font-size:15px;font-family: 'Arial Narrow', Arial, sans-serif padding-bottom:5px; padding-

top:5px;background-color:#F5F5F5;">
            <td align="left" ><?php echo $subtest_category; ?></td>

<td colspan="3"></td>
        </tr>
    <?php } ?>
           <tr id="xyz">
            <td width="30%" style="font-family: 'Arial Narrow', Arial, sans-serif;font-size:15px;" id="abc"><?php echo $row_lab_test->test_name ?></td>
          <td width="20%"><strong>
            <input type="text"  name="testResult[]" style="font-size:22px;text-align:center;font-family: 'Arial Narrow', Arial, sans-serif; font-weight:400; border:none; outline:none;  width:100%">
            </strong></td>
            <input type="hidden" name="testID[]" value="" />
            <input type="hidden" name="testCategoriesID[]" value="" />
          
            <td width="15%" style="font-family: 'Arial Narrow', Arial, sans-seriffont-size:11px;">Each</td>
        
<td width="35%" style="font-family:Optima, Segoe, Segoe UI, Candara, Calibri, Arial, sans-serif; font-size:10px;">12----19</td>
            <!--
            **********************************************************************
            TEST REFERENCE VALU CHANGE END
            ***********************************************************************
            -->
        </tr>
    <?php } ?>
     </table>   
        <tfoot>
            <tr>
                <td ><input type="button" value="Save & Print" class="btn btn-primary col-md-3"></td>
                <td ><input type="button" value="Save" class="btn btn-info col-md-3" style="margin-left: 4px"></td>
            </tr>
        </tfoot>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
        <!-- Test Showing Model -->
        
   
    <!-- Datatables CDN START -->
    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.select.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function(){
            // alert()
           
        })
    </script>