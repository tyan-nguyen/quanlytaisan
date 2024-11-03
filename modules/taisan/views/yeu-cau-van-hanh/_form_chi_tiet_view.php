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
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Ngày trả TT</th>
        </tr>
    </thead>
    <tbody>
     	<?php if($model->details == null):?>
     	<tr>
     		<td colspan="5">
         		Chưa có thiết bị.
			</td>
		</tr>
        <?php endif;?>
    	<?php 
    	$custom = new CustomFunc();
    	foreach ($model->details as $i => $modelDetail) : ?>
    	<?php 
    	   $ngayBatDau = $custom->convertYMDHISToDMY($modelDetail->ngay_bat_dau); 
    	   $ngayKetThuc = $custom->convertYMDHISToDMY($modelDetail->ngay_ket_thuc);
    	   $ngayTraTT = $custom->convertYMDHISToDMY($modelDetail->ngay_tra_thuc_te);
    	?>
    	<tr>
            <th scope="row"><?= $i+1 ?></th>
            <td><?= $modelDetail->thietBi?$modelDetail->thietBi->ten_thiet_bi:'' ?></td>
            <td><?= $ngayBatDau ?></td>
            <td><?= $ngayKetThuc ?></td>
            <td><?= $ngayTraTT ?></td>
        </tr>
        <?php endforeach; ?>
       
    </tbody>
</table>
</div>
</div>
    	