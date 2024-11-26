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
            <th>Hành động</th>
            <th>Tên thiết bị</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Ngày trả TT</th>
            <th>Trả về kho</th>
        </tr>
    </thead>
    <tbody>
     	<?php if($model->details == null):?>
     	<tr>
     		<td colspan="8">
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
            <td><?= $modelDetail->loaiVanHanhWithBadge ?></td>
            <td>
            <?php 
            if( ($modelDetail->phieuTraThietBiChiTiet && $modelDetail->phieuTraThietBiChiTiet->tra_khong_ve_kho) || $modelDetail->ngay_tra_thuc_te == null){
                if(!$modelDetail->id_ycvhct_chuyen){
                    echo  Html::a(
                        '<i class="fas fa fa-plus" aria-hidden="true"></i> Chuyển tiếp',
                        ['yeu-cau-chuyen-tiep/create?idycvhct='.$modelDetail->id],
                        ['role' => 'modal-remote', 'title' => 'Chuyển tiếp tài sản đi công trình', 'class' => 'btn btn-outline-primary']
                        );
                }
            ?>            
            <?php 
            }
            if($modelDetail->id_ycvhct_chuyen){
                $idPhieuChuyen = '';
                $ycvhCtModel  = YeuCauVanHanhCt::findOne($modelDetail->id_ycvhct_chuyen);
                if($ycvhCtModel){
                    $idPhieuChuyen = $ycvhCtModel->yeuCauVanHanh->id;
                }
                echo  Html::a(
                    '<i class="fas fa fa-eye" aria-hidden="true"></i> Xem phiếu chuyển',
                    ['yeu-cau-van-hanh/view?id='.$idPhieuChuyen],
                    ['role' => 'modal-remote', 'title' => 'Xem phiếu chuyển tiếp', 'class' => 'btn btn-outline-primary']
                    );
            }
            ?>
            </td>
            <td><?= $modelDetail->thietBi?$modelDetail->thietBi->ten_thiet_bi:'' ?></td>
            <td><?= $ngayBatDau ?></td>
            <td><?= $ngayKetThuc ?></td>
            <?php if($modelDetail->phieuTraThietBiChiTiet):?>
            <td><?= $ngayTraTT ?></td>
            <td><?= ($modelDetail->phieuTraThietBiChiTiet?
                ($modelDetail->phieuTraThietBiChiTiet->tra_khong_ve_kho? 'Còn tại công trình' : 'Đã chuyển về kho')
                :'')
            ?></td>
             <?php else: ?>
             <td colspan="2">Chưa trả</td>
             <?php endif;?>
        </tr>
        <?php endforeach; ?>
       
    </tbody>
</table>
</div>
</div>
    	