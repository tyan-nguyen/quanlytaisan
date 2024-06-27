<?php

namespace app\modules\baotri\models\base;

use app\widgets\views\StatusWithIconWidget;
use Yii;
use app\models\TsPhieuBaoTri;
use app\modules\baotri\models\KeHoachBaoTri;
use app\modules\dungchung\models\CustomFunc;
use app\modules\dungchung\models\History;

/**
 * This is the model class for table "ts_phieu_bao_tri".
 *
 * @property int $id
 * @property int|null $id_ke_hoach
 * @property int|null $ky_thu
 * @property int|null $id_don_vi_bao_tri
 * @property int|null $id_nguoi_chiu_trach_nhiem
 * @property string|null $thoi_gian_bat_dau
 * @property string|null $thoi_gian_ket_thuc
 * @property string|null $noi_dung_thuc_hien
 * @property int|null $da_hoan_thanh
 * @property string|null $thoi_gian_tao
 * @property int|null $nguoi_tao
 *
 * @property TsKeHoachBaoTri $keHoach
 */

class PhieuBaoTriBase extends TsPhieuBaoTri
{
    const MODEL_ID = "phieubaotri";
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ke_hoach', 'ky_thu', 'id_don_vi_bao_tri', 'id_nguoi_chiu_trach_nhiem', 'nguoi_tao', 'da_hoan_thanh'], 'integer'],
            [['thoi_gian_bat_dau', 'thoi_gian_ket_thuc', 'thoi_gian_tao'], 'safe'],
            [['noi_dung_thuc_hien'], 'string'],
            [['id_ke_hoach'], 'exist', 'skipOnError' => true, 'targetClass' => KeHoachBaoTri::class, 'targetAttribute' => ['id_ke_hoach' => 'id']],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ke_hoach' => 'Kế hoạch bảo trì',
            'ky_thu' => 'Kỳ thứ',
            'id_don_vi_bao_tri' => 'Đơn vị bảo trì',
            'id_nguoi_chiu_trach_nhiem' => 'Người chịu trách nhiệm',
            'thoi_gian_bat_dau' => 'Thời gian bắt đầu',
            'thoi_gian_ket_thuc' => 'Thời gian kết thúc',
            'noi_dung_thuc_hien' => 'Nội dung thực hiện',
            'da_hoan_thanh' => 'Đã hoàn thành',
            'thoi_gian_tao' => 'Thời gian tạo',
            'nguoi_tao' => 'Người tạo',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->thoi_gian_tao = date('Y-m-d H:i:s');
            $this->nguoi_tao = Yii::$app->user->isGuest ? '' : Yii::$app->user->id;
            if($this->da_hoan_thanh == null){
                $this->da_hoan_thanh = 0;
            }
        }
        $cus = new CustomFunc();
        if($this->thoi_gian_bat_dau != null)
            $this->thoi_gian_bat_dau = $cus->convertDMYToYMDHIS($this->thoi_gian_bat_dau);
        if($this->thoi_gian_ket_thuc != null)
            $this->thoi_gian_ket_thuc = $cus->convertDMYToYMDHIS($this->thoi_gian_ket_thuc);
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