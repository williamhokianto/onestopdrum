<?php
foreach($query->result() as $row) {
$item_title = $row->item_title;
$small_pic = $row->small_pic;
$item_price = $row->item_price;
$was_price = $row->was_price;
$small_pic_path = base_url()."small_pics/".$small_pic;
$item_page = base_url().$item_segments.$row->item_url;
$item_price = number_format($row->item_price, 2);
$item_price = str_replace('.00', '', $item_price);

    ?>

      <div class="col-xs-3">
        <div class="offer offer-<?= $theme ?>" style="min-height: 450px;">
          <div class="shape">
            <div class="shape-text">
              <span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 1.4em;"></span>              
            </div>
          </div>
          <div class="offer-content">
            <h3 class="lead">
                Our Price 
              <?= $currency_symbol.$item_price ?>
            </h3> 
            <a href="<?= $item_page ?>"><img src="<?= $small_pic_path ?>" title="<?= $item_title ?>" class="img-responsive"></a>
            <p style="text-align: center;">
              <a href="<?= $item_page ?>">
              <button class="btn btn-danger btn-lg" type="button" style="margin-top: 20px;"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Add to Cart</button>
              </a>
            </p>
            <br>          
            <p>
              <a href="<?= $item_page ?>"><?= $item_title ?></a>
            </p>
          </div>
        </div>
      </div>

    <?php
}