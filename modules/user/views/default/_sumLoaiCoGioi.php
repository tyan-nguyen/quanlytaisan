<?php
use app\modules\taisan\models\LoaiThietBi;
?>
<div class="card card-img-holder card-img-holder-secondary overflow-hidden">
	<div class="card-body">
		<div class="row">
			<div class="col-xl-6 pe-0">
				<p class="mb-2">
					<span class="tx-15">XE CƠ GIỚI</span>
				</p>
				<p class="mb-2 tx-12">
					<span class="tx-25 fw-500 lh-1 vertical-bottom mb-0">
						<?= number_format($dash->getSumLoaiThietBiDangHoatDong(LoaiThietBi::TYPE_COGIOI)) ?>
					</span>
					<span class="d-block tx-10 font-weight-semibold text-muted">Đang hoạt động</span>
				</p>
				<a href="<?= Yii::getAlias('@web/taisan/thiet-bi') ?>" class="tx-12 mb-0 text-secondary">Vào trang quản lý<i class="ti ti-chevron-right ms-1"></i></a>
			</div>
			<div class="col-xl-6">
				<p class="main-card-icon mb-0 bg-secondary-transparent">
					<img src="<?= Yii::getAlias('@web') ?>/uploads/icons/icon-xe-cau.png" width="25"/>
					<!-- <svg class="svg-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"></rect></g><g><g><path d="M12,6c-3.87,0-7,3.13-7,7s3.13,7,7,7s7-3.13,7-7S15.87,6,12,6z M13,14h-2V8h2V14z" opacity=".3"></path><rect height="2" width="6" x="9" y="1"></rect><path d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M12,20c-3.87,0-7-3.13-7-7s3.13-7,7-7s7,3.13,7,7S15.87,20,12,20z"></path><rect height="6" width="2" x="11" y="8"></rect></g></g></svg>-->
				</p>
			</div>
		</div>
	</div>
</div>