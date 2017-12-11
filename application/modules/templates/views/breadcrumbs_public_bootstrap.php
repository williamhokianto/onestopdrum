<div class="row">
  <div class="col-md-12" style="margin-top: 12px;">
    <ol class="breadcrumb">
        <?php
        foreach ($breadcrumbs_array as $key => $value) {
           echo '<li><a href="'.$key.'">'.$value.'</a></li>';
        }
        ?>
      <li class="active"><?= $current_page_title ?></li>
    </ol>
  </div>
</div>