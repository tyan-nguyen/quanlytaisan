<?php
namespace app\modules\user\models;
use Yii;
use app\modules\dungchung\models\History;
use yii\helpers\ArrayHelper;
use PhpParser\Node\Stmt\Expression;
use app\modules\bophan\models\NhanVien;

class User extends UserBase{
    public static function getUsernameByID($id){
        return User::findOne($id)?User::findOne($id)->username:'';
    }
    /**
     * lay danh sach tai khoan chua duoc lien ket voi nhan vien
     * @param string $tenMacDinh
     * @return array
     */
    public function getListUnused($tenMacDinh=NULL){
        
        $query = NhanVien::find()->select(['ten_truy_cap'])->where('ten_truy_cap IS NOT NULL');
        if($tenMacDinh != NULL){
            $query = $query->andWhere(['<>','ten_truy_cap',$tenMacDinh]);
        }
        $query = $query->asArray()->all();
        
        $listUsed = ArrayHelper::getColumn($query,'ten_truy_cap');
        $list = User::find()->where(['NOT IN','username',$listUsed])->all();
        return ArrayHelper::map($list, 'username', 'username');
    }
    /**
     * lay user id co lien ket voi tai khoan
     * @return \yii\db\ActiveRecord|array|NULL
     */
    /* public static function getUserIDbyNhanVien($idNhanVien){
        $idUser = null;
        $nv = NhanVien::findOne($idNhanVien);
        if($nv!=null){
            if($nv->ten_truy_cap!=''){
                $user = User::findByUsername($nv->ten_truy_cap);
                if($user != null){
                    $idUser = $user->id;
                }
            }
        }
        return $idUser;
    } */
    /**
     * get current user id nhan vien
     * @return \yii\db\ActiveRecord|array|NULL
     */
    public static function getCurrentNhanVienID(){
        $idNhanVien = null;
        $nv = NhanVien::findOne(['ten_truy_cap'=>Yii::$app->user->username]);
        if($nv!=null){
            $idNhanVien = $nv->id;
        }
        return $idNhanVien;
    }
    
    /**
     * lay nhan vien co lien ket voi tai khoan
     * @return \yii\db\ActiveRecord|array|NULL
     */
    public function getNhanVien(){
        return NhanVien::find()->where(['ten_truy_cap'=>$this->username])->one();
    }
    
    /**
     * hien thi ten nhan vien duoc lien ket voi tai khoan
     * @return string
     */
    public function getTenNhanVien(){
        return $this->nhanVien != null ? $this->nhanVien->ten_nhan_vien : '';
    }
    
    /**
     * lay id nhan vien duoc lien ket voi tai khoan
     * @return string
     */
    public function getIdNhanVien(){
        return $this->nhanVien != null ? $this->nhanVien->id : '';
    }
    
    /**
     * lay id bo phan duoc lien ket voi tai khoan
     * @return string
     */
    public function getIdBoPhan(){
        return $this->nhanVien != null ? $this->nhanVien->id_bo_phan : '';
    }
    
    /**
     * hien thi chuc vu nhan vien duoc lien ket voi tai khoan
     * @return string
     */
    public function getChucVu(){
        return $this->nhanVien != null ? $this->nhanVien->chuc_vu : '';
    }
    
    /**
     * hien thi link den bang nhan vien
     * @return string
     */
    public function getShowLinkNhanVien(){
        return $this->nhanVien != null ? $this->nhanVien->showLink : '';
    }
    
}