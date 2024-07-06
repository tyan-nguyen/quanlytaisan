<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\BaoGiaMuaSam */
?>
<div class="bao-gia-mua-sam-update">

    <?php /*$this->render('_form-gui-bao-gia', [
        'model' => $baoGia,
    ])*/  ?>
    
    <?= $this->render('../ct-bao-gia-mua-sam/grid-view-pjax', [
        'model' => $baoGia,
        'phieuMuaSam'=>$model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'dataProviderBgms'=>$dataProviderBgms
    ]) ?>

</div>
