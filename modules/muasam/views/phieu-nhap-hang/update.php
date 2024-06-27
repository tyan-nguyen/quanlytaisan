<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuNhapHang */
?>
<div class="phieu-nhap-hang-update">
    <?php if($model->phieuNhapHang) { ?>
    <?= $this->render('_form', [
        'model' => $model->phieuNhapHang,
    ]) ?>
    <?php } ?>
    <?= $this->render('../ct-phieu-nhap-hang/grid-view-pjax', [
        'model' => $model,
        //'phieuMuaSam'=>$model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
