<?php

namespace app\modules\bophan\models;
use Yii;

class BoPhan extends BoPhanBase
{
    public $arr;//use in getListTree
    public $parr;//use in getListTree
    
    /**
     * lay danh sach tat ca bo phan (khong phan nhanh)
     * @return array|unknown[]|mixed|unknown
     */
    /* public static function getList(){
        $list = BoPhan::find()->all();
        return ArrayHelper::map($list, 'id', 'ten_bo_phan');
    } */
    
    /**
     * lay thong tin ten don vi truc thuoc
     * @return string
     */
    public function getTrucThuoc(){
        return $this->donViTrucThuoc!=null?$this->donViTrucThuoc->ten_bo_phan:'';
    }    
       
    /**
     * lay thong tin ten kho vat tu
     * @return string
     */
    public function getKhoVatTu(){
        return $this->idKhoVatTu!=NULL?$this->idKhoVatTu->ten_kho:'';
    }    
    
    /**
     * lay thong tin ten kho phe lieu
     * @return string
     */
    public function getKhoPheLieu(){
        return $this->idKhoPheLieu!=null?$this->idKhoPheLieu->ten_kho:'';
    }
    
    /**
     * lay thong tin ten kho thanh pham
     * @return string
     */
    public function getKhoThanhPham(){
        return $this->idKhoThanhPham!=null?$this->idKhoThanhPham->ten_kho:'';
    }
    
    /**
     * ham de quy lay danh sach bo phan con truc thuoc (xu ly cho getListTree)
     * @param array $arr
     * @param int $pid
     * @param int $level
     */
    private function getChild($arr, $pid, $level){
        $left = $level . '---';
        $listChildCatalogs = $this::find()->where(['truc_thuoc'=>$pid])->all();
        if($listChildCatalogs != null){
            foreach ($listChildCatalogs as $j=>$catalog1){
                $this->arr[$catalog1->id] = $left . ' ' .$catalog1->ten_bo_phan;
                $this->getChild($this->arr, $catalog1->id, $left);
            }
        }
    }
    
    /**
     * hien thi danh sach bo phan theo phan cap cha-con
     * @param boolean $withGroup
     * @return array
     */
    public function getListTree($withGroup=true)
    {
        if($withGroup==true)
            $this->parr = array();
        $this->arr = array();
        //lay ds catalog parent
        $parentCatalogs = $this::find()->where('truc_thuoc IS NULL OR truc_thuoc = 0')->all();
        foreach ($parentCatalogs as $indexCatalog=>$catalog){
            if($withGroup==true)
                $this->arr = array();
            $this->arr[$catalog->id] = $catalog->ten_bo_phan;
            $this->getChild($this->arr, $catalog->id, '');
            if($withGroup==true)
                $this->parr[$catalog->ten_bo_phan] = $this->arr;
        }
        if($withGroup==true)
            return $this->parr;
        else 
            return $this->arr;
    }
    
    /**
     * lay lien ket xem bo phan tren modal tu modules khac
     * @return string
     */
    public function getShowLink(){
        return Yii::getAlias('@web/bophan/bo-phan/view?id=' . $this->id);
    }
    
    
    public $resultTree = '';
    /**
     * ham de quy lay danh sach bo phan con truc thuoc (xu ly cho getListCTB)
     * @param array $arr
     * @param int $pid
     * @param int $level
     */
    private function getChildCTB($arr, $pid, $level){
        $left = $level . '---';
        $listChildCatalogs = $this::find()->where(['truc_thuoc'=>$pid])->all();
        if($listChildCatalogs != null){
            $this->resultTree .= '<ul>';
            foreach ($listChildCatalogs as $j=>$catalog1){
                    $this->resultTree .= '<li data-value="' . $catalog1->id . '"><span class="data">' . $catalog1->ten_bo_phan . '</span>';
                    $this->getChildCTB($this->resultTree, $catalog1->id, $left);
                    $this->resultTree .= '</li>';
            }
            $this->resultTree .= '</ul>';
        }
    }
    
    /**
     * hien thi danh sach bo phan theo phan cap cha-con su dung trong treeview
     * @param boolean $withGroup
     * @return array
     */
    public function getListCTB($withGroup=true)
    {
        $this->resultTree = '';
        //lay ds catalog parent
        $parentCatalogs = $this::find()->where('truc_thuoc IS NULL OR truc_thuoc = 0')->all();
        foreach ($parentCatalogs as $indexCatalog=>$catalog){
                $this->resultTree .= '<li data-value="' . $catalog->id . '"><span class="data">' . $catalog->ten_bo_phan . '</span>';
                $this->getChildCTB($this->resultTree, $catalog->id, '');
                $this->resultTree .= '</li>';
        }
        return $this->resultTree;
    }
}