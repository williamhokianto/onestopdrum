<?php
echo Modules::run('templates/_draw_breadcrumbs', $breadcrumbs_data);
if (isset($flash)) {
  echo $flash;
}
?>

<div class="row">
  <div class="col-md-4" style="margin-top: 24px;">
      <a href="#" data-featherlight="<?= base_url() ?>big_pics/<?= $big_pic ?>">
        <img src="<?= base_url() ?>big_pics/<?= $big_pic ?>" class="img-responsive" alt="<?= $item_title ?>">
      </a>
  </div>
  <div class="col-md-5">
      <h3><?= $item_title ?></h3>
      <h4>Our Price: <?= $currency_symbol.$item_price_desc ?></h4>
  </div>
  <div class="col-md-2">
      <?= Modules::run('cart/_draw_add_to_cart', $update_id) ?>
  </div>
</div>

<div class="row">
  <div class="col-md-10 col-md-offset-1">
      <div style="clear: both;">
          <?= nl2br($item_description) ?>
      </div>
  </div>
</div>