<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuNhapHang */
$view=$model->dm_mua_sam==='thiet_bi' ? '../ct-phieu-nhap-hang/grid-view-pjax' : '../ct-phieu-nhap-hang-vt/grid-view-pjax';

?>
<div class="phieu-nhap-hang-update">
    <?php if($model->phieuNhapHang) { ?>
    <?= $this->render('_form', [
        'model' => $model->phieuNhapHang,
    ]) ?>
    <?php } ?>
    <?= $this->render($view, [
        'model' => $model,
        //'phieuMuaSam'=>$model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
