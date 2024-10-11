<?php

use yii\bootstrap5\Html;

use wbraganca\dynamicform\DynamicFormWidget;
use wbraganca\dynamicform\DynamicFormAsset;

DynamicFormAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\TsPhieuTraThietBi */

?>
<div class="ts-phieu-tra-thiet-bi-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
