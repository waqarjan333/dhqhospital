<div class="row">
        <?php 
        if(count($data) > 0){ 
          foreach ($data as $row) {
            echo "<font color='red'>Recept Number = ".$row->record." Numbers = ".$row->count." </font><br/>";
          }
         } 
         ?>
      </div>