<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
if (isset($flash)) {
  echo $flash;
}


if (is_numeric($update_id)) { ?>
<div class="row-fluid sortable">
  <div class="box span12">
      <div class="box-header" data-original-title>
          <h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
          <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
          </div>
      </div>
      <div class="box-content">
          <?php
          if ($got_gallery_pic == TRUE) {
            echo '<div class="alert alert-info">';
            echo 'NOTE: You have at least one gallery picture for this item.';
            echo '</div>';
            $gallery_btn_theme = 'success';
            $delete_btn_text = 'Delete Main Image';
          } else {
            echo '<div class="alert alert-info">';
            echo 'NOTE: You don\'t have any gallery picture for this item.';
            echo '</div>';
            $gallery_btn_theme = 'primary';
            $delete_btn_text = 'Delete Item Image';
          }


          if ($big_pic=="") { ?>
            <a href="<?= base_url() ?>store_items/upload_image/<?= $update_id ?>"><button type="button" class="btn btn-primary">Upload Item Image</button></a>
          <?php
          } else {
            ?>
            <a href="<?= base_url() ?>store_items/delete_image/<?= $update_id ?>"><button type="button" class="btn btn-danger"><?= $delete_btn_text ?></button></a>
            <?php
          }
          ?>
          <a href="<?= base_url() ?>item_galleries/update_group/<?= $update_id ?>"><button type="button" class="btn btn-<?= $gallery_btn_theme ?>">Manage Item Gallery</button></a>
          <a href="<?= base_url() ?>store_item_colours/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Colours</button></a>
          <a href="<?= base_url() ?>store_item_sizes/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Sizes</button></a>
          <a href="<?= base_url() ?>store_cat_assign/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Categories</button></a>
          <a href="<?= base_url() ?>store_items/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Item</button></a>
          <a href="<?= base_url() ?>store_items/view/<?= $update_id ?>"><button type="button" class="btn btn-default">View Item In Shop</button></a>

      </div>
  </div><!--/span-->
</div><!--/row-->
<?php
}
?>

<?php
if ($big_pic!="") { ?>
<div class="row-fluid sortable">
  <div class="box span12">
      <div class="box-header" data-original-title>
          <h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Image</h2>
          <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
          </div>
      </div>
      <div class="box-content">
        
          <img src="<?= base_url() ?>big_pics/<?= $big_pic ?>">

      </div>
  </div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Details</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                      <?php
                      $form_location = base_url()."store_items/create/".$update_id;
                      ?>
                        <form class="form-horizontal" method="post" action="<?= $form_location ?>">
                          <fieldset>
                            <div class="control-group">
                              <label class="control-label" for="typeahead">Item Title </label>
                              <div class="controls">
                                <input type="text" class="span6" name="item_title" value="<?= $item_title ?>">
                              </div>
                            </div>

                            <div class="control-group">
                              <label class="control-label" for="typeahead">Item Price </label>
                              <div class="controls">
                                <input type="text" class="span3" name="item_price" value="<?= $item_price ?>">
                              </div>
                            </div>

                            <div class="control-group">
                              <label class="control-label" for="typeahead">Was Price <span style="color: green;">
                                (optional)</span> </label>
                              <div class="controls">
                                <input type="text" class="span3" name="was_price" value="<?= $was_price ?>">
                              </div>
                            </div>

                            <div class="control-group">
                              <label class="control-label" for="typeahead">Status</label>
                              <div class="controls">
<?php
$additional_dd_code = 'id="selectError3"';
$options = array(
                  '' => 'Please Select...',
                  '1'  => 'Active',
                  '0'    => 'Inactive',
                );

echo form_dropdown('status', $options, $status, $additional_dd_code);
?>

                              </div>
                            </div>

                            
                            <div class="control-group hidden-phone">
                              <label class="control-label" for="textarea2">Item Description</label>
                              <div class="controls">
                                <textarea class="cleditor" id="textarea2" rows="3" name="item_description"><?php
                                echo $item_description;
                                ?></textarea>
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

