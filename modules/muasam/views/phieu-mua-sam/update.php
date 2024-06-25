<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuMuaSam */
?>
<div class="phieu-mua-sam-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?= $this->render('../ct-phieu-mua-sam/grid-view-pjax', [
        'model' => $model,
        'searchModel' => $searchModel,
         'dataProvider' => $dataProvider
    ]) ?>

</div>
