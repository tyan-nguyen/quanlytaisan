<?php
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
    				<div><?= 'P-' . substr("0000000{$model->id}", -6) ?> </div>
    			</td>
    		</tr>
    	</table>
    	
    	<table style="width: 100%">
    		<tr>
    			<td style="text-align: center"><span class="phieu-h1">PHIẾU YÊU CẦU VẬN HÀNH THIẾT BỊ/TÀI SẢN</span></td>
    		</tr>
    	</table>
    	
    	<table id="table-info" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td>Người yêu cầu thiết bị/tài sản: <strong><?= $model->nguoiYeuCau ? $model->nguoiYeuCau->ten_nhan_vien : '' ?></strong> </td>
    			<td> Bộ phận: <?= $model->boPhan?$model->boPhan->ten_bo_phan:'' ?></td>
    		</tr>
    		<tr>
    			<td>Ngày yêu cầu: <?= $custom->convertYMDToDMY($model->ngay_lap) ?></td>
    		
    			<td>Lý do: <?= $model->ly_do ?></td>
    		</tr>
    		<tr>
    			<td>Công trình/Dự án: <?= $model->cong_trinh ?></td>
    		
    			<td>Địa điểm: <?= $model->dia_diem ?></td>
    		</tr>
    	
    		<tr>
    			<td colspan="2">
    				<strong>Nội dung lập phiếu: </strong> <?= $model->noi_dung_lap ?>
    			</td>
    		</tr>
    		
    	</table>
    	
    	<table class="table-content" style="width: 100%; margin-top:5px;">
    		<thead>
        		<tr>
        			<th width="50">STT</th>
        			<th width="150">Tên thiết bị</th>
        			<th width="70">Ngày bắt đầu</th>
        			<th width="70">Ngày trả dự kiến</th>
        			<th width="100">Ghi chú</th>
        		</tr>   
    		</thead> 
    		<tbody>

    		<?php 
    		foreach ($model->details as $indexCt => $ct){
            ?>
            <tr>
            	<td style="text-align:center"><?= ($indexCt+1) ?></td>
            	<td style="text-align:left"><?= $ct->thietBi?$ct->thietBi->ten_thiet_bi:'' ?></td>
            	<td style="text-align:center"><?= $custom->convertYMDHISToDMY($ct->ngay_bat_dau) ?></td>
            	<td style="text-align:left"><?= $custom->convertYMDHISToDMY($ct->ngay_ket_thuc) ?></td>
            	<td></td>
            </tr>
            <?php } ?>	
            </tbody>
    </table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td style="text-align:right;font-weight:normal;font-style:italic">Trà Vinh, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?></td>
    		</tr>
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:10px;">
    		<tr>
    			<td style="text-align:left;font-weight:bold;">NGƯỜI YÊU CẦU</td>
    			<td style="text-align:center;font-weight:bold;">BỘ PHẬN YÊU CẦU</td>
    			<td style="text-align:center;font-weight:bold;">NGƯỜI TIẾP NHẬN</td>
    			<td style="text-align:right;font-weight:bold;">NGƯỜI DUYỆT</td>
    		</tr>
    	</table>
    	
    	
    	
    	
    	
    	   
    </div>
</div> <!-- row -->