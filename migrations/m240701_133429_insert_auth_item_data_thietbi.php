<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240626_133429_insert_auth_item_data_muasam
 */
class m240701_133429_insert_auth_item_data_thietbi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            
            [
                'name' => 'qQuanLyTaiSanCaNhan',
                'type' => 2,
                'description' => 'Quản lý tài sản cá nhân',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyTaiSan',
            ],
            [
                'name' => 'qQuanLyTaiSanBoPhan',
                'type' => 2,
                'description' => 'Quản lý tài sản bộ phận',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyTaiSan',
            ]
        ];
        $check=Permission::find()->where([
            'in',
            'name',
            [
                'qQuanLyTaiSanCaNhan',
                'qQuanLyTaiSanBoPhan'
            ]
            
        ])->count();
        if(!$check)
            foreach ($data as $item) {
                $authItem = new Permission();
                $authItem->name = $item['name'];
                $authItem->type = $item['type'];
                $authItem->description = $item['description'];
                $authItem->created_at = $item['created_at'];
                $authItem->updated_at = $item['updated_at'];
                $authItem->group_code = $item['group_code'];
                $authItem->save();
            }
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Permission::deleteAll(['name' => [
            'qQuanLyTaiSanCaNhan',
            'qQuanLyTaiSanBoPhan'
        ]]);
    }
    
    /*
     // Use up()/down() to run migration code without a transaction.
     public function up()
     {
     
     }
     
     public function down()
     {
     echo "m240626_133429_insert_auth_item_data_muasam cannot be reverted.\n";
     
     return false;
     }
     */
}
