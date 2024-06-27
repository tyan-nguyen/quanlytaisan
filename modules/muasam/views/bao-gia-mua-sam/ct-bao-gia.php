<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên thiết bị</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model->ctBaoGiaMuaSams as $item): ?>
            <tr>
                <td><?= $item->ctPhieuMuaSam->ten_thiet_bi ?></td>
                <td><?= $item->so_luong ?></td>
                <td><?= number_format($item->don_gia) ?></td>
                <td><?= number_format($item->thanh_tien) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>