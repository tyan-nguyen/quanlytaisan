<?php


namespace app\modules\taisan\models;


use Yii;


class HeThong extends HeThongBase
{
    public $arr;//use in getListTree
    public $parr;//use in getListTree
    
    /**
     * lay thong tin he thong truc thuoc
     * @return string
     */
    public function getTenHeThongTrucThuoc(){
        return $this->heThongTrucThuoc !=null ? $this->heThongTrucThuoc->ten_he_thong : '';
    }   
    
    /**
     * ham de quy lay danh sach he thong con truc thuoc (xu ly cho getListTree)
     * @param array $arr
     * @param int $pid
     * @param int $level
     */
    private function getChild($arr, $pid, $level){
        $left = $level . '---';
        $listChildCatalogs = $this::find()->where(['truc_thuoc'=>$pid])->all();
        if($listChildCatalogs != null){
            foreach ($listChildCatalogs as $j=>$catalog1){
                $this->arr[$catalog1->id] = $left . ' ' .$catalog1->ten_he_thong;
                $this->getChild($this->arr, $catalog1->id, $left);
            }
        }
    }
    
    /**
     * hien thi danh sach he thong theo phan cap cha-con
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
                    $this->arr[$catalog->id] = $catalog->ten_he_thong;
                    $this->getChild($this->arr, $catalog->id, '');
                    if($withGroup==true)
                        $this->parr[$catalog->ten_he_thong] = $this->arr;
            }
            if($withGroup==true)
                return $this->parr;
                else
                    return $this->arr;
    }
    
    
    public $resultTree = '';
    /**
     * ham de quy lay danh sach he thong con truc thuoc (xu ly cho getListCTB)
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
                    $this->resultTree .= '<li data-value="' . $catalog1->id . '"><span class="data">' . $catalog1->ten_he_thong . '</span>';
                    
                    $this->getChildCTB($this->resultTree, $catalog1->id, $left);
                    $this->resultTree .= '</li>';
            }
            $this->resultTree .= '</ul>';
        }
    }
    
    /**
     * hien thi danh sach he thong theo phan cap cha-con treeview
     * @param boolean $withGroup
     * @return array
     */
    public function getListCTB($withGroup=true)
    {
            $this->resultTree = '';
            //lay ds catalog parent
            $parentCatalogs = $this::find()->where('truc_thuoc IS NULL OR truc_thuoc = 0')->all();
            foreach ($parentCatalogs as $indexCatalog=>$catalog){
                    $this->resultTree .= '<li data-value="' . $catalog->id . '"><span class="data">' . $catalog->ten_he_thong . '</span>';   
                    $this->getChildCTB($this->resultTree, $catalog->id, '');
                    $this->resultTree .= '</li>';
            }
            return $this->resultTree;
    }
   
}
