<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;
use yii\bootstrap5\Html;

?>
<?= Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm báo giá', ['/muasam/bao-gia-mua-sam/create','id_phieu_mua_sam'=>$phieuMuaSam->id],
                    ['role'=>'modal-remote-2','title'=> 'Thêm mới báo giá mua sắm','class'=>'btn btn-outline-primary']) ?>


<table id="dv_bao_gia" class="kv-grid-table table table-bordered table-sm kv-table-wrap">
    <thead>
        <tr>
            <th>Đơn vị báo giá</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($phieuMuaSam->baoGiaMuaSams as $key => $value) { ?>
        <tr>
            <td><?php 
                $dv=$value->dvBaoGia;
                $tenDv=$dv ? $dv->ten_doi_tac : '--';
                $html=Html::a($tenDv, ['','id_phieu_mua_sam'=>$value->id_phieu_mua_sam],
                ['data-pjax'=>1,'title'=>$tenDv]);
                echo $html;
            ?></td>
            <td>Delete</td>
        </tr>
        <?php } ?>
        <!-- Thêm các hàng khác nếu cần -->
    </tbody>
</table>