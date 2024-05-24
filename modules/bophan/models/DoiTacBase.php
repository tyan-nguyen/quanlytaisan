<?php

namespace app\modules\bophan\models;

use Yii;
use app\modules\dungchung\models\History;

class DoiTacBase extends \app\models\TsDoiTac
{
    //set id cho model (dung de luu dung chung)
    const MODEL_ID = 'doitac';
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
            [['id_nhom_doi_tac'], 'exist', 'skipOnError' => true, 'targetClass' => NhomDoiTac::class, 'targetAttribute' => ['id_nhom_doi_tac' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma_doi_tac' => 'Mã đối tác',
            'ten_doi_tac' => 'Tên đối tác',
            'id_nhom_doi_tac' => 'Nhóm đối tác',
            'dia_chi' => 'Địa chỉ',
            'dien_thoai' => 'Điện thoại',
            'email' => 'Email',
            'tai_khoan_ngan_hang' => 'Tài khoản ngân hàng',
            'ma_so_thue' => 'Mã số thuế',
            'la_nha_cung_cap' => 'Là nhà cung cấp',
            'la_khach_hang' => 'Là khách hàng',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }

    /**
     * Gets query for [[NhomDoiTac]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhomDoiTac()
    {
        return $this->hasOne(NhomDoiTac::class, ['id' => 'id_nhom_doi_tac']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }
    
    /**
     * {@inheritdoc}
     */
    public function afterSave( $insert, $changedAttributes ){
        parent::afterSave($insert, $changedAttributes);
        History::addHistory($this::MODEL_ID, $changedAttributes, $this, $insert);
    }
}
