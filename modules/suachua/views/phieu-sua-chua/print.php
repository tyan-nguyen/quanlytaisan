<?php
use app\modules\dungchung\models\CustomFunc;


$js = <<< 'SCRIPT'
$(document).ready(function() {
    $("#print").click(function(){
        $('.print-phieu-sua-chua').printThis();
    });
    $('#print-button').on('click', function() {
        $.ajax({
            url: 'index.php?r=example/print-view',
            type: 'GET',
            success: function(data) {
                $('#print-phieu-sua-chua').html(data);
                $('.print-phieu-sua-chua').printThis();
            },
            error: function() {
                alert('Đã xảy ra lỗi trong khi tải nội dung.');
            }
        });
    });
});
SCRIPT;
    $this->registerJs($js, \yii\web\View::POS_READY);
$baoGia=$model->baoGiaSuaChua;
$thietBi=$model->thietBi;
$ngaySuaChua="";
$cus = new CustomFunc();
if ($model->ngay_sua_chua != null) {
    $ngaySuaChua = $cus->convertYMDToDMY($model->ngay_sua_chua);
}
?>
<style>
.print-phieu-sua-chua {
    display: none;
}
</style>

<div class="print-phieu-sua-chua">
<table style="width:100%;border-collapse:collapse;border:none;">
    <tbody>
        <tr>
            <td style="width: 84.3pt;padding: 0cm 5.4pt;height: 77.5pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><img src="data:image/png;base64,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" style="width: 73.5pt; height: 73.5pt;" alt="image"></p>
            </td>
            <td style="width: 291.35pt;padding: 0cm 5.4pt;height: 77.5pt;vertical-align: top;">
                <p style='margin-top:6.0pt;margin-right:0cm;margin-bottom:  0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:17px;font-family:"Times New Roman",serif;'>DNTN SX-TM Nguyễn Trình</span></strong></p>
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><span style='font-size:17px;font-family:"Times New Roman",serif;'>ĐC: Nguyễn Đáng, Khóm 10, P.9, TP.TV</span></p>
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><span style='font-size:17px;font-family:"Times New Roman",serif;'>Hotline: 090.333.6470</span></p>
            </td>
            <td style="width: 127.35pt;padding: 0cm 5.4pt;height: 77.5pt;vertical-align: top;">
                <p style='margin-top:6.0pt;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;text-align:center;line-height:normal;'><span style='font-size:17px;font-family:"Times New Roman",serif;'>Số phiếu: P-<?= substr("0000000{$model->id}", -6) ?></span></p>
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;text-align:center;line-height:normal;'><span style='font-size:17px;font-family:"Times New Roman",serif;'><?= $baoGia->getDmTrangThai()[$baoGia->trang_thai]  ?></span></p>
            </td>
        </tr>
    </tbody>
</table>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;text-align:center;'><strong><span style='font-size:20px;line-height:107%;font-family:"Times New Roman",serif;'>PHIẾU YÊU CẦU SỬA CHỮA</span></strong></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>Tên hệ thống, thiết bị: <?= $thietBi->ten_thiet_bi ?></span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>Địa điểm:<?= $model->dia_chi ?></span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>Bộ phận yêu cầu: <?= $thietBi->boPhanQuanLy ? $thietBi->boPhanQuanLy->ten_bo_phan : "" ?></span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>Người chịu trách nhiệm:<?= $thietBi->nguoiQuanLy ? $thietBi->nguoiQuanLy->ten_nhan_vien : "" ?>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Ngày yêu cầu: <?= $ngaySuaChua ?></span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>Lý do: <?= $model->ghi_chu1 ?></span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>Nội dung sửa chữa:</span></p>
<table style="width:100%;border-collapse:collapse;border:none;">
    <tbody>
        <tr>
            <td style="width: 35.2pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>STT</span></strong></p>
            </td>
            <td style="width: 4cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Tên danh mục</span></strong></p>
            </td>
            <td style="width: 106.3pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Đơn vị tính</span></strong></p>
            </td>
            <td style="width: 63.8pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Số lượng</span></strong></p>
            </td>
            <td style="width: 3cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Đơn giá</span></strong></p>
            </td>
            <td style="width: 3cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Thành tiền</span></strong></p>
            </td>
        </tr>
        
        <?php foreach ($baoGia->ctBaoGiaSuaChuas as $stt => $item): ?>
            <tr>
                <td style="width: 35.2pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;"><?= $stt+1 ?></td>
                <td style="width: 4cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= $item->ten_danh_muc ?></td>
                <td style="width: 106.3pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= $item->so_luong ?></td>
                <td style="width: 63.8pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= $item->don_vi_tinh ?></td>
                <td style="width: 3cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= number_format($item->don_gia) ?></td>
                <td style="width: 3cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= number_format($item->thanh_tien) ?></td>
            </tr>
        <?php endforeach; ?>
        
        
    </tbody>
</table>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>Vật tư đề nghị (nếu có):</span></p>
<table style="width:100%;border-collapse:collapse;border:none;">
    <tbody>
        <tr>
            <td style="width: 35.2pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>STT</span></strong></p>
            </td>
            <td style="width: 4cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Tên vật tư</span></strong></p>
            </td>
            <td style="width: 106.3pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Hãng sản xuất</span></strong></p>
            </td>
            <td style="width: 63.8pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Đơn vị tính</span></strong></p>
            </td>
            <td style="width: 3cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Số lượng</span></strong></p>
            </td>
            <td style="width: 3cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;line-height:normal;'><strong><span style='font-size:16px;font-family:"Times New Roman",serif;'>Ghi chú</span></strong></p>
            </td>
        </tr>
        <?php foreach ($model->vatTus as $stt => $item): ?>
            <tr>
                <td style="width: 35.2pt;border: 1pt solid windowtext;padding: 0cm 5.4pt;vertical-align: top;"><?= $stt+1 ?></td>
                <td style="width: 4cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= $item->vatTu->ten_vat_tu ?></td>
                <td style="width: 106.3pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= $item->vatTu->hang_san_xuat ?></td>
                <td style="width: 63.8pt;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= $item->don_vi_tinh ?></td>
                <td style="width: 3cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= $item->so_luong ?></td>
                <td style="width: 3cm;border-top: 1pt solid windowtext;border-right: 1pt solid windowtext;border-bottom: 1pt solid windowtext;border-image: initial;border-left: none;padding: 0cm 5.4pt;vertical-align: top;"><?= $item->ghi_chu ?></td>
            </tr>
        <?php endforeach; ?>
        
    </tbody>
</table>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Ngày … tháng …. Năm</span></p>
<table style="width:100%;border-collapse:collapse;border:none;">
    <tbody>
        <tr>
            <td style="width: 155.8pt;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;text-align:center;line-height:normal;'><strong><span style='font-size:17px;font-family:"Times New Roman",serif;'>NGƯỜI YÊU CẦU</span></strong></p>
            </td>
            <td style="width: 155.85pt;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;text-align:center;line-height:normal;'><strong><span style='font-size:17px;font-family:"Times New Roman",serif;'>BỘ PHẬN YÊU CẦU</span></strong></p>
            </td>
            <td style="width: 177.15pt;padding: 0cm 5.4pt;vertical-align: top;">
                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;text-align:center;line-height:normal;'><strong><span style='font-size:17px;font-family:"Times New Roman",serif;'>DUYỆT PHIẾU</span></strong></p>
            </td>
        </tr>
    </tbody>
</table>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Aptos",sans-serif;'><span style='font-size:17px;line-height:107%;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
</div>