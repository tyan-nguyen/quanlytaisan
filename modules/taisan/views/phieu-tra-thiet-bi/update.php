<?php

use yii\bootstrap5\Html;
use wbraganca\dynamicform\DynamicFormAsset;

DynamicFormAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\TsPhieuTraThietBi */
?>
<div class="ts-phieu-tra-thiet-bi-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail

    ]) ?>

</div>
