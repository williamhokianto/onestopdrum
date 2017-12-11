<p style="margin-top: 30px;">

<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Create New Link</a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Create Bottom Navigation Link</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" action="<?= $form_location ?>" method="post">

    <div class="control-group">
    	<label class="control-label" for="typeahead">Page URL: </label>
      		<div class="controls">
          		<?php
          		$additional_dd_code = 'id="selectError3"';
          		echo form_dropdown('page_id', $options, '', $additional_dd_code);
          		?>
      		</div>
	</div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" name="submit" value="Submit" type="submit">Submit</button>
  </div>
  </form>  
</div>




</p>