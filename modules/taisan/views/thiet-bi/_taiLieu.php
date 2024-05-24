<?php
use app\modules\dungchung\models\TaiLieu;
use app\modules\bophan\models\NhanVien;

$taiLieus = TaiLieu::getTaiLieuThamChieu(NhanVien::MODEL_ID, $model->id);
?>

<div class="card custom-card">
	<div class="card-body h-100">
		<div>
			<h6 class="card-title mb-1">Hình ảnh</h6>
		</div>
		<div class="row">
		
		
<div class="col-xl-3 col-lg-6 col-md-4 col-sm-4">
    <div class="card overflow-hidden custom-card">
        <a href="file-details.html" class="mx-auto my-4"><img src="<?= Yii::getAlias('@web') ?>/assets/images/media/files/23.png" alt="img"></a>
        <div class="card-footer py-2 px-3">
            <div class="d-flex">
                <div class="d-flex text-break">
                    <i class="mdi mdi-file-pdf tx-20 text-danger me-1"></i>
                    <h6 class="mb-0 mt-2 text-muted">file.pdf</h6>
                </div>
                <div class="ms-auto mt-2">
                    <h6 class="text-muted">32 KB</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6 col-md-4 col-sm-4">
    <div class="card overflow-hidden custom-card">
        <a href="file-details.html" class="mx-auto my-4"><img src="<?= Yii::getAlias('@web') ?>/assets/images/media/files/23.png" alt="img"></a>
        <div class="card-footer py-2 px-3">
            <div class="d-flex">
                <div class="d-flex text-break">
                    <i class="mdi mdi-file-pdf tx-20 text-danger me-1"></i>
                    <h6 class="mb-0 mt-2 text-muted">file.pdf</h6>
                </div>
                <div class="ms-auto mt-2">
                    <h6 class="text-muted">32 KB</h6>
                </div>
            </div>
        </div>
    </div>
</div>

</div><!-- row -->
</div>
</div>