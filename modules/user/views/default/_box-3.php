<?php
use app\widgets\LinkToModalWidget;
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Lịch sử hoạt động</h3>
	</div>
	<div class="card-body" style="height:400px;position: relative;overflow: scroll;">

		<div class="table-responsive border-top-0">
			<table class="table  text-nowrap border-0 border-top-0 mb-0 ">

				<tbody>
					<?php 
					   foreach ($dash->getLichSuHoatDong() as $index=>$item):
            		?>
            		<tr>
						<td>
							<svg xmlns="http://www.w3.org/2000/svg" class="rounded-circle ms-2" width="25" height="25" viewBox="0 0 25 25">
								<rect fill="#ddd" width="25" height="25"></rect>
							</svg>
						</td>
						<td><?= $item->nguoiTao ?></td>
						<td><?= $item->noi_dung ?></td>
						<td>
							<?= $item->id_tham_chieu != NULL ? LinkToModalWidget::widget([
							    'label'=>$item->showName,
							    'link'=>$item->showLink
                            ]) : '' ?>
						</td>
					</tr>
            		<?php endforeach; ?>
				
				</tbody>
			</table>
		</div>

	</div>
</div>