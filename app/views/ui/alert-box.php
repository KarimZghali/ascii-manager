<?php if( isset($model->success) || isset($model->error) ): ?>

<div style="text-align: center;" class="alert alert-<?= isset($model->success) ? "success" : "danger"  ?> alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong><?= isset($model->success) ? $model->success: $model->error?> </strong>
</div>


<?php endif; ?>

<?php if( isset($modelCreate->success) || isset($modelCreate->error) ): ?>

<div class="alert alert-<?= isset($modelCreate->success) ? "success" : "danger"  ?> alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong class="text-center">Success!</strong>
</div>


<?php endif; ?>




