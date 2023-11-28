<div>
    <?php foreach ($messages as $m) { ?>
        <div class="alert alert-success" role="alert">
            <?= $m ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $e) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $e ?>
        </div>
    <?php } ?>
</div>