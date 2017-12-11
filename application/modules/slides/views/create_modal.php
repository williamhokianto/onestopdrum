<p style="margin-top: 30px;">

<!-- Button to trigger modal -->
<a href="<?= base_url() ?>sliders/create/<?= $parent_id ?>">
  <button type="button" class="btn btn-default">Previous Page</button>
</a>
<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Create New Slide</a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Create Slide</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" action="<?= $form_location ?>" method="post">
    <p>

      <div class="control-group">
        <label class="control-label" for="typeahead">Target URL (OPTIONAL)</label>
        <div class="controls">
          <input type="text" class="span12" name="target_url" placeholder="(enter the target URL here)">
        </div>
      </div>    

      <div class="control-group">
        <label class="control-label" for="typeahead">Alt-Text (OPTIONAL)</label>
        <div class="controls">
          <input type="text" class="span12" name="alt_text" placeholder="(enter the alt-text here)">
        </div>
      </div> 

    </p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" name="submit" value="Submit" type="submit">Submit</button>
  </div>
  <?php
  echo form_hidden('parent_id', $parent_id);
  ?>
  </form>  
</div>




</p>