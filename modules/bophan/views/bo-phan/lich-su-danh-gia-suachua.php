<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;

$cus = new CustomFunc();
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Thiết bị</th>
            <th>Ngày sửa chữa</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th>Đánh giá</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model->lichSuSuaChua as $item): ?>
            <tr>
                <td><?= $item->thietBi->ten_thiet_bi ?></td>
                <td><?= $item->ngay_sua_chua ? $cus->convertYMDHISToDMYHID($item->ngay_sua_chua): "-" ?></td>
    
                <td><?= $item->getDmTrangThai()[$item->trang_thai] ?></td>
                <td><?= number_format($item->tong_tien) ?></td>
                <td>
                <div class="star-ratings-css" title="<?= $item->danh_gia_sc ?? 0 ?>">
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