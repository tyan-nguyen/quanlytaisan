<?php
    use app\modules\baotri\models\KeHoachBaoTri;
use yii\helpers\Html;
use yii\bootstrap5\Modal;
use cangak\ajaxcrud\CrudAsset; 
use app\modules\suachua\models\PhieuSuaChua;
use app\modules\taisan\models\YeuCauVanHanh;
//CrudAsset::register($this);

$this->title = "Thống kê hoạt động tài sản";

?>

<style>
body .select2-container {
    z-index: 999 !important;
}
</style>

<div class="card border-default">
	<div class="card-header bg-light text-dark">
		<h5 class="m-0"><i class="fas fa fa-list" aria-hidden="true"></i> Thống kê hoạt động tài sản</h5>
	</div>
	<div class="kv-panel-before">
		<?= $this->render('ts-hoat-dong-search', [
		    'idThietBi'=>$idThietBi,
		    'tuNgay'=>$tuNgay,
		    'denNgay'=>$denNgay,
		    'showBaoTri'=>$showBaoTri,
		    'showSuaChua'=>$showSuaChua,
		    'showVanHanh'=>$showVanHanh
		]) ?>
	</div>
	<div class="grid-view is-bs4 kv-grid-bs4 kv-grid-panel hide-resize">
    	<?php 
    	if($lichSuHoatDong){
        ?>
        <table class="kv-grid-table table table-bordered table-sm kv-table-wrap">
        <thead class="kv-table-header crud-datatable">
            <tr>
            	<td width="50">STT</td>
            	<td width="75"></td>
            	<?php if(!isset($idThietBi) || !$idThietBi): ?>
            	<td width="300">Tên thiết bị</td>
            	<?php endif ?>
            	<td width="150">Trạng thái</td>
            	<td width="150">Loại hoạt động</td>
            	<td width="120">Ngày</td>
            	<td width="120">Ngày hoàn thành</td>
            	<td width="120">Số ngày</td>
            	<td>Nội dung</td>
            </tr>
        </thead>
        <?php 
            $stt = 0;
            foreach ($lichSuHoatDong as $ls){
                $stt++;
        ?>
        <tr>
        	<td class="text-center"><?= $stt ?></td>
        	<td>
        		<?php 
        		if($ls['loai'] == KeHoachBaoTri::MODEL_ID){
        		    echo Html::a('<i class="fas fa-eye"></i> Xem', ['/baotri/phieu-bao-tri/view', 'id'=>$ls['tham_chieu']], ['role'=>'modal-remote', 'class'=>'text-primary']);
        		} else if($ls['loai'] == PhieuSuaChua::MODEL_ID){
        		    echo Html::a('<i class="fas fa-eye"></i> Xem', ['/suachua/phieu-sua-chua/chi-tiet-phieu-sua-chua', 'id_phieu_sua_chua'=>$ls['tham_chieu']], ['target'=>'_blank', 'class'=>'text-primary']);
        		}else if($ls['loai'] == YeuCauVanHanh::MODEL_ID){
        		    echo Html::a('<i class="fas fa-eye"></i> Xem', ['/taisan/yeu-cau-van-hanh/view', 'id'=>$ls['tham_chieu']], ['role'=>'modal-remote', 'class'=>'text-primary']);
        		}
        		?>
        	</td>
        	
        	<?php if(!isset($idThietBi) || !$idThietBi): ?>
            	<td><?= $ls['ten_thiet_bi'] ?></td>
            <?php endif ?>
            
            <td><?= $ls['status'] ?></td>	
            
        	<td><?php 
        	if($ls['loai'] == KeHoachBaoTri::MODEL_ID){
        	    echo '<span class="badge bg-secondary">Bảo trì định kỳ</span>';
        	} else if($ls['loai'] == PhieuSuaChua::MODEL_ID){
        	    echo '<span class="badge bg-warning">Sửa chữa thiết bị</span>';
        	}else if($ls['loai'] == YeuCauVanHanh::MODEL_ID){
        	    echo '<span class="badge bg-primary">Vận hành thiết bị</span>';
        	}
        	?></td>
        	
        	<td><?= $ls['ngay'] ?></td>
        	<td><?= $ls['ngay_ht'] ?></td>
        	<td><?= $ls['ngay_hd'] ?></td>
        	<td><?= $ls['noi_dung'] ?></td>
        </tr>
        <?php         
            }
        ?>
        <tr>
        	<td colspan="<?= ((!isset($idThietBi) || !$idThietBi) ? 7 : 6) ?>" align="right"><span style="font-weight:bold;text-transform: uppercase;">Tổng ngày sử dụng</span></td>
        	<td><span style="font-weight:bold;text-transform: uppercase;"><?= array_sum(array_column($lichSuHoatDong, 'ngay_hd'));  ?></span></td>
        	<td></td>
        </tr>
        </table>
        <?php 
    	} else {
        ?>
        <div class="alert alert-default" role="alert">
			<span class="alert-inner--text">Vui lòng nhập thông tin cần thống kê</span>
		</div>
        <?php } ?>
    </div>
</div>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
   'dialogOptions'=>['class'=>'modal-xl'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'clientOptions' => ['backdrop' => false],
   'id'=>'ajaxCrudModal',
    'footer'=>'',// always need it for jquery plugin
])?>

<?php Modal::end(); ?>