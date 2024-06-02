<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;

$cus = new CustomFunc();
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Lần BG</th>
            <th>Ngày gửi BG</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th>Ngày duyệt BG</th>
            <th>Người duyệt</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model->lichSuBaoGiaSuaChuas as $item): ?>
            <tr>
                <td><?= $item->so_bao_gia ?></td>
                <td><?= $item->ngay_gui_bg ? $cus->convertYMDHISToDMYHID($item->ngay_gui_bg): "-" ?></td>
                <td><?= $item->getDmTrangThai()[$item->trang_thai] ?></td>
                <td><?= number_format($item->tong_tien) ?></td>
                <td><?= $item->ngay_ket_thuc ? $cus->convertYMDHISToDMYHID($item->ngay_ket_thuc): "-" ?></td>
                <td><?= $item->nguoiDuyet->username ?? "" ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>