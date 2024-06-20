<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Print #' . $model->id;
?>
<div class="request-print">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <strong>ID:</strong> <?= Html::encode($model->id) ?><br>
        <strong>Hiệu lực:</strong> <?= Html::encode($model->hieu_luc) ?><br>
        <!-- Add more fields as necessary -->
    </p>
</div>

<script>
window.print();
</script>
