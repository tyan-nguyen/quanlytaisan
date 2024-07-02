<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\AuthItemGroup;
/**
 * Class m240626_133402_insert_auth_item_group_data_muasam
 */
class m240702_133402_insert_auth_item_group_data_baotri extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            ['code' => 'quanLyBaoTri', 'name' => 'Quản lý Bảo trì - Bảo dưỡng', 'created_at' => time(), 'updated_at' => time()]
            
        ];
        $check=AuthItemGroup::find()->where(['in','code',['quanLyBaoTri']])->count();
        if(!$check)
            foreach ($data as $item) {
                $authItemGroup = new AuthItemGroup();
                $authItemGroup->code = $item['code'];
                $authItemGroup->name = $item['name'];
                $authItemGroup->created_at = $item['created_at'];
                $authItemGroup->updated_at = $item['updated_at'];
                $authItemGroup->save();
            }
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        AuthItemGroup::deleteAll(['code' => ['quanLyBaoTri']]);
    }
    
    /*
     // Use up()/down() to run migration code without a transaction.
     public function up()
     {
     
     }
     
     public function down()
     {
     echo "m240626_133402_insert_auth_item_group_data_muasam cannot be reverted.\n";
     
     return false;
     }
     */
}
