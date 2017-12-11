<div class="row" style="border-radius: 15px; background: linear-gradient(to bottom left, #ff0000 0%, #ff9933 100%); padding: 15px;">
<?php
echo form_open('store_basket/add_to_basket');
?>
    <?php
        if ($num_sizes>0) { ?>
    <div class="form-group">
    <label>Select Size:</label>
        <?php
            $additional_dd_code = 'class="form-control"';
            echo form_dropdown('item_size', $size_options, $submitted_size, $additional_dd_code);
        ?>
    </div>
    <?php
    }
    ?>


    <?php
        if ($num_colours>0) { ?>
    <div class="form-group">
    <label>Select Colour:</label>
        <?php
            $additional_dd_code = 'class="form-control"';
            echo form_dropdown('item_colour', $colour_options, $submitted_colour, $additional_dd_code);
        ?>
    </div>
    <?php
    }
    ?>

  <div class="form-group">
    <label>Quantity:</label>
      <input type="number" name="item_qty" class="form-control" placeholder="Enter Quantity">
  </div>

  <div style="text-align: center;">
  <div class="form-group"> 
      <button class="btn btn-info" name="submit" value="Submit" type="submit"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
      Add To Cart</button>
  </div>
</div>

  <?php
echo form_hidden('item_id', $item_id);
echo form_close();
?> 
</form>
</div>