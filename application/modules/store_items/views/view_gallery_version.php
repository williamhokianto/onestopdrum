<?php
echo Modules::run('templates/_draw_breadcrumbs', $breadcrumbs_data);
if (isset($flash)) {
  echo $flash;
}
?>

<script type="text/javascript">
var myApp = angular.module('myApp', []);

myApp.controller('myController', ['$scope', function($scope){

$scope.defaultPic = '<?= base_url() ?>big_pics/<?= $big_pic ?>';

$scope.change = function(newPic){
  $scope.defaultPic = newPic;
}

}])
</script>

<div class="row" ng-controller="myController">
  <div class="col-md-1" style="margin-top: 24px;">
      <img ng-click="change('<?= base_url() ?>big_pics/<?= $big_pic ?>')" src="<?= base_url() ?>big_pics/<?= $big_pic ?>" class="img-responsive">
      <?php
      foreach ($gallery_pics as $thumbnail) {
      ?>
      <img ng-click="change('<?= $thumbnail ?>')" src="<?= $thumbnail ?>" class="img-responsive">
      <?php
      }
      ?>
  </div>
  <div class="col-md-4" style="margin-top: 24px;">
      <a href="#" data-featherlight="{{ defaultPic }}">
        <img src="{{ defaultPic }}" class="img-responsive" alt="<?= $item_title ?>">
      </a>
  </div>
  <div class="col-md-4">
      <h1><?= $item_title ?></h1>
      <h2>Our Price: <?= $currency_symbol.$item_price_desc ?></h2>
  </div>
  <div class="col-md-3">
      <?= Modules::run('cart/_draw_add_to_cart', $update_id) ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
      <div style="clear: both;">
          <?= nl2br($item_description) ?>
      </div>
  </div>
</div>