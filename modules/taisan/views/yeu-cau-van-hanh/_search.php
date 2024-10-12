<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\modules\taisan\models\YeuCauVanHanh;
use kartik\date\DatePicker;
use app\modules\dungchung\models\CustomFunc;
use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\NhanVien;
use app\modules\user\models\User;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

use app\widgets\forms\SwitchWidget;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\ThietBi;
/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanh */
/* @var $form yii\widgets\ActiveForm */

$newArr = [];

if ($model->isNewRecord) {
    if ($model->id_nguoi_yeu_cau != null) {
        $nv = NhanVien::findOne($model->id_nguoi_yeu_cau);
        if ($nv != null) {
            $newArr = [$model->id_nguoi_yeu_cau => $nv->ten_nhan_vien];
        }
    }
}
$cus = new CustomFunc();

?>

<div class="ts-yeu-cau-van-hanh-search">

    <?php $form = ActiveForm::begin([
        'id' => 'myFilterForm',
        'method' => 'post',
        'options' => [
            'class' => 'myFilterForm form-horizontal'
        ],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => '<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-md-12 control-label'],
        ],
    ]); ?>

	<?=$form->field($model, 'idThietBi')->widget(Select2::classname(), [
	    'data' => ThietBi::getListWithStatus(),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn thiết bị...',
            'data-dropdown-parent' => "#offcanvasRight"
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%',
        ],
    ])->label('Thiết bị');?>

    <?= $form->field($model, 'id_bo_phan_quan_ly')->widget(Select2::classname(), [
        'data' => (new BoPhan())->getListTree(),
        'options' => [
            'id' => 'id-bo-phan-search',
            'placeholder' => 'Chọn ' . $model->getAttributeLabel('id_bo_phan_quan_ly') . '...',
            'data-dropdown-parent' => "#offcanvasRight"
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%'
        ],
    ]);
    ?>

    <?= $form->field($model, 'id_nguoi_yeu_cau')->widget(DepDrop::classname(), [
        'options' => [
            'id' => 'id-nhan-vien-search',
            'placeholder' => 'Chọn người yêu cầu ...',
            'data-dropdown-parent' => "#offcanvasRight"

        ],
        'data' => [],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => [
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ],
        'pluginOptions' => [
            'depends' => ['id-bo-phan-search'],
            'width' => '100%',
            //'initialize' => true,
            'url' => Url::to(['/kholuutru/depdrop/get-nhan-vien']),
        ],
    ]);
    ?>

    <?= $form->field($model, 'id_nguoi_nhan')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%'
        ],
    ]); ?>
    <?= $form->field($model, 'id_nguoi_lap')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%'
        ],
    ]); ?>

    <?php //$form->field($model, 'id_cong_trinh')->textInput() 
    ?>

    <?= $form->field($model, 'ngay_lap')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Chọn ngày...',
        ],
        'value' => date('d-m-Y'),
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pickerIcon' => '<i class="fas fa-calendar-alt text-infor"></i>',
        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'ngay_gui')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Chọn ngày...',
        ],
        'value' => date('d-m-Y'),
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pickerIcon' => '<i class="fas fa-calendar-alt text-infor"></i>',
        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'ngay_duyet')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Chọn ngày...',
        ],
        'value' => date('d-m-Y'),
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pickerIcon' => '<i class="fas fa-calendar-alt text-infor"></i>',
        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'ngay_xuat')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Chọn ngày...',
        ],
        'value' => date('d-m-Y'),
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pickerIcon' => '<i class="fas fa-calendar-alt text-infor"></i>',
        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'ngay_nhan')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Chọn ngày...',
        ],
        'value' => date('d-m-Y'),
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pickerIcon' => '<i class="fas fa-calendar-alt text-infor"></i>',
        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'hieu_luc')->dropDownList(YeuCauVanHanh::getDmHieuLuc(), ['prompt' => '--Chọn--']) ?>

    <?= $form->field($model, 'dia_diem')->textInput(['maxlength' => true]) ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>