<style>
.map-responsive{
    overflow:hidden;
    padding-bottom:56.25%;
    position:relative;
    height:0;
}
.map-responsive iframe{
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
}

</style>

<div class="row">
  <div class="col-md-12">
      <h1>Contact Us</h1>
      <div style="clear: both;">
  </div>      
          
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <?php
                echo validation_errors("<p style='color: red;'>", "</p>");
                ?>
                <form action="<?= $form_location ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <!--<div class="form-group name">
                            <label for="name">
                                Name</label>
                            <input type="text" name="firstname" class="form-control" id="name" placeholder="Enter name" required="required" />
                        </div>
                    -->
                        <div class="form-group">
                            <label for="name">
                                Name</label>
                            <input type="text" name="yourname" value="<?= $yourname ?>" class="form-control" id="name" placeholder="Enter name" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="email" value="<?= $email ?>" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                Telephone Number</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span>
                                </span>
                                <input type="telnum" name="telnum" value="<?= $telnum ?>" class="form-control" id="telnum" placeholder="Enter telephone number" required="required" /></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Message"><?= $message ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="submit" value="Submit" class="btn btn-primary pull-right" id="btnContactUs">
                            Send Message</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
            <address>
                <strong><?= $our_name ?></strong><br>
                <?= $our_address ?>
                <abbr title="Phone">
                    P:</abbr>
                <?= $our_telnum ?>
            </address>
            <address>
                <strong>Telephone</strong><br>
                <?= $our_telnum ?>
            </address>
            </form>
                </div>
            </div>
      </div>
  </div>
</div>

<div class="container"></div>
    <div class="col-md-12">
        <div class="map-responsive" style="margin-bottom: 50px;">
            <?= $map_code ?>  
        </div>
    </div>
</div>