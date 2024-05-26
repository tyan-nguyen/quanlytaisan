<?php

namespace app\modules\kholuutru\models;

use Yii;
use app\modules\user\models\User;
/**
 * This is the model class for table "ts_lich_su_vat_tu".
 *
 * @property int $id
 * @property int $id_vat_tu
 * @property int $so_luong_cu
 * @property int $so_luong_moi
 * @property int $so_luong
 * @property string|null $ghi_chu
 * @property int $nguoi_tao
 * @property string|null $ngay_tao
 *
 * @property TsDmVatTu $vatTu
 */
class LichSuVatTu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_lich_su_vat_tu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_vat_tu', 'so_luong_cu', 'so_luong_moi', 'so_luong'], 'required'],
            [['id_vat_tu', 'so_luong_cu', 'so_luong_moi', 'so_luong', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['ngay_tao'], 'safe'],
            [['id_vat_tu'], 'exist', 'skipOnError' => true, 'targetClass' => DmVatTu::class, 'targetAttribute' => ['id_vat_tu' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_vat_tu' => 'Vật tư',
            'so_luong_cu' => 'SL cũ',
            'so_luong_moi' => 'SL mới',
            'so_luong' => 'SL thay đổi',
            'ghi_chu' => 'Ghi chú',
            'nguoi_tao' => 'Người thay đổi',
            'ngay_tao' => 'Ngày thay đổi',
        ];
    }

    /**
     * Gets query for [[VatTu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVatTu()
    {
        return $this->hasOne(DmVatTu::class, ['id' => 'id_vat_tu']);
    }
    public function getNguoiTao()
    {
        return $this->hasOne(User::class, ['id' => 'nguoi_tao']);
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->ngay_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->id;
        }
        
        return parent::beforeSave($insert);
    }
}
