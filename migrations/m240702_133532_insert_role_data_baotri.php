<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Role;
/**
 * Class m240626_133532_insert_role_data_muasam
 */
class m240702_133532_insert_role_data_baotri extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        [
            'name' => 'nQuanLyBaoTri',
            'type' => 1,
            'description' => 'Quản lý Bảo trì - Bão dưỡng',
            'childrenNames'=>[
                'qXemDanhSachKeHoachBaoTri',
                'qThemKeHoachBaoTri',
                'qSuaKeHoachBaoTri',
                'qXoaKeHoachBaoTri',
                'qXemDanhSachPhieuBaoTri',
                'qXemPhieuBaoTri',
                'qSuaPhieuBaoTri',
                'qXemLichBaoTri',
                'qQuanLyDanhMucLoaiBaoTri'
            ]
            
        ],
    ];
    public function safeUp()
    {
        $check=Role::find()->where([
            'in',
            'name',
            [
                'nQuanLyBaoTri',
            ]
            
        ])->count();
        if(!$check)
        {
            foreach ($this->data as $item) {
                $authItem = new Role();
                $authItem->name = $item['name'];
                $authItem->type = $item['type'];
                $authItem->description = $item['description'];
                $authItem->created_at = time();
                $authItem->updated_at = time();
                $authItem->save();
                Role::addChildren($item['name'], $item['childrenNames'], $throwException = false);
            }
            
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->data as $item) {
            Role::removeChildren($item['name'], $item['childrenNames'], $throwException = false);
        }
        Role::deleteAll(['name' => [
            'nQuanLyBaoTri',
        ]]);
    }
    
    /*
     // Use up()/down() to run migration code without a transaction.
     public function up()
     {
     
     }
     
     public function down()
     {
     echo "m240626_133532_insert_role_data_muasam cannot be reverted.\n";
     
     return false;
     }
     */
}
