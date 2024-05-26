<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên danh mục</th>
            <th>Số lượng</th>
            <th>Đơn vị tính</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model->ctBaoGiaSuaChuas as $item): ?>
            <tr>
                <td><?= $item->ten_danh_muc ?></td>
                <td><?= $item->so_luong ?></td>
                <td><?= $item->don_vi_tinh ?></td>
                <td><?= number_format($item->don_gia) ?></td>
                <td><?= number_format($item->thanh_tien) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>