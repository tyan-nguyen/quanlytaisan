<?php
use app\modules\dungchung\models\CustomFunc;
use yii\helpers\Html;
?>
<div class="row">
<div class="col-md-12 mt-2">
<table class="table table-striped table-bordered">
	<thead>
        <tr>
            <th>STT</th>
            <th>Tên thiết bị</th>
            <th>Ngày trả</th>
            <th width="150">Phiếu YCVH</th>
        </tr>
    </thead>
    <tbody>
     	<?php if($model->details == null):?>
     	<tr>
     		<td colspan="4">
         		Chưa có thiết bị.
			</td>
		</tr>
        <?php endif;?>
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
            <td><?= ($modelDetail->id_ycvhct ? Html::a('<span class="typcn typcn-document-text"></span> Xem phiếu', ['/taisan/theo-doi-van-hanh/view', 'id'=>$modelDetail->chiTietVanHanh->id_yeu_cau_van_hanh, 'idItem'=>$modelDetail->id_ycvhct], [
            	    'role'=>'modal-remote-2',
            	    'class'=>'btn ripple btn-info btn-sm'
            	]) : '') ?></td>
        </tr>
        <?php endforeach; ?>
       
    </tbody>
</table>
</div>
</div>
    	