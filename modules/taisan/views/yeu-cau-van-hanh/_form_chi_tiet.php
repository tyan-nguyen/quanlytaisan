<?php
use app\modules\dungchung\models\CustomFunc;
use yii\helpers\Html;
?>
<div class="row">
<div class="col-md-12 text-end">
<?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/taisan/ycvh-ajax/create', 'idYeuCau'=>$model->id], [
    'role'=>'modal-remote-2',
    'class'=>'add-item btn btn-primary btn-xs'
]) ?> 
</div>  
<div class="col-md-12 mt-2">
<table class="table table-striped table-bordered">
	<thead>
        <tr>
            <th>STT</th>
            <th>Tên thiết bị</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    	<?php 
    	$custom = new CustomFunc();
    	foreach ($model->details as $i => $modelDetail) : ?>
    	<?php 
    	   $ngayBatDau = $custom->convertYMDHISToDMY($modelDetail->ngay_bat_dau); 
    	   $ngayKetThuc = $custom->convertYMDHISToDMY($modelDetail->ngay_ket_thuc);
    	?>
    	<tr>
            <th scope="row"><?= $i+1 ?></th>
            <td><?= $modelDetail->thietBi?$modelDetail->thietBi->ten_thiet_bi:'' ?></td>
            <td><?= $ngayBatDau ?></td>
            <td><?= $ngayKetThuc ?></td>
            <td>
            	<?= Html::a('<span class="fas fa-pencil-alt"></span> Sửa', ['/taisan/ycvh-ajax/update', 'id'=>$modelDetail->id], [
            	    'role'=>'modal-remote-2',
            	    'class'=>'btn ripple btn-info btn-sm'
            	]) ?>
            	<?= Html::a('<span class="fas fa-trash-alt"></span> Xóa', ['/taisan/ycvh-ajax/delete', 'id'=>$modelDetail->id], [
            	    'role'=>'modal-remote-2',
            	    'class'=>'btn ripple btn-secondary btn-sm',
            	    'data-request-method'=>'post',
            	    'data-confirm-title'=>'Xác nhận xóa chi tiết?',
            	    'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?'            	    
            	]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
    	