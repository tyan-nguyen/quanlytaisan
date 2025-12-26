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
	<p>Loại: <?= $model->tenLoaiThietBi ?></p>
	<p>Bộ phận: <?= $model->tenBoPhanQuanLy ?></p>
	<p>Người quản lý: <?= $model->tenNguoiQuanLy ?></p>
	<p>Hình ảnh</p>
	<?php 
	   $data = HinhAnh::getHinhAnhThamChieu(ThietBi::MODEL_ID, $model->id);
	   if($data){
	       foreach ($data as $iData=>$val){
	           echo '<img src="'.$val->hinhAnhUrl.'" width="200" />';
	       }
	   }
	?>
	
</div>