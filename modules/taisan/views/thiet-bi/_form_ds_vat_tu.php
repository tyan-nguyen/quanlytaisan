<?php
use app\modules\dungchung\models\CustomFunc;
use yii\helpers\Html;
?>
<div class="tab-menu-heading">
	<div class="tabs-menu1">
		<!-- Tabs -->
		<ul class="nav panel-tabs" role="tablist">
			<li><a href="#tabvt1" class="active" data-bs-toggle="tab" aria-selected="true" role="tab">
				<i class="fa fa-toggle-on"></i> Vật tư/Phụ tùng đang hoạt động
			</a></li>
			<li><a href="#tabvt2" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">
				<i class="fa fa-minus-circle"></i> Vật tư hỏng/thanh lý
			</a></li>
		</ul>
	</div>
</div>


<div class="row">
    <div class="col-md-12 text-end mt-2">
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/taisan/thiet-bi-vat-tu-ajax/create', 'idThietBi'=>$model->id], [
        'role'=>'modal-remote-2',
        'class'=>'add-item btn btn-primary btn-xs'
    ]) ?> 
    </div>               

<div class="tabs-menu-body">


                
    <div class="tab-content">
    	<div class="tab-pane active show" id="tabvt1" role="tabpanel">
    		
                
                
                <div class="col-md-12 mt-2">
                <table class="table table-striped table-bordered">
                	<thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên vật tư</th>
                            <th>Model</th>
                            <th>Số serial</th>
                            <th>Ngày thêm</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    	if($model->vatTuHoatDongs == null){
                    	  echo '<tr><td colspan="7">Chưa có vật tư/phụ tùng chi tiết</td></tr>';     
                    	}
                    	$custom = new CustomFunc();
                    	foreach ($model->vatTuHoatDongs as $i => $modelDetail) : ?>
                    	<?php 
                    	   $ngayThem = $custom->convertYMDHISToDMY($modelDetail->thoi_gian_tao); 
                    	?>
                    	<tr>
                            <th scope="row"><?= $i+1 ?></th>
                            <td><?= $modelDetail->vatTu?$modelDetail->vatTu->ten_vat_tu:'' ?></td>
                            <td><?= $modelDetail->model?></td>
                            <td><?= $modelDetail->so_serial ?></td>
                            <td><?= $ngayThem ?></td>
                            <td><?= $modelDetail->tenTrangThai ?></td>
                            <td>
                            	<?= Html::a('<span class="fa fa-eye"></span> Xem', ['/taisan/thiet-bi-vat-tu-ajax/view', 'id'=>$modelDetail->id], [
                            	    'role'=>'modal-remote-2',
                            	    'class'=>'btn ripple btn-info btn-sm'
                            	]) ?>
                            	<?= Html::a('<span class="fas fa-pencil-alt"></span> Sửa', ['/taisan/thiet-bi-vat-tu-ajax/update', 'id'=>$modelDetail->id], [
                            	    'role'=>'modal-remote-2',
                            	    'class'=>'btn ripple btn-info btn-sm'
                            	]) ?>
                            	<?= (!$modelDetail->id_phieu_sua_chua?Html::a('<span class="fa fa-mail-reply"></span> Trả về kho', ['/taisan/thiet-bi-vat-tu-ajax/delete-va-tra-lai-kho', 'id'=>$modelDetail->id], [
                            	    'role'=>'modal-remote-2',
                            	    'class'=>'btn ripple btn-secondary btn-sm',
                            	    'data-request-method'=>'post',
                            	    'data-confirm-title'=>'Xác nhận trả lại kho?',
                            	    'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?'            	    
                            	]):'') ?>
                            	<?= Html::a('<span class="fas fa-trash-alt"></span> Xóa', ['/taisan/thiet-bi-vat-tu-ajax/delete', 'id'=>$modelDetail->id], [
                            	    'role'=>'modal-remote-2',
                            	    'class'=>'btn ripple btn-secondary btn-sm',
                            	    'data-request-method'=>'post',
                            	    'data-confirm-title'=>'Xác nhận xóa vật tư khỏi thiết bị?',
                            	    'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?'            	    
                            	]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
    		

    	</div>
    	<div class="tab-pane" id="tabvt2" role="tabpanel">    		
            <div class="col-md-12 mt-2">
            <table class="table table-striped table-bordered">
            	<thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên vật tư</th>
                        <th>Model</th>
                        <th>Số serial</th>
                        <th>Ngày thêm</th>
                        <th>Trạng thái</th>
                        <th>Kho</th>
                        <th>Phiếu sửa chữa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                	if($model->vatTuKhongHoatDongs == null){
                	    echo '<tr><td colspan="9">Chưa có vật tư/phụ tùng chi tiết đã hỏng/thanh lý</td></tr>';
                	}
                	$custom = new CustomFunc();
                	foreach ($model->vatTuKhongHoatDongs as $i => $modelDetail) : ?>
                	<?php 
                	   $ngayThem = $custom->convertYMDHISToDMY($modelDetail->thoi_gian_tao); 
                	?>
                	<tr>
                        <th scope="row"><?= $i+1 ?></th>
                        <td><?= $modelDetail->vatTu?$modelDetail->vatTu->ten_vat_tu:'' ?></td>
                        <td><?= $modelDetail->model?></td>
                        <td><?= $modelDetail->so_serial ?></td>
                        <td><?= $ngayThem ?></td>
                        <td><?= $modelDetail->tenTrangThai ?></td>
                        <td><?= $modelDetail->kho?$modelDetail->kho->ma_kho:'' ?></td>
                        <td><?= ($modelDetail->id_phieu_sua_chua?Html::a('<span class="fa fa-mail-forward"></span> Phiếu sửa', ['/suachua/phieu-sua-chua/chi-tiet-phieu-sua-chua', 'id_phieu_sua_chua'=>$modelDetail->id_phieu_sua_chua], [
                        	    'data-pjax'=>0,
                        	    'class'=>'btn ripple btn-info btn-sm',
                                'target'=>'_blank'
                        	]):'')?></td>
                        <td>
                        	<?= Html::a('<span class="fa fa-eye"></span> Xem', ['/taisan/thiet-bi-vat-tu-ajax/view', 'id'=>$modelDetail->id], [
                        	    'role'=>'modal-remote-2',
                        	    'class'=>'btn ripple btn-info btn-sm'
                        	]) ?>
                        	<?= Html::a('<span class="fas fa-pencil-alt"></span> Sửa', ['/taisan/thiet-bi-vat-tu-ajax/update', 'id'=>$modelDetail->id], [
                        	    'role'=>'modal-remote-2',
                        	    'class'=>'btn ripple btn-info btn-sm'
                        	]) ?>
                        	<?php /* Html::a('<span class="fa fa-mail-reply"></span> Trả về kho', ['/taisan/thiet-bi-vat-tu-ajax/delete-va-tra-lai-kho', 'id'=>$modelDetail->id], [
                        	    'role'=>'modal-remote-2',
                        	    'class'=>'btn ripple btn-secondary btn-sm',
                        	    'data-request-method'=>'post',
                        	    'data-confirm-title'=>'Xác nhận trả lại kho?',
                        	    'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?'            	    
                        	])*/ ?>
                        	<?= Html::a('<span class="fas fa-trash-alt"></span> Xóa', ['/taisan/thiet-bi-vat-tu-ajax/delete', 'id'=>$modelDetail->id], [
                        	    'role'=>'modal-remote-2',
                        	    'class'=>'btn ripple btn-secondary btn-sm',
                        	    'data-request-method'=>'post',
                        	    'data-confirm-title'=>'Xác nhận xóa vật tư khỏi thiết bị?',
                        	    'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?'            	    
                        	]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>

    	</div>
    	
    </div>
</div>
												







</div>
    	