<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240714_152742_insert_role_data_muasam_vat_tu
 */
class m240714_152742_insert_role_data_muasam_vat_tu extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        [
            'name' => 'nQuanLyPhieuMuaSamVatTu',
            'type' => 1,
            'description' => 'Quản lý phiếu mua sắm vật tư',
            'childrenNames'=>[
                'qXemDanhSachPhieuMuaSamVatTu',
                'qThemPhieuMuaSamVatTu',
                'qSuaPhieuMuaSamVatTu',
                'qXoaPhieuMuaSamVatTu',

            ]
            
        ],
        
        
        [
            'name' => 'nThemPhieuMuaSamVatTu',
            'type' => 1,
            'description' => 'Thêm phiếu mua sắm vật tư',
            'childrenNames'=>[
                'qThemPhieuMuaSamVatTu',
                'qXemDanhSachPhieuMuaSamVatTu'
            ]
        ]
    ];
    public function safeUp()
    {
        $check=Role::find()->where([
            'in',
            'name',
            [
                'nQuanLyPhieuMuaSamVatTu',
                'nThemPhieuMuaSamVatTu'
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
            'nQuanLyPhieuMuaSamVatTu',
            'nThemPhieuMuaSamVatTu'
            ]]);
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240714_152742_insert_role_data_muasam_vat_tu cannot be reverted.\n";

        return false;
    }
    */
}
