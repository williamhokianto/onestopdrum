<div class="row">
  <div class="col-md-8">
        <p style="margin-top: 24px;">Message sent on <?= $date_created ?></p>

        <p style="margin-top: 30px;">
            <a href="<?= base_url() ?>yourmessages/create/<?= $code ?>">
                <button type="button" class="btn btn-default">Reply</button>
            </a>
        </p>


        <h4 style="margin-top: 48px;"><?= $subject ?></h4>
        <p><?= $message ?></p>
    </div>
</div>