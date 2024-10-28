<?php

use yii\bootstrap5\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChuaVatTu */

?>
<div class="phieu-sua-chua-vat-tu-create">
    <?= $this->render('_form-from-thiet-bi', [
        'model' => $model,
        'modelSuaChua' => $modelSuaChua
    ]) ?>
</div>
