<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\baotri\models\LoaiBaoTri */
?>
<div class="loai-bao-tri-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ten',
            'ghi_chu:ntext',
        ],
    ]) ?>

</div>
