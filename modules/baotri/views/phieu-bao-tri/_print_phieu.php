<?php
use yii\helpers\Html;
use app\modules\dungchung\models\CustomFunc;
$custom = new CustomFunc();
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
    				<div> Phiếu bảo trì # <?= $model->id_ke_hoach ?> </div>
    			</td>
    		</tr>
    	</table>
    	
    	<table style="width: 100%">
    		<tr>
    			<td style="text-align: center"><span class="phieu-h1">PHIẾU BẢO TRÌ</span></td>
    		</tr>
    	</table>
    	
    	<table id="table-info" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td colspan="2">
    				- Thiết bị bảo trì/Bảo dưỡng: <?= $model->keHoach ? $model->keHoach->thietBi->ten_thiet_bi : '' ?>			
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				- Đơn vị bảo trì: <?= $model->donViBaoTri ? $model->donViBaoTri->ten_bo_phan : '' ?>			
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				- Người chịu trách nhiệm: <?= $model->nguoiChiuTrachNhiem ? $model->nguoiChiuTrachNhiem->ten_nhan_vien : '' ?>	
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				- Đơn vị quản lý: <?= $model->keHoach ? $model->keHoach->thietBi->tenBoPhanQuanLy : '' ?>	
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				- Tên công việc: <?= $model->keHoach->ten_cong_viec ?>
    			</td>
    		</tr>
    		
    		<tr>
    			<td colspan="2">
    				- Bảo trì lần thứ: <?= $model->ky_thu ?>
    			</td>
    		</tr>
    		
    		<tr>
    			<td>
    				Ngày thực hiện:<?= $custom->convertYMDHISToDMY($model->thoi_gian_bat_dau) ?>
    			</td>
    			<td>
    				Ngày hoàn thành:<?= $custom->convertYMDHISToDMY($model->thoi_gian_ket_thuc) ?>
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				<strong>Nội dung thực hiện:</strong>
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				<?= $model->noi_dung_thuc_hien ?>
    			</td>
    		</tr>
    	
    		
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td style="text-align:right;font-weight:normal;font-style:italic">Trà Vinh, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?></td>
    		</tr>
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td style="text-align:center;font-weight:bold;">CHỊU TRÁCH NHIỆM</td>
    			<td style="text-align:right;font-weight:bold;">ĐƠN VỊ QUẢN LÝ</td>
    			<td style="text-align:right;font-weight:bold;">ĐƠN VỊ THỰC HIỆN</td>
    		</tr>
    	</table>
    	
    	
    	
    	
    	
    	   
    </div>
</div> <!-- row -->