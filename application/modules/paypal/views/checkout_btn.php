<?php
echo form_open($form_location);
echo form_hidden('upload', '1');
echo form_hidden('cmd', '_cart');
echo form_hidden('business', $paypal_email);
echo form_hidden('currency_code', $currency_code);
echo form_hidden('custom', $custom);
echo form_hidden('return', $return);
echo form_hidden('cancel_return', $cancel_return);

$count = 0;
foreach($query->result() as $row) {
    $count++;
    $item_title = $row->item_title;
    $price = $row->price;
    $item_qty = $row->item_qty;
    $item_size = $row->item_size;
    $item_colour = $row->item_colour;

    echo form_hidden('item_name_'.$count, $item_title);
    echo form_hidden('amount_'.$count, $price);
    echo form_hidden('item_qty_'.$count, $item_qty);

    if ($item_colour!='') {
        echo form_hidden('on0_'.$count, 'Colour');
        echo form_hidden('os0_'.$count, $item_colour);
    }

    if ($item_size!='') {
        echo form_hidden('on1_'.$count, 'Size');
        echo form_hidden('os1_'.$count, $item_size);
    }
}

echo form_hidden('shipping_'.$count, $shipping);
?>
<div class="col-md-10 col-md-offset-1" style="text-align: center;">
    <button class="btn btn-success" name="submit" value="Submit" type="submit">
        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
        Go To Checkout
    </button>
</div>
<?php
echo form_close();

if ($on_test_mode == TRUE) { ?>

<div style="text-align: center; margin-top: 24px;">
<form class="form-inline" action="<?= base_url() ?>paypal/submit_test" method="post" accept-charset="utf-8">
  <div class="form-group">
    <label for="num_orders">Enter number of orders you'd like to simulate: </label>
    <input type="text" class="form-control" name="num_orders" id="num_orders">
  </div>
  <div class="form-group">
    <input type="hidden" class="form-control" name="custom" value="<?= $custom ?>">
  </div>
  <button type="submit" class="btn btn-default" name="Submit">Submit</button>
</form>
</div>
<?php
}
?>


