<?php
use yii\helpers\Html;
use app\modules\dungchung\models\CustomFunc;
$custom = new CustomFunc();
$chiTiet=$model->ctPhieuMuaSams;
$baoGia = $model->baoGiaMuaSam;
$ngayYeuCau="";
if ($model->ngay_yeu_cau != null) {
    $ngayYeuCau = $custom->convertYMDToDMY($model->ngay_yeu_cau);
}
?>
<!-- <link href="/css/print-hoa-don.css" rel="stylesheet"> -->
<div class="row text-center" style="width: 100%">
    <div class="col-md-12" style="width: 100%"> 
    	<table id="table-top" style="width: 100%">
    		<tr>
    			<td width="100px">
    				<img src="/assets/images/brand/logo_500.png" width="100px" />
    			</td>
    			<td>
    				<span style="font-weight: bold; font-size:14pt">DNTN SX-TM NGUYỄN TRÌNH</span>
    				<br/>
    				<span style="font-size:10pt">ĐC: Nguyễn Đáng, Khóm 10, P.9, TP.TV</span>
    				<br/>
    				<span style="font-size:10pt">ĐT: 0903.794.530 - 0903.794.531 - 0903.794.532</span>
    				<br/>
    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:10pt">0903.794.533 - 0903.794.534 - 0903.794.535</span> 				
    			</td>
    			<td width="100px">
    				<div>
    				Số phiếu: PMS-<?= substr("0000000{$model->id}", -6) ?>
    				<br/>
    				(<?= $baoGia!=null?$baoGia->getDmTrangThai()[$baoGia->trang_thai]:'Không có BG'  ?>)
    				</div>
    			</td>
    		</tr>
    	</table>
    	
    	<table style="width: 100%">
    		<tr>
    			<td style="text-align: center"><span class="phieu-h1">PHIẾU YÊU CẦU MUA SẮM</span></td>
    		</tr>
    	</table>
    	
    	<table id="table-info" style="width: 100%; margin-top:30px;">
    		<tr>
    			<td>Bộ phận yêu cầu: <?= $model->tenBoPhanQuanLy ?></td>
    		</tr>
    		<tr>
    			<td>Người yêu cầu: <?= $model->tenNguoiQuanLy ?></td>
    		</tr>
    		<tr>
    			<td>Trung tâm mua sắm: <?= $model->trungTamMuaSam ? $model->trungTamMuaSam->ten_bo_phan : '' ?></td>
    		</tr>
    		<tr>
    			<td>Nội dung: <?= $model->ghi_chu ?></td>
    		</tr>
    		
    	</table>
    	
    	<p style="margin:5px 0px"><strong>Nội dung đề nghị mua sắm:</strong></p>
    	
    	<table class="table-content" style="width: 100%; margin-top:5px;">
    		<thead>
        		<tr>
        			<th width="50">STT</th>
        			<th width="150">Loại tài sản/thiết bị</th>
        			<th width="70">Tên tài sản/thiết bị</th>
        			<th width="70">Số lượng</th>
        			<th width="70">Đặc tính kỹ thuật</th>
        			<th width="100">Ghi chú</th>
        		</tr>   
    		</thead> 
    		<tbody>

    		<?php 
    		if($chiTiet==null){
    		?>
    		<tr>
            	<td colspan="6" style="text-align:center">Không có</td>
            </tr>
    		<?php 
    		} else {
    		    foreach ($chiTiet as $indexCt => $item){
            ?>
            <tr>
            	<td style="text-align:center"><?= ($indexCt+1) ?></td>
            	<td style="text-align:left"><?= $item->loaiThietBi?$item->loaiThietBi->ten_loai:'' ?></td>
            	<td style="text-align:left"><?= $item->ten_thiet_bi ?></td>
            	<td style="text-align:center"><?= $item->so_luong ?></td>
            	<td style="text-align:left"><?= $item->dac_tinh_ky_thuat ?></td>
            	<td style="text-align:left"><?= $item->ghi_chu ?></td>
            </tr>
            <?php }} ?>	
            </tbody>
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td style="text-align:right;font-weight:normal;font-style:italic">Trà Vinh, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?></td>
    		</tr>
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td style="text-align:left;font-weight:bold;">NGƯỜI YC</td>
    			<td style="text-align:center;font-weight:bold;">BỘ PHẬN YC</td>
    			<td style="text-align:center;font-weight:bold;">PHỤ TRÁCH</td>
    			<td style="text-align:right;font-weight:bold;">DUYỆT PHIẾU</td>
    		</tr>
    	</table>
    	   
    </div>
</div> <!-- row -->