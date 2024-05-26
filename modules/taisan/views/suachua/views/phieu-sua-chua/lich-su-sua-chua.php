<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;

$cus = new CustomFunc();
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Trung tâm sửa chữa</th>
            <th>Ngày sửa chữa</th>
            <th>Ngày hoàn thành</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th>Đánh giá</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model->lichSuSuaChuas as $item): ?>
            <tr>
                <td><?= $item->ttSuaChua->ten_tt_sua_chua ?></td>
                <td><?= $item->ngay_sua_chua ? $cus->convertYMDHISToDMYHID($item->ngay_sua_chua): "-" ?></td>
                <td><?= $item->ngay_hoan_thanh ? $cus->convertYMDHISToDMYHID($item->ngay_hoan_thanh): "-" ?></td>
                <td><?= $item->getDmTrangThai()[$item->trang_thai] ?></td>
                <td><?= number_format($item->tong_tien) ?></td>
                <td><input type="hidden" class="rating" data-filled="fa-solid fa-star" data-empty="fa-regular fa-star" data-readonly value='<?= $item->danh_gia_sc ?>'/> </td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>