<?php
use yii\web\View;
?>

<style>
.chartjs-wrapper-demo{
    width:100%;
    height:215px !important;
}
</style>

<div class="card">
	<div class="card-header">
		<h3 class="card-title"> Thống kê</h3>
	</div>
	<div class="card-body">
		<div id="sessionsDevice" class="mb-2">
			<div class="chartjs-wrapper-demo">
				<canvas class="w-100" id="chartDonut"></canvas>
			</div>
		</div>
		
		<?php 
		  foreach ($dash->getListTaiSanPercent() as $index=>$item):
		?>
		
		<div class="d-flex mg-b-15">
			<div class="me-3">
				<span class="avatar avatar-sm tx-fixed-white rounded-circle" style="background-color:<?= $item['color'] ?>"><i class="icon-chart"></i></span>
			</div>
			<div class="flex-1">
				<div class="flex-between  d-flex justify-content-between align-items-end mb-2">
					<h6 class="mg-b-0 d-inline-flex"><span class="pe-2 border-end"><?= $item['label'] ?></span>
						<span class="ms-1"><?= $item['sum'] ?></span>
					</h6>
					<span class="badge badge-sm" style="background-color:<?= $item['color'] ?>"><?= $item['percent'] ?></span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated ht-5" style="width: <?= $item['percent'] ?>;background-color:<?= $item['color'] ?>"></div>
				</div>
			</div>
		</div>
		
		<?php endforeach; ?>
		
		
		<!-- 
		<div class="d-flex mg-b-15">
			<div class="me-3">
				<span class="avatar avatar-sm tx-fixed-white rounded-circle bg-primary"><i class="fe fe-smartphone"></i></span>
			</div>
			<div class="flex-1">
				<div class="flex-between  d-flex justify-content-between align-items-end mb-2">
					<h6 class="mg-b-0 d-inline-flex"><span class="pe-2 border-end">Mobile</span>
						<span class="ms-1">39.3%</span>
					</h6>
					<span class="badge badge-sm bg-primary">+1.6%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated ht-5 bg-primary" style="width: 39.3%"></div>
				</div>
			</div>
		</div>
		<div class="d-flex mg-b-15">
			<div class="me-3">
				<span class="avatar avatar-sm tx-fixed-white rounded-circle bg-secondary"><i class="fe fe-monitor"></i></span>
			</div>
			<div class="flex-1">
				<div class="flex-between  d-flex justify-content-between align-items-end mb-2 ">
					<h6 class="mg-b-0 d-inline-flex"><span class="pe-2 border-end">Desktop</span>
						<span class="ms-1">36.4%</span>
					</h6>
					<span class="badge badge-sm bg-secondary">-5.2%</span>

				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated ht-5 bg-secondary" style="width: 36.4%"></div>
				</div>
			</div>
		</div>
		<div class="d-flex">
			<div class="me-3">
				<span class="avatar avatar-sm tx-fixed-white rounded-circle bg-success"><i class="fe fe-tablet"></i></span>
			</div>
			<div class="flex-1">
				<div class="flex-between  d-flex justify-content-between align-items-end mb-2">
					<h6 class="mg-b-0 d-inline-flex"><span class="pe-2 border-end">Tablet</span>
						<span class="ms-1">24.3%</span>
					</h6>
					<span class="badge badge-sm bg-success">+2.7%</span>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated ht-5 bg-success" style="width: 24.3%"></div>
				</div>
			</div>
		</div>
		-->
		
	</div>
</div>


<?php 
$this->registerJsFile(Yii::getAlias('@web') . 'assets/plugins/chart.js/Chart.bundle.min.js', [
    'position' => View::POS_END,
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);
$this->registerJsFile(Yii::getAlias('@web') . 'assets/js/chart.chartjs.js',[
    'position' => View::POS_END,
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
    ]);
$this->registerJs("
    var ctx6 = document.getElementById('chartDonut');
    var myPieChart6 = new Chart(ctx6, {
        type: 'doughnut',
        data: {
            //labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            labels:['". implode("', '", array_map(function ($ar) {return $ar['label'];}, $dash->getListTaiSanPercent()) ) ."'],
            datasets: [{
                data: [". implode(',', array_map(function ($ar) {return $ar['sum'];}, $dash->getListTaiSanPercent()) ) ."],
                //backgroundColor:  ['#17b794', '#eb6f33', '#01b8ff', '#ff473d', '#03c895']
                //backgroundColor:  ['#17b794', '#eb6f33', '#01b8ff']
                backgroundColor: ['". implode("', '", array_map(function ($ar) {return $ar['color'];}, $dash->getListTaiSanPercent()) ) ."']
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
", View::POS_END);