<?php
use yii\helpers\Html;
use app\modules\dungchung\models\CustomFunc;
$custom = new CustomFunc();
$baoGia=$model->baoGiaSuaChua;
$thietBi=$model->thietBi;
$ngaySuaChua="";
if ($model->ngay_sua_chua != null) {
    $ngaySuaChua = $custom->convertYMDToDMY($model->ngay_sua_chua);
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
    				Số phiếu: P-<?= substr("0000000{$model->id}", -6) ?>
    				<!-- <br/>
    				(<?= $baoGia!=null?$baoGia->getDmTrangThai()[$baoGia->trang_thai]:'Không có BG'  ?>) -->
    				<?= $model->trangThaiXuatKho!=null?('<br/>Xuất kho: ' . $model->trangThaiXuatKho):'VT kho: Chưa duyệt'  ?>
    				</div>
    			</td>
    		</tr>
    	</table>
    	
    	<table style="width: 100%">
    		<tr>
    			<td style="text-align: center"><span class="phieu-h1">PHIẾU XUẤT KHO VẬT TƯ</span></td>
    		</tr>
    	</table>
    	
    	<table id="table-info" style="width: 100%; margin-top:30px;">
    		<tr>
    			<td>Tên hệ thống, thiết bị: <?= $thietBi->ten_thiet_bi ?></td>
    		</tr>
    		<tr>
    			<td>Địa điểm: <?= $model->dia_chi ?></td>
    		</tr>
    		<tr>
    			<td>Bộ phận yêu cầu: <?= $thietBi->boPhanQuanLy ? $thietBi->boPhanQuanLy->ten_bo_phan : "" ?></td>
    		</tr>
    		<tr>
    			<td>Người chịu trách nhiệm: <?= $thietBi->nguoiQuanLy ? $thietBi->nguoiQuanLy->ten_nhan_vien : "" ?></td>
    		</tr>
    		<tr>
    			<td>Lý do: <?= $model->ghi_chu1 ?></td>
    		</tr>
    		
    	</table>
    	
    	<p style="margin:5px 0px"><strong>Vật tư đề nghị (nếu có):</strong></p>
    	<table class="table-content" style="width: 100%; margin-top:5px;">
    		<thead>
        		<tr>
        			<th width="50">STT</th>
        			<th width="150">Tên vật tư</th>
        			<th width="70">Hãng sản xuất</th>
        			<th width="70">Đơn vị tính</th>
        			<th width="70">Số lượng</th>
        			<th width="100">Ghi chú</th>
        		</tr>   
    		</thead> 
    		<tbody>

    		<?php 
    		if(!$model->vatTus){
    		?>
    		 <tr>
            	<td colspan="6" style="text-align:center">Không đề nghị vật tư</td>
            </tr>
    		<?php     
    		} else {
    		foreach ($model->vatTus as $indexCt => $item){
            ?>
            <tr>
            	<td style="text-align:center"><?= ($indexCt+1) ?></td>
            	<td style="text-align:left"><?= $item->vatTu->ten_vat_tu ?></td>
            	<td style="text-align:right"><?= $item->vatTu->hang_san_xuat ?></td>
            	<td style="text-align:center"><?= $item->don_vi_tinh ?></td>
            	<td style="text-align:right"><?= $item->so_luong ?></td>
            	<td><?= $item->ghi_chu ?></td>
            </tr>
            <?php } } ?>	
            </tbody>
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td style="text-align:right;font-weight:normal;font-style:italic">Trà Vinh, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?></td>
    		</tr>
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td style="text-align:left;font-weight:bold;">TRUNG TÂM SỬA CHỮA</td>
    			<td style="text-align:right;font-weight:bold;">THỦ KHO</td>
    		</tr>
    	</table>
    	
    	
    	
    	
    	
    	   
    </div>
</div> <!-- row -->