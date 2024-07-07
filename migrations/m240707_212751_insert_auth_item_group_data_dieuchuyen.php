<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\AuthItemGroup;

/**
 * Class m240707_212751_insert_auth_item_group_data_dieuchuyen
 */
class m240707_212751_insert_auth_item_group_data_dieuchuyen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            ['code' => 'quanLyDieuChuyenThietBi', 'name' => 'Quản lý điều chuyển thiết bị', 'created_at' => time(), 'updated_at' => time()]

        ];
        $check = AuthItemGroup::find()->where(['in', 'code', ['quanLyDieuChuyenThietBi']])->count();
        if (!$check)
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
        AuthItemGroup::deleteAll(['code' => ['quanLyDieuChuyenThietBi']]);


        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240707_212751_insert_auth_item_group_data_dieuchuyen cannot be reverted.\n";

        return false;
    }
    */
}
