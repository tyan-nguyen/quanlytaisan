<?php
use yii\helpers\Html;
?>

<div class="wrap">
    <div class="div-left">
        <table>
            <tr>
            	<!-- <td colspan="2" align="center" class="title">DNTN SX-TM Nguyễn Trình</td>-->
            </tr>
            <tr>
            	<td><?= Html::img($model->qrCode .'?v='.date('s'), ['class'=>'img']) ?></td>
            	<!-- <td class="title"><?= $model->ten_thiet_bi ?></td> -->
            	<td><?= Html::img('assets/images/brand/favicon.png', ['class'=>'img']) ?></td>
            </tr>     
            <tr>
            	<td colspan="2" align="center" class="title" style="font-size:8pt"><?= $model->ten_thiet_bi ?></td>
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