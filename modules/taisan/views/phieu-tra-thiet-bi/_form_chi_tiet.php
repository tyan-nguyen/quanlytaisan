<?php
use app\modules\dungchung\models\CustomFunc;
use yii\helpers\Html;
?>
<div class="row">
<div class="col-md-12 text-end">
<?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/taisan/ycttb-ajax/create', 'idYeuCau'=>$model->id], [
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
            <th>Ngày trả</th>
            <th>Chuyển về kho</th>
            <th width="150">Phiếu vận hành</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    	<?php 
    	$custom = new CustomFunc();
    	foreach ($model->details as $i => $modelDetail) : ?>
    	<?php 
    	   $ngayTra = $custom->convertYMDHISToDMY($modelDetail->ngay_tra); 
    	?>
    	<tr>
            <th scope="row"><?= $i+1 ?></th>
            <td><?= $modelDetail->thietBi?$modelDetail->thietBi->ten_thiet_bi:'' ?></td>
            <td><?= $ngayTra ?></td>
            <td><?= $modelDetail->tra_khong_ve_kho ? 'Thiết bị còn tại công trình' : 'Đã chuyển về kho' ?></td>
            <td><?= ($modelDetail->id_ycvhct ? Html::a('<span class="typcn typcn-document-text"></span> Xem phiếu', ['/taisan/theo-doi-van-hanh/view', 'id'=>$modelDetail->chiTietVanHanh->id_yeu_cau_van_hanh, 'idItem'=>$modelDetail->id_ycvhct], [
            	    'role'=>'modal-remote-2',
            	    'class'=>'btn ripple btn-info btn-sm'
            	]) : '') ?></td>
            <td>
            	<?= Html::a('<span class="fas fa-pencil-alt"></span> Sửa', ['/taisan/ycttb-ajax/update', 'id'=>$modelDetail->id], [
            	    'role'=>'modal-remote-2',
            	    'class'=>'btn ripple btn-info btn-sm'
            	]) ?>
            	<?= Html::a('<span class="fas fa-trash-alt"></span> Xóa', ['/taisan/ycttb-ajax/delete', 'id'=>$modelDetail->id], [
            	    'role'=>'modal-remote-2',
            	    'class'=>'btn ripple btn-secondary btn-sm',
            	    'data-request-method'=>'post',
            	    'data-confirm-title'=>'Xác nhận xóa chi tiết phiếu?',
            	    'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?'            	    
            	]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
    	