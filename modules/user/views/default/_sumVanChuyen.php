<?php
use app\modules\taisan\models\LoaiThietBi;
?>
<div class="card card-img-holder card-img-holder-info overflow-hidden">
	<div class="card-body">
		<div class="row">
			<div class="col-xl-6 pe-0">
				<p class="mb-2">
					<span class="tx-15">XE VẬN CHUYỂN</span>
				</p>
				<p class="mb-2 tx-12">
					<span class="tx-25 fw-500 lh-1 vertical-bottom mb-0"><?= number_format($dash->getSumLoaiThietBiDangHoatDong(LoaiThietBi::TYPE_VANCHUYEN)) ?></span>
					<span class="d-block tx-10 font-weight-semibold text-muted">Đang hoạt động</span>
				</p>
				<a href="<?= Yii::getAlias('@web/taisan/thiet-bi') ?>" class="tx-12 mb-0 text-info">Vào trang quản lý<i class="ti ti-chevron-right ms-1"></i></a>
			</div>
			<div class="col-xl-6">
				<p class="main-card-icon mb-0 bg-info-transparent">
					<img src="<?= Yii::getAlias('@web') ?>/uploads/icons/truck.png" width="25"/>
					<!-- <svg class="svg-primary" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path></svg>-->
				</p>
			</div>
		</div>
	</div>
</div>