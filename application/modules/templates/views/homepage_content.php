<?php
echo nbs(7);
echo Modules::run('homepage_blocks/_draw_blocks');
?>


    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-8">
          <?= Modules::run('blog/_draw_feed_hp') ?>
       </div>
      </div>