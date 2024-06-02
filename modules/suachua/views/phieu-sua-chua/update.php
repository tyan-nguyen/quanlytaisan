<?php

use yii\bootstrap5\Html;
use app\widgets\forms\DocumentWidget;
use app\widgets\views\DocumentListWidget;
use app\widgets\views\ImageGridWidget;
use app\widgets\forms\ImageWidget;
use app\modules\suachua\models\PhieuSuaChua;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChua */
?>
<div class="phieu-sua-chua-update">
<div class="row">
<div class="col-10">
            <fieldset class="border p-2" style="margin:3px;"><!--Thông tin chung -->
            <legend class="legend"><p>Thông tin chung</p></legend>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </fieldset>

    </div>
    <div class="col-2">
            <fieldset class="border p-2" style="margin:3px"><!--Tai lieu -->
                <div class="row">
                    <div class="row-10">
                    	<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Tài liệu</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		<?= $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải tài liệu lên':'Chọn file tài liệu.' ?>
                        	</p>
                        <?php // '<label class="form-label" style="font-weight:bold">Tài liệu</label>';?>
                        <?php if(!$model->isNewRecord): ?>
                            <?= DocumentWidget::widget([
                                'loai' => PhieuSuaChua::MODEL_ID,
                                'id_tham_chieu' => $model->id
                            ]) ?>
                            <?php endif; ?>
                         </div><!-- card-body -->
                    </div>
                </div>
            </fieldset>   
            <fieldset class="border p-2" style="margin:3px"><!--Hinh anh -->
                <div class="row">
                    <div class="row-10">
                    <div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Hình ảnh</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		<?= $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải ảnh lên':'Chọn file hình ảnh.' ?>
                        	</p>
                        <?php // '<label class="form-label" style="font-weight:bold">Hình ảnh</label>';?>
                        <?php if(!$model->isNewRecord): ?>
                                <?= ImageWidget::widget([
                                    'loai' => PhieuSuaChua::MODEL_ID,
                                    'id_tham_chieu' => $model->id
                                ]) ?>
                        <?php endif; ?>
                        </div><!-- card-body -->
                    </div>
                </div>
            </fieldset>              
        </div>
</div>
</div>
