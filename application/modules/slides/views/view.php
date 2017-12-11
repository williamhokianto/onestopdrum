<?php
$form_location = base_url().'slides/submit/'.$update_id;
?>
<h1><?= $headline ?></h1>

<a href="<?= base_url() ?>slides/update_group/<?= $parent_id ?>">
  <button type="button" class="btn btn-default">Previous Page</button>
</a>

<div style="clear: both; margin-top: 12px;">
<?= Modules::run('slides/_draw_img_btn', $update_id) ?>
</div>

<div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon white edit"></i><span class="break"></span><?= $entity_name ?> Details</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">

                        <form class="form-horizontal" method="post" action="<?= $form_location ?>">
                          <fieldset>

                            <div class="control-group">
                              <label class="control-label" for="typeahead">Target URL <span style="color: green;">
                                (optional)</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="target_url" value="<?= $target_url ?>">
                              </div>
                            </div>

                            <div class="control-group">
                              <label class="control-label" for="typeahead">Alt-Text <span style="color: green;">
                                (optional)</span></label>
                              <div class="controls">
                                <input type="text" class="span6" name="alt_text" value="<?= $alt_text ?>">
                              </div>
                            </div>

                            <div class="form-actions">
                              <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                              <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
                            </div>

                          </fieldset>
                        </form>   

                    </div>
                </div><!--/span-->

            </div><!--/row-->