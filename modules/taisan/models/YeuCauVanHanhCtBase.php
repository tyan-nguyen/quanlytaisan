<?php

namespace app\modules\taisan\models;


use Yii;
use app\modules\dungchung\models\CustomFunc;
use app\modules\taisan\models\ThietBi;


/**
 * This is the model class for table "ts_yeu_cau_van_hanh_ct".
 *
 * @property int $id
 * @property int $id_thiet_bi
 * @property int $id_yeu_cau_van_hanh
 * @property string|null $ngay_bat_dau
 * @property string|null $ngay_ket_thuc
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class YeuCauVanHanhCtBase extends \app\models\TsYeuCauVanHanhCt
{
    const MODEL_ID = 'yeu-cau-van-hanh-ct';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['id_thiet_bi'],
                'required'
            ],
            [
                ['id_thiet_bi', 'id_yeu_cau_van_hanh'],
                'integer'
            ],
            [
                ['ngay_bat_dau', 'ngay_ket_thuc', 'created_at', 'updated_at', 'deleted_at'],
                'safe'
            ],

            [['id_yeu_cau_van_hanh'], 'exist', 'skipOnError' => true, 'targetClass' => YeuCauVanHanh::class, 'targetAttribute' => ['id_yeu_cau_van_hanh' => 'id']],
            [['id_thiet_bi'], 'exist', 'skipOnError' => true, 'targetClass' => ThietBi::class, 'targetAttribute' => ['id_thiet_bi' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_thiet_bi' => 'Thiết bị',
            'id_yeu_cau_van_hanh' => 'Yêu cầu vận hành',
            'ngay_bat_dau' => 'Ngày bắt đầu',
            'ngay_ket_thuc' => 'Ngày kết thúc',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function getThietBi()
    {
        return $this->hasOne(ThietBi::class, ['id' => 'id_thiet_bi']);
    }

    public function getNgayBatDau(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_bat_dau);
    }
    public function getNgayKetThuc(){
        $cus = new CustomFunc();
        return $cus->convertYMDToDMY($this->ngay_ket_thuc);
    }

    public function getYeuCauVanHanh()
    {
        return $this->hasOne(YeuCauVanHanh::class, ['id' => 'id_yeu_cau_van_hanh']);
    }
}
