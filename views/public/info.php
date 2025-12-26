<?php
use app\modules\dungchung\models\HinhAnh;
use app\modules\taisan\models\ThietBi;
?>
<div style="text-align:center">
	<img src="/assets/images/brand/favicon.png" width="100" />
	<h3 style="margin-top:5px">DNTN SX-TM NGUYỄN TRÌNH</h3>
</div>
<div>
	<h3><?= $model->ten_thiet_bi ?></h3>
	<p>Mã thiết bị: <?= $model->ma_thiet_bi ?></p>
	<p>Loại: <?= $model->tenLoaiThietBi ?></p>
	<p>Bộ phận: <?= $model->tenBoPhanQuanLy ?></p>
	<p>Người quản lý: <?= $model->tenNguoiQuanLy ?></p>
	<?php if($model->nam_san_xuat) { ?>
	<p>Năm sản xuất: <?= $model->nam_san_xuat ?></p>
	<?php } ?>
	<?php if($model->serial) { ?>
	<p>Serial: <?= $model->serial ?></p>
	<?php } ?>
	<?php if($model->so_khung) { ?>
	<p>Số khung: <?= $model->so_khung ?></p>
	<?php } ?>
	<?php if($model->so_may) { ?>
	<p>Số máy: <?= $model->so_may ?></p>
	<?php } ?>
	<?php if($model->model) { ?>
	<p>Model: <?= $model->model ?></p>
	<?php } ?>
	<?php if($model->xuat_xu) { ?>
	<p>Xuất xứ: <?= $model->xuat_xu ?></p>
	<?php } ?>
	<?php if($model->dac_tinh_ky_thuat) { ?>
	<p>Đặc tính kỹ thuật: <?= $model->dac_tinh_ky_thuat ?></p>
	<?php } ?>
	<p><strong>Hình ảnh</strong></p>
	<p style="text-align: center">
	<?php 
	   $data = HinhAnh::getHinhAnhThamChieu(ThietBi::MODEL_ID, $model->id);
	   if($data){
	       foreach ($data as $iData=>$val){
	           echo '<img src="'.$val->hinhAnhUrl.'" width="200" />';
	       }
	   }
	?>
	</p>
	
</div>