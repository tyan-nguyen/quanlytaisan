<?php

use yii\bootstrap5\Html;

use wbraganca\dynamicform\DynamicFormWidget;
use wbraganca\dynamicform\DynamicFormAsset;

DynamicFormAsset::register($this);


/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanh */

?>
<div class="ts-yeu-cau-van-hanh-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail
    ]) ?>
</div>

