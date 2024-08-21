<?php 
use app\modules\dungchung\models\CustomFunc;

$custom = new CustomFunc();
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Danh sách đến hạn bảo trì</h3>
	</div>
	
		
			<ul class="list-group">
				<?php foreach ($dash->getPhieuDenHanBaoTri() as $phieu){?>
				<li class="list-group-item products d-flex">
					<div class="media">
						<div class="d-flex ms-1">
							<span class="main-img-user"><i class="fe fe-file  bg-secondary tx-fixed-white rounded-circle secondary-dropshadow product-icon avatar"></i></span>
							<div class="ms-3">
								<h6 class="mg-b-0"><?= ($phieu->keHoach!=null && $phieu->keHoach->thietBi!=null) ? $phieu->keHoach->thietBi->ten_thiet_bi : '' ?></h6><span class="tx-13 tx-gray-500"><?= $phieu->keHoach!=null ? $phieu->keHoach->ten_cong_viec : '' ?></span>
							</div>
						</div>
					</div>
					<div class="price ms-auto my-auto">
						<p class="m-0"><?= $custom->convertYMDHISToDMY($phieu->thoi_gian_bat_dau) ?></p>
					</div>
				</li>
				<?php }?>
				
				<li class="list-group-item products d-flex border-bottom-0">
					<a href="/baotri/lich-bao-tri/baotri?menu=btbd0" class="btn btn-block btn-primary mt-1">Xem tất cả</a>
				</li>
				
				
			</ul>
			
			
		
	


</div>