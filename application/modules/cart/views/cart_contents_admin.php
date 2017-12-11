<div class="row-fluid sortable">
  <div class="box span12">
      <div class="box-header" data-original-title>
          <h2><i class="halflings-icon white shopping-cart"></i><span class="break"></span>Customer's Shopping Basket Contents </h2>
          <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
          </div>
      </div>
      <div class="box-content">

      	 <table class="table table-bordered">
            <?php
            $grand_total = 0;
            foreach($query->result() as $row) {
                $sub_total = $row->price * $row->item_qty;
                $sub_total_desc = number_format($sub_total, 2);
                $grand_total = $grand_total+$sub_total;
            ?>
            <tr>
                <td class="col-md-2">
                    <?php
                    if ($row->small_pic!='') { ?>
                        <img src="<?= base_url(); ?>small_pics/<?= $row->small_pic ?>">
                    <?php
                    } else {
                        echo "No image preview available";
                    }
                    ?>
                    </td>
                <td class="col-md-8">
                    
                    Item Number: <?= $row->item_id ?><br>
                    <b><?= $row->item_title ?></b><br>
                    Item Price: <?= $currency_symbol.$row->price ?><br><br>
                    QUANTITY: <?= $row->item_qty ?><br>

                    <?php 
                    if (!empty($row->item_colour)) {
                        echo "COLOUR : ".$row->item_colour."<br>";
                    } else {
                        echo "<br>";
                    }

                    if (!empty($row->item_size)) {
                        echo "SIZE : ".$row->item_size."<br><br>";
                    } else {
                        echo "<br><br>";
                    }

                     ?>
                    
                    
                </td>
                <td class="col-md-2"><?= $currency_symbol.$sub_total_desc ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
            <tr>
                <td class="col-md-2">
                    &nbsp;    
                </td>
                <td class="col-md-8" style="text-align: right;">
                    Shipping: <?php
                    $grand_total = $grand_total+$shipping;
                    ?>
                </td>
                <td class="col-md-2"><?= $currency_symbol.$shipping ?></td>
            </tr>
            <tr>
                <td colspan='2' style='font-weight: bold; text-align: right;'>Total</td>
                <td style="font-weight: bold;"><?php
                $grand_total_desc = number_format($grand_total, 2);
                echo $currency_symbol.$grand_total_desc;
                ?></td>
            </tr>
        </table>
      	
  		
          
      </div>
  </div><!--/span-->
</div><!--/row-->