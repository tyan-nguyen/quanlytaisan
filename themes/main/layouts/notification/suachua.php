<?php

$phieuSuaChuas=$phieuSuaChua->limit(10)->all();

?>
<?php foreach($phieuSuaChuas as $key => $value) { ?>
<div class="dropdown-item d-flex border-bottom pb-1 align-items-center">
    <a href="/suachua/phieu-sua-chua/chi-tiet-phieu-sua-chua?id_phieu_sua_chua=<?= $value->phieuSuaChua->id ?>" class="cart-link"></a>
    
    <div class="ms-12">
        <p class="mb-0 tx-14 text-dark fw-medium text-wrap"><?= 'Sửa chữa '.$value->ten_thiet_bi ?? "" ?></p>
        <div class=" mb-0">
            <span class="tx-14  text-muted mb-0"><?= $value->getDmTrangThai()[$value->trang_thai] ?></span>
        </div>
    </div>

</div>
<?php } ?>