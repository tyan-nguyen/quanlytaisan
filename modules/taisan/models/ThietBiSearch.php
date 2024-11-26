<?php

namespace app\modules\taisan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\taisan\models\ThietBi;
use app\modules\dungchung\models\CustomFunc;
use app\modules\baotri\models\PhieuBaoTri;
use app\modules\baotri\models\KeHoachBaoTri;
use app\modules\suachua\models\PhieuSuaChua;

/**
 * ThietBiSearch represents the model behind the search form about `app\modules\taisan\models\ThietBi`.
 */
class ThietBiSearch extends ThietBi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_vi_tri', 'id_he_thong', 'id_loai_thiet_bi', 'id_bo_phan_quan_ly', 'id_thiet_bi_cha', 'id_layout', 'id_hang_bao_hanh', 'id_nhien_lieu', 'id_lop_hu_hong', 'id_trung_tam_chi_phi', 'id_don_vi_bao_tri', 'id_nguoi_quan_ly', 'nguoi_tao', 'id_kho'], 'integer'],
            [['ma_thiet_bi', 'ten_thiet_bi', 'nam_san_xuat', 'serial', 'model', 'xuat_xu', 'dac_tinh_ky_thuat', 'ngay_mua', 'han_bao_hanh', 'ngay_dua_vao_su_dung', 'trang_thai', 'ngay_ngung_hoat_dong', 'ghi_chu', 'thoi_gian_tao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $cusomSearch=NULL, $forUser=NULL, $forBoPhan=NULL)
    {
        $query = ThietBi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if($cusomSearch != NULL){
            $query->andFilterWhere ( [ 'OR' ,['like', 'ma_thiet_bi', $cusomSearch],
                ['like', 'ten_thiet_bi', $cusomSearch],
                ['like', 'nam_san_xuat', $cusomSearch],
                ['like', 'serial', $cusomSearch],
                ['like', 'model', $cusomSearch],
                ['like', 'xuat_xu', $cusomSearch],
                ['like', 'dac_tinh_ky_thuat', $cusomSearch],
                ['like', 'trang_thai', $cusomSearch],
                ['like', 'ghi_chu', $cusomSearch] ]);
        } else {
            $query->andFilterWhere([
                'id' => $this->id,
                'id_vi_tri' => $this->id_vi_tri,
                'id_he_thong' => $this->id_he_thong,
                'id_loai_thiet_bi' => $this->id_loai_thiet_bi,
                //'id_bo_phan_quan_ly' => $this->id_bo_phan_quan_ly,
                'id_thiet_bi_cha' => $this->id_thiet_bi_cha,
                'id_layout' => $this->id_layout,
                'id_hang_bao_hanh' => $this->id_hang_bao_hanh,
                'id_nhien_lieu' => $this->id_nhien_lieu,
                'id_lop_hu_hong' => $this->id_lop_hu_hong,
                'id_trung_tam_chi_phi' => $this->id_trung_tam_chi_phi,
                'id_don_vi_bao_tri' => $this->id_don_vi_bao_tri,
                //'id_nguoi_quan_ly' => $this->id_nguoi_quan_ly,
                'ngay_mua' => $this->ngay_mua,
                'han_bao_hanh' => $this->han_bao_hanh,
                'ngay_dua_vao_su_dung' => $this->ngay_dua_vao_su_dung,
                'ngay_ngung_hoat_dong' => $this->ngay_ngung_hoat_dong,
                'thoi_gian_tao' => $this->thoi_gian_tao,
                'nguoi_tao' => $this->nguoi_tao,
                'id_kho' => $this->id_kho
            ]);
            
            //search người quản lý thì ko search bo phan
            if($this->id_nguoi_quan_ly == null){
                $query->andFilterWhere([
                    'id_bo_phan_quan_ly' => $this->id_bo_phan_quan_ly,
                ]);
            } else {
                $query->andFilterWhere([
                    'id_nguoi_quan_ly' => $this->id_nguoi_quan_ly,
                ]);
            }
    
            $query->andFilterWhere(['like', 'ma_thiet_bi', $this->ma_thiet_bi])
                ->andFilterWhere(['like', 'ten_thiet_bi', $this->ten_thiet_bi])
                ->andFilterWhere(['like', 'nam_san_xuat', $this->nam_san_xuat])
                ->andFilterWhere(['like', 'serial', $this->serial])
                ->andFilterWhere(['like', 'model', $this->model])
                ->andFilterWhere(['like', 'xuat_xu', $this->xuat_xu])
                ->andFilterWhere(['like', 'dac_tinh_ky_thuat', $this->dac_tinh_ky_thuat])
                ->andFilterWhere(['like', 'trang_thai', $this->trang_thai])
                ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);
        }
        
        //for user
        if($forUser != NULL){
            $query->andFilterWhere([
                'id_nguoi_quan_ly' => $forUser,
            ]);
        }
        
        //for bo phan quan ly
        if($forBoPhan != NULL){
            $query->andFilterWhere([
                'id_bo_phan_quan_ly' => $forBoPhan,
            ]);
        }

        return $dataProvider;
    }
    /**
     * get lich su bao tri tat ca thiet bi tu ngay-den ngay
     * {@inheritDoc}
     * @see \app\modules\taisan\models\ThietBi::getLichSuBaoTri()
     */
    public function getLichSuBaoTri($tuNgay, $denNgay){
        $custom = new CustomFunc();
        $result = array();
        $query = PhieuBaoTri::find()->alias('t')
        ->joinWith(['keHoach as kh'])
        ->where([
            't.da_hoan_thanh' => 1
        ]);
        if($tuNgay && $denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['>=','thoi_gian_bat_dau', $tuNgay]);
            $query->andWhere(['<=','thoi_gian_bat_dau', $denNgay]);
        } else if($tuNgay && !$denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $query->andWhere(['>=','thoi_gian_bat_dau', $tuNgay]);
        } else if(!$tuNgay && $denNgay){
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['<=','thoi_gian_bat_dau', $denNgay]);
        }
        $phieuBaoTris = $query->all();
        foreach ($phieuBaoTris as $phieuBaoTri){
            $result[] = [
                'ngay' => $custom->convertYMDHISToDMY($phieuBaoTri->thoi_gian_bat_dau),
                'ngay_ht' => $custom->convertYMDHISToDMY($phieuBaoTri->thoi_gian_ket_thuc),
                'ngay_hd' => CustomFunc::calculateDayActivity($phieuBaoTri->thoi_gian_bat_dau, $phieuBaoTri->thoi_gian_ket_thuc),
                'ngay_sort' => str_replace('-', '', $custom->convertYMDHISToYMD($phieuBaoTri->thoi_gian_bat_dau)),
                'noi_dung' => $phieuBaoTri->keHoach->ten_cong_viec,
                'loai'=>KeHoachBaoTri::MODEL_ID,
                'tham_chieu'=>$phieuBaoTri->id,
                'id_thiet_bi'=>$phieuBaoTri->keHoach?$phieuBaoTri->keHoach->id_thiet_bi:'',
                'ten_thiet_bi'=>$phieuBaoTri->keHoach->thietBi?$phieuBaoTri->keHoach->thietBi->ten_thiet_bi:'',
                'status'=>'Đã thực hiện',
            ];
        }
        return $result;
    }
    /**
     * get lich su sua chua tat ca thiet bi tu ngay-den ngay
     */
    public function getLichSuSuaChua($tuNgay, $denNgay){
        $custom = new CustomFunc();
        $result = array();
        $query = PhieuSuaChua::find()->where(['=','trang_thai','completed'])->orWhere(['=','trang_thai','processing']);
        if($tuNgay && $denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['>=','ngay_sua_chua', $tuNgay]);
            $query->andWhere(['<=','ngay_sua_chua', $denNgay]);
        } else if($tuNgay && !$denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $query->andWhere(['>=','ngay_sua_chua', $tuNgay]);
        } else if(!$tuNgay && $denNgay){
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['<=','ngay_sua_chua', $denNgay]);
        }
        $phieuSuaChuas = $query->all();
        foreach ($phieuSuaChuas as $phieuSuaChua){
            $status = '';
            if($phieuSuaChua->trang_thai == 'completed'){
                $status = 'Đã hoàn thành';
            } else if($phieuSuaChua->trang_thai == 'processing'){
                $status = 'Đang sửa chữa';
            }
            $result[] = [
                'ngay' => $custom->convertYMDHISToDMY($phieuSuaChua->ngay_sua_chua),
                'ngay_ht' => $custom->convertYMDHISToDMY($phieuSuaChua->ngay_hoan_thanh),
                'ngay_hd' => CustomFunc::calculateDayActivity($phieuSuaChua->ngay_sua_chua, $phieuSuaChua->ngay_hoan_thanh),
                'ngay_sort' => str_replace('-', '', $custom->convertYMDHISToYMD($phieuSuaChua->ngay_sua_chua)),
                'noi_dung' => 'Địa điểm: ' . $phieuSuaChua->dia_chi . '. Tình trạng: ' . $phieuSuaChua->ghi_chu1,
                'loai'=>PhieuSuaChua::MODEL_ID,
                'tham_chieu'=>$phieuSuaChua->id,
                'id_thiet_bi'=>$phieuSuaChua->id_thiet_bi,
                'ten_thiet_bi'=>$phieuSuaChua->thietBi?$phieuSuaChua->thietBi->ten_thiet_bi:'',
                'status'=>$status
            ];
        }
        return $result;
    }
    /**
     * get lich su van hanh tat ca thiet bi tu ngay-den ngay
     */
    public function getLichSuVanHanh($tuNgay, $denNgay){
        $custom = new CustomFunc();
        $result = array();
        $query = YeuCauVanHanhCt::find()->joinWith(['yeuCauVanHanh as ycvh'])->where(['=','ycvh.hieu_luc','VANHANH'])->orWhere(['=','ycvh.hieu_luc','DATRA'])->orWhere(['=','ycvh.hieu_luc','DADUYET']);
        if($tuNgay && $denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['>=','DATE(ngay_bat_dau)', $tuNgay]);
            $query->andWhere(['<=','DATE(ngay_bat_dau)', $denNgay]);
        } else if($tuNgay && !$denNgay){
            $tuNgay = $custom->convertDMYToYMD($tuNgay);
            $query->andWhere(['>=','DATE(ngay_bat_dau)', $tuNgay]);
        } else if(!$tuNgay && $denNgay){
            $denNgay = $custom->convertDMYToYMD($denNgay);
            $query->andWhere(['<=','DATE(ngay_bat_dau)', $denNgay]);
        }
        $yeuCauVanHanhCts = $query->all();
        foreach ($yeuCauVanHanhCts as $phieuVanHanh){
            $status = '';
            if($phieuVanHanh->ngay_tra_thuc_te !=null){
                if($phieuVanHanh->phieuTraThietBiChiTiet && !$phieuVanHanh->phieuTraThietBiChiTiet->tra_khong_ve_kho ){
                    $status = 'Đã trả và chuyển về kho';
                } else if($phieuVanHanh->phieuTraThietBiChiTiet && !$phieuVanHanh->phieuTraThietBiChiTiet->tra_khong_ve_kho ){
                    $status = 'Đã trả và còn tại công trình';
                } else if($phieuVanHanh->id_ycvhct_chuyen){//không có phiếu trả
                    $status = 'Chuyển tiếp đi công trình khác';
                } else {
                    $status = 'Khác';
                }
                //$status = 'Đã trả';
            } else {
                if($phieuVanHanh->yeuCauVanHanh->hieu_luc == "VANHANH"){
                    $status = 'Đang vận hành';
                } else if($phieuVanHanh->yeuCauVanHanh->hieu_luc == "DADUYET"){
                    $status = 'Đã duyệt';
                }
            }
            
            $result[] = [
                'ngay' => $custom->convertYMDHISToDMY($phieuVanHanh->ngay_bat_dau),
                'ngay_ht' => $custom->convertYMDHISToDMY($phieuVanHanh->ngay_tra_thuc_te),
                'ngay_hd' => CustomFunc::calculateDayActivity($phieuVanHanh->ngay_bat_dau, $phieuVanHanh->ngay_tra_thuc_te),
                'ngay_sort' => str_replace('-', '', $custom->convertYMDHISToYMD($phieuVanHanh->ngay_bat_dau)),
                'noi_dung' => 'Thời gian: '.$custom->convertYMDHISToDMY($phieuVanHanh->ngay_bat_dau)
                . ' - '
                .$custom->convertYMDHISToDMY($phieuVanHanh->ngay_ket_thuc)
                .'. Địa điểm: ' . $phieuVanHanh->yeuCauVanHanh->cong_trinh .
                '. Nội dung: ' . $phieuVanHanh->yeuCauVanHanh->ly_do,
                'loai'=>YeuCauVanHanh::MODEL_ID,
                'tham_chieu'=>$phieuVanHanh->id_yeu_cau_van_hanh,
                'id_thiet_bi'=>$phieuVanHanh->id_thiet_bi,
                'ten_thiet_bi'=>$phieuVanHanh->thietBi?$phieuVanHanh->thietBi->ten_thiet_bi:'',
                'status'=>$status
            ];
        }
        return $result;
    }
}
