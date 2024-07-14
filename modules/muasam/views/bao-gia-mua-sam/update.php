<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\BaoGiaMuaSam */
$view=$model->dm_mua_sam==='thiet_bi' ? '../ct-bao-gia-mua-sam/grid-view-pjax' : '../ct-bao-gia-mua-sam-vt/grid-view-pjax';
?>
<div class="bao-gia-mua-sam-update">

    <?php /*$this->render('_form-gui-bao-gia', [
        'model' => $baoGia,
    ])*/  ?>
    
    <?= $this->render($view, [
        'model' => $baoGia,
        'phieuMuaSam'=>$model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'dataProviderBgms'=>$dataProviderBgms
    ])  ?>

</div>
