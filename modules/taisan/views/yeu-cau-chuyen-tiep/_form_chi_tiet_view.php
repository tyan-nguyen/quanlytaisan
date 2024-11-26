<?php
use app\modules\dungchung\models\CustomFunc;
use yii\helpers\Html;
use app\modules\taisan\models\YeuCauVanHanhCt;
?>
<div class="row">
<div class="col-md-12 mt-2">
<table class="table table-striped table-bordered">
	<thead>
        <tr>
            <th>STT</th>
            <th>Loại vận hành</th>
            <!-- <th>Hành động</th> -->
            <th>Tên thiết bị</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
        </tr>
    </thead>
    <tbody>
     	<?php /*if($model->details == null):?>
     	<tr>
     		<td colspan="5">
         		Chưa có thiết bị.
			</td>
		</tr>
        <?php endif;*/?>
    	<?php 
    	$custom = new CustomFunc();
    	$modelDetail = $ycvhctModel;
    	$modelDetail->loai_van_hanh = YeuCauVanHanhCt::TYPE_VH_FORWARD;
    	//foreach ($model->details as $i => $modelDetail) : ?>
    	<?php 
    	   $ngayBatDau = $custom->convertYMDHISToDMY($modelDetail->ngay_bat_dau); 
    	   $ngayKetThuc = $custom->convertYMDHISToDMY($modelDetail->ngay_ket_thuc);
    	   $ngayTraTT = $custom->convertYMDHISToDMY($modelDetail->ngay_tra_thuc_te);
    	?>
    	<tr>
            <th scope="row">1</th>
            <td><?= $modelDetail->loaiVanHanhWithBadge ?></td>
            <!-- <td>
            <?php 
            if($modelDetail->phieuTraThietBiChiTiet && $modelDetail->phieuTraThietBiChiTiet->tra_khong_ve_kho){
                if(!$modelDetail->id_ycvhct_chuyen){
                    echo  Html::a(
                        '<i class="fas fa fa-plus" aria-hidden="true"></i> Chuyển tiếp',
                        ['yeu-cau-chuyen-tiep/create?idycvhct='.$modelDetail->id],
                        ['role' => 'modal-remote', 'title' => 'Chuyển tiếp tài sản đi công trình', 'class' => 'btn btn-outline-primary']
                        );
                }else{
                    echo 'Link to phiếu chuyển';
                }
            ?>
            
            <?php 
            }
            ?>
            </td> -->
            <td><?= $modelDetail->thietBi?$modelDetail->thietBi->ten_thiet_bi:'' ?></td>
            <td>Lưu thông tin phiếu để nhập</td>
            <td>Lưu thông tin phiếu để nhập</td>
           
            
        </tr>
        <?php // endforeach; ?>
       
    </tbody>
</table>
</div>
</div>
    	