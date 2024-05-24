<div class="card card-img-holder card-img-holder-primary overflow-hidden">
	<div class="card-body">
		<div class="row">
			<div class="col-xl-6 pe-0">
				<p class="mb-2">
					<span class="tx-15">TÀI SẢN</span>
				</p>
				<p class="mb-2 tx-12">
					<span class="tx-25 fw-500 lh-1 vertical-bottom mb-0"><?= number_format($dash->getSumTaiSanDangHoatDong()) ?></span>
					<span class="d-block tx-10 font-weight-semibold text-muted">Đang hoạt động</span>
				</p>
				<a href="<?= Yii::getAlias('@web/taisan/thiet-bi') ?>" class="tx-12 mb-0 text-primary">Vào trang quản lý<i class="ti ti-chevron-right ms-1"></i></a>
			</div>
			<div class="col-xl-6">
				<p class="main-card-icon mb-0 bg-primary-transparent">
					<img src="<?= Yii::getAlias('@web') ?>/uploads/icons/icon-active.png" width="25"/>
				<!-- <svg class="svg-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z" opacity=".3"></path><path d="M0,0h24v24H0V0z" fill="none"></path><g><path d="M19.5,3.5L18,2l-1.5,1.5L15,2l-1.5,1.5L12,2l-1.5,1.5L9,2L7.5,3.5L6,2v14H3v3c0,1.66,1.34,3,3,3h12c1.66,0,3-1.34,3-3V2 L19.5,3.5z M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z"></path><rect height="2" width="6" x="9" y="7"></rect><rect height="2" width="2" x="16" y="7"></rect><rect height="2" width="6" x="9" y="10"></rect><rect height="2" width="2" x="16" y="10"></rect></g></svg>-->
				</p>
			</div>
		</div>
	</div>
</div>