<h1><?= $headline ?></h1>
<h2><?= $sub_headline ?></h2>
<?php
if (isset($flash)) {
  echo $flash;
}
?>

<p style="margin-top: 30px;">
<!-- Button to trigger modal -->
<a href="<?= base_url() ?>store_items/create/<?= $parent_id ?>">
  <button type="button" class="btn btn-default">Previous Page</button>
</a>
<a href="<?= base_url() ?>item_galleries/upload_image/<?= $parent_id ?>" role="button" class="btn btn-primary" data-toggle="modal">Upload Picture</a>

</p>

<?php
if ($num_rows<1) {
  echo 'So far you have not uploaded any gallery '.$entity_name.' for '.$parent_title.'.';
} else {
?>

<div class="row-fluid sortable">        
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white file"></i><span class="break"></span>Existing Pictures</h2>
            <div class="box-icon">
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th>Picture</th>
                      <th class="span2">Actions</th>
                  </tr>
              </thead>   
              <tbody>
                <?php
                $this->load->module('timedate');
                foreach($query->result() as $row) {
                    $delete_url = base_url().'item_galleries/deleteconf/'.$row->id;
                    $picture = $row->picture;
                    $pic_path = base_url().'item_galleries_pics/'.$picture;
                ?>
                <tr>
                    <td><?php
                    if ($picture!='') {?>
                    <img src="<?= $pic_path ?>">
                    <?php
                    }
                    ?>
                    </td>
                    <td class="center">
                        <a class="btn btn-danger" href="<?= $delete_url ?>">
                            <i class="halflings-icon white trash"></i>  
                        </a>

                      
                    </td>
                </tr>
                <?php
                }
                ?>
                
              </tbody>
          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->
<?php
}
?>