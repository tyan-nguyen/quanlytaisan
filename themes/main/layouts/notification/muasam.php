<?php
use app\modules\muasam\models\PhieuMuaSam;


?>
<?php foreach($phieuMuaSamNew as $key => $value) { ?>
<div class="dropdown-item d-flex border-bottom pb-1 align-items-center">
    <a href="/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam?id_phieu_mua_sam=<?= $value->id ?>" class="cart-link"></a>
    
    <div class="ms-12">
        <p class="mb-0 tx-14 text-dark fw-medium"><?= 'P'.str_pad($value->id, 6, '0', STR_PAD_LEFT).'- Mua sắm '.$value->getDmMuaSam()[$value->dm_mua_sam] ?></p>
        <div class=" mb-0">
            <span class="tx-14  text-muted mb-0"><?= $value->getDmTrangThai()[$value->trang_thai] ?></span>
        </div>
    </div>

</div>
<?php } ?>