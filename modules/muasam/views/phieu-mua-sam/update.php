<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuMuaSam */
$view=$model->dm_mua_sam==='thiet_bi' ? '../ct-phieu-mua-sam/grid-view-pjax' : '../ct-phieu-mua-sam-vt/grid-view-pjax';

?>
<div class="phieu-mua-sam-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?= $this->render($view, [
        'model' => $model,
        'searchModel' => $searchModel,
         'dataProvider' => $dataProvider
    ]) ?>

</div>
