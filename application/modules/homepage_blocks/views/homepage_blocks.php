<?php
function get_theme($count)
{
  switch ($count) {
    case '1':
      $theme = 'danger';
      break;
    case '2':
      $theme = 'warning';
      break;
    case '3':
      $theme = 'primary';
      break;
    case '4':
      $theme = 'success';
      break;
    default:
      $theme = 'primary';
      break;
  }
  return $theme;
}
?>
<style>
.shape{ 
  border-style: solid; border-width: 0 70px 40px 0; float:right; height: 0px; width: 0px;
  -ms-transform:rotate(360deg); /* IE 9 */
  -o-transform: rotate(360deg);  /* Opera 10.5 */
  -webkit-transform:rotate(360deg); /* Safari and Chrome */
  transform:rotate(360deg);
}
.offer{
  background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); margin: 15px 0; overflow:hidden;
}
.offer-radius{
  border-radius:7px;
}
.offer-danger { border-color: #d9534f; }
.offer-danger .shape{
  border-color: transparent #d9534f transparent transparent;
  border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-success {  border-color: #5cb85c; }
.offer-success .shape{
  border-color: transparent #5cb85c transparent transparent;
  border-color: rgba(255,255,255,0) #5cb85c rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-default {  border-color: #999999; }
.offer-default .shape{
  border-color: transparent #999999 transparent transparent;
  border-color: rgba(255,255,255,0) #999999 rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-primary {  border-color: #428bca; }
.offer-primary .shape{
  border-color: transparent #428bca transparent transparent;
  border-color: rgba(255,255,255,0) #428bca rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-info { border-color: #5bc0de; }
.offer-info .shape{
  border-color: transparent #5bc0de transparent transparent;
  border-color: rgba(255,255,255,0) #5bc0de rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-warning {  border-color: #f0ad4e; }
.offer-warning .shape{
  border-color: transparent #f0ad4e transparent transparent;
  border-color: rgba(255,255,255,0) #f0ad4e rgba(255,255,255,0) rgba(255,255,255,0);
}

.shape-text{
  color:#fff; font-size:12px; font-weight:bold; position:relative; right:-40px; top:2px; white-space: nowrap;
  -ms-transform:rotate(30deg); /* IE 9 */
  -o-transform: rotate(360deg);  /* Opera 10.5 */
  -webkit-transform:rotate(30deg); /* Safari and Chrome */
  transform:rotate(30deg);
} 
.offer-content{
  padding:0 20px 10px;
}

.panel-danger {
  border-color: #d9534f;
}
.panel-danger > .panel-heading {
  color: #ffffff;
  background-color: #d9534f;
  border-color: #d9534f;
}

.panel-warning {
  border-color: #f0ad4e;
}
.panel-warning > .panel-heading {
  color: #ffffff;
  background-color: #f0ad4e;
  border-color: #f0ad4e;
}

.panel-success {
  border-color: #5cb85c;
}
.panel-success > .panel-heading {
  color: #ffffff;
  background-color: #5cb85c;
  border-color: #5cb85c;
}

</style>

<?php
$count = 0;
$this->load->module('homepage_offers');
$this->load->module('site_settings');
$items_segments = $this->site_settings->_get_item_segments();
$currency_symbol = $this->site_settings->_get_currency_symbol();
foreach($query->result() as $row) {
$count++;
$block_id = $row->id;
$num_items_on_block = $this->homepage_offers->count_where('block_id', $block_id);
if ($num_items_on_block>0) {

      if ($count>4) {
        $count = 1; 
      }

      $theme = get_theme($count);
      ?>
      <div class=bs-example data-example-id=contextual-panels> 
        <div class="panel panel-<?= $theme ?>"> 
          <div class=panel-heading> <h3 class=panel-title><?= $row->block_title ?></h3> 
          </div> <div class=panel-body> 

          <div class="row">

            <?php
            $block_data['block_id'] = $block_id;
            $block_data['theme'] = $theme;
            $block_data['item_segments'] = $items_segments;
            $block_data['currency_symbol'] = $currency_symbol;
            $this->homepage_offers->_draw_offers($block_data);
            ?>

          </div>


           </div> 
        </div> 
      </div>

      <?php
      }

}
?>