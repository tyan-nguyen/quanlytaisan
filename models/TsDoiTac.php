<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ts_doi_tac".
 *
 * @property int $id
 * @property string $ma_doi_tac
 * @property string $ten_doi_tac
 * @property int $id_nhom_doi_tac
 * @property string|null $dia_chi
 * @property string|null $dien_thoai
 * @property string|null $email
 * @property string|null $tai_khoan_ngan_hang
 * @property string|null $ma_so_thue
 * @property int|null $la_nha_cung_cap
 * @property int|null $la_khach_hang
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsNhomDoiTac $nhomDoiTac
 */
class TsDoiTac extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ts_doi_tac';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_doi_tac', 'ten_doi_tac', 'id_nhom_doi_tac'], 'required'],
            [['id_nhom_doi_tac', 'la_nha_cung_cap', 'la_khach_hang', 'nguoi_tao'], 'integer'],
            [['dia_chi'], 'string'],
            [['thoi_gian_tao'], 'safe'],
            [['ma_doi_tac', 'dien_thoai'], 'string', 'max' => 20],
            [['ten_doi_tac', 'email', 'ma_so_thue'], 'string', 'max' => 255],
            [['tai_khoan_ngan_hang'], 'string', 'max' => 100],
            [['id_nhom_doi_tac'], 'exist', 'skipOnError' => true, 'targetClass' => TsNhomDoiTac::class, 'targetAttribute' => ['id_nhom_doi_tac' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_doi_tac' => 'Ma Doi Tac',
            'ten_doi_tac' => 'Ten Doi Tac',
            'id_nhom_doi_tac' => 'Id Nhom Doi Tac',
            'dia_chi' => 'Dia Chi',
            'dien_thoai' => 'Dien Thoai',
            'email' => 'Email',
            'tai_khoan_ngan_hang' => 'Tai Khoan Ngan Hang',
            'ma_so_thue' => 'Ma So Thue',
            'la_nha_cung_cap' => 'La Nha Cung Cap',
            'la_khach_hang' => 'La Khach Hang',
            'thoi_gian_tao' => 'Thoi Gian Tao',
            'nguoi_tao' => 'Nguoi Tao',
        ];
    }

    /**
     * Gets query for [[NhomDoiTac]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhomDoiTac()
    {
        return $this->hasOne(TsNhomDoiTac::class, ['id' => 'id_nhom_doi_tac']);
    }
}
