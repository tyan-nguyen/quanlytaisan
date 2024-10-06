Thống kê tài sản hoạt động

<?php 
if($model){
?>
<table class="table">
<tr>
	<td>STT</td>
	<td>Ngày</td>
	<td>Nội dung</td>
</tr>
<?php 
    $stt = 0;
    foreach ($model->getLichSuHoatDong() as $ls){
        $stt++;
?>
<tr>
	<td><?= $stt ?></td>
	<td><?= $ls['ngay'] ?></td>
	<td><?= $ls['noi_dung'] ?></td>
</tr>
<?php         
    }
?>
</table>
<?php 
}
?>