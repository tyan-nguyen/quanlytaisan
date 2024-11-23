<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
?>

<div class="nhom-doi-tac-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php // $form->errorSummary($model) ?>
    <h3 class="card-title mb-2 text-primary">Thông tin phiếu sửa chữa</h3>    
    <div style="font-size:120%">
    <strong>Số phiếu:</strong> P-<?= substr("0000000{$model->id}", -6) ?>
    <br/>
    <strong>Thiết bị:</strong> <?= $model->thietBi->ten_thiet_bi ?>
    </div>
    <br/>
    
    <h3 class="card-title mt-2  text-primary">Danh sách vật tư đề nghị</h3>
    <table class="table">
    <tr>
    	<th>STT</th>
    	<th>Tên vật tư</th>
    	<th>Số lượng</th>
    	<th>Đơn vị tính</th>
    	<th>Ghi chú</th>
    </tr>
    <?php 
    foreach($model->vatTus as $indexVt => $vatTu){
    ?>
    <tr>
    	<td><?= ($indexVt+1) ?></td>
    	<td><?= $vatTu->vatTu->ten_vat_tu ?></td>
    	<td><?= $vatTu->so_luong ?></td>
    	<td><?= $vatTu->don_vi_tinh ?></td>
    	<td><?= $vatTu->ghi_chu ?></td>
    </tr>
    
    <?php 
    }
    ?>
    </table>

    <?= $form->field($model, 'noi_dung_duyet_vt_kho')->textarea(['rows' => 3])->label('<h3 class="card-title mt-2  text-primary">Nội dung ' . $title .':</h3>') ?>

    <?php ActiveForm::end(); ?>
    
</div>
