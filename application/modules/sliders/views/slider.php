<div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <?php
        $count = 0;
        foreach ($query_slides->result() as $row) { 

        	if ($count==0) {
        		$additional_css = ' class="active"';
        	} else {
        		$additional_css = '';
        	}

        	?>
          <li data-target="#myCarousel" data-slide-to="<?= $count ?>"<?= $additional_css ?>></li>
        <?php
        $count++;
        }
        ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
       	<?php
        $count = 0;
        foreach ($query_slides->result() as $row_slides) { 
        	$target_url = $row_slides->target_url;
        	$alt_text = $row_slides->alt_text;
        	$pic_path = base_url().'slider_pics/'.$row_slides->picture;

        	if ($count==0) {
        		$additional_css = ' active';
        	} else {
        		$additional_css = '';
        	}

        ?>
          <div class="item<?= $additional_css ?>">
          	<?php
          	if ($target_url!='') { ?>
          		<a href="<?= $target_url ?>">
            		<img src="<?= $pic_path ?>" alt="<?= $alt_text ?>">
            	</a>
            <?php
        	} else { ?>
        		<img src="<?= $pic_path ?>" alt="<?= $alt_text ?>">
        	<?php	
        	}
        	?>
          </div>
        <?php
        $count++;
        }
        ?>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>