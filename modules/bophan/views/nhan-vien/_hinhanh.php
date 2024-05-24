<?php 
use app\modules\dungchung\models\HinhAnh;
use app\modules\bophan\models\NhanVien;

$hinhs = HinhAnh::getHinhAnhThamChieu(NhanVien::MODEL_ID, $model->id);
?>
<div class="card custom-card">
	<div class="card-body h-100">
		<div>
			<h6 class="card-title mb-1">Hình ảnh</h6>
		</div>
		
		
		<div class="carousel-slider">
		
			<div id="carousel" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-inner">
				
					<?php foreach ($hinhs as $indexHinh=>$hinh): ?>
					
					<div class="carousel-item <?= $indexHinh==0?'active':'' ?>"><img src="<?= $hinh->hinhAnhUrl ?>" alt="img"> </div>
					
					<?php endforeach; ?>
				
					
					
				</div>
				<a class="carousel-control-prev" href="#carousel" role="button" data-bs-slide="prev">
					<i class="fa fa-angle-left fs-30" aria-hidden="true"></i>
				</a>
				<a class="carousel-control-next" href="#carousel" role="button" data-bs-slide="next">
					<i class="fa fa-angle-right fs-30" aria-hidden="true"></i>
				</a>
			</div>
			
			
			<div class="clearfix">
			
				<div id="thumbcarousel" class="carousel slide" data-bs-interval="false">
				
					<div class="carousel-inner">
						<div class="carousel-item active text-nowrap">
							<?php foreach ($hinhs as $indexHinh=>$hinh): ?>
					
					<div data-bs-target="#carousel" data-bs-slide-to="<?= $indexHinh ?>" class="thumb mt-2">
								<img src="<?= $hinh->hinhAnhUrl ?>" alt="img" class="br-3">
							</div>
					
					<?php endforeach; ?>
						
						
						</div>
					</div>
					
					<a class="carousel-control-prev" href="#thumbcarousel" role="button" data-bs-slide="prev">
						<i class="fa fa-angle-left fs-20" aria-hidden="true"></i>
					</a>
					<a class="carousel-control-next" href="#thumbcarousel" role="button" data-bs-slide="next">
						<i class="fa fa-angle-right fs-20" aria-hidden="true"></i>
					</a>
				</div>
				
				
			</div>
		</div>
		
		
	</div>
</div>