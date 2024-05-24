<?php 
use app\modules\user\models\Dashboard;

Yii::$app->params['showTopSearch'] = false;
Yii::$app->params['moduleID'] = 'Home';
Yii::$app->params['modelID'] = 'Dashboard';

$dash = new Dashboard();
?>

<div class="row row-cards">
	<div class="col-sm-12 col-lg-3">
		<?= $this->render('_sumTaiSanDangHoatDong', compact('dash')) ?>
	</div>
	<div class="col-sm-12 col-lg-3">
		<?= $this->render('_sumLoaiCoGioi', compact('dash')) ?>
	</div>
	<div class="col-sm-12 col-lg-3">
		<?= $this->render('_sumVanChuyen', compact('dash')) ?>
	</div>
	<div class="col-sm-12 col-lg-3">
		<?= $this->render('_sumThietBi', compact('dash')) ?>
	</div>
</div>

<div class="row">
	<div class="col-xl-4 col-lg-12 col-md-12">
		<?= $this->render('_box-1') ?>
	</div>
	<div class="col-xl-4 col-lg-12 col-md-12">
		<?= $this->render('_box-2', compact('dash')) ?>
	</div>
	<div class="col-xl-4 col-lg-12 col-md-12">
		<?= $this->render('_box-3') ?>
	</div>
</div>