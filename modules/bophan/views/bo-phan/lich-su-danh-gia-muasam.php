<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;

$cus = new CustomFunc();
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Số phiếu</th>
            <th>Ngày yêu cầu</th>
            <th>Loại</th>
            <th>Trạng thái</th>
            <th>Đánh giá</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model->lichSuMuaSam as $item): ?>
            <tr>
                <td><?= 'P'.str_pad($item->id, 6, '0', STR_PAD_LEFT) ?></td>
                <td><?= $item->ngay_yeu_cau ? $cus->convertYMDHISToDMYHID($item->ngay_yeu_cau): "-" ?></td>
                <td><?= $item->getDmMuaSam()[$item->dm_mua_sam] ?></td>
                <td><?= $item->getDmTrangThai()[$item->trang_thai] ?></td>
                <td>
                <div class="star-ratings-css" title="<?= $item->danh_gia_ms ?? 0 ?>">
                </div>
                    
                </td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
$this->registerCssFile('@web/css/bootstrap-rating.css', [
    //'depends' => [\yii\web\JqueryAsset::className()]
    'position' => \yii\web\View::POS_END
]);

?>