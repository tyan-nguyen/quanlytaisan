<?php
use yii\helpers\Html;
?>

<div class="wrap">
    <div class="div-left">
        <table>
        <tr>
        	<td><?= Html::img($model->qrCode, ['class'=>'img']) ?></td>
        	<td class="title"><?= $model->ten_thiet_bi ?></td>
        </tr>
        <tr>
        <td colspan="2" align="center" class="title-2">DNTN SX-TM Nguyễn Trình</td>
        </tr>
        </table>
    </div>
    <!-- 
    <div class="div-right">
    <table>
    <tr>
    	<td><?= Html::img($model->qrCode, ['class'=>'img']) ?></td>
    	<td class="title"><?= $model->ten_thiet_bi ?></td>
    </tr>
    <tr>
    <td colspan="2" align="center" class="title-2">DNTN SX-TM Nguyễn Trình</td>
    </tr>
    </table>
    </div>-->
</div>