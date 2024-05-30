<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Role;
/**
 * Class m240528_150329_insert_role_data
 */
class m240528_150329_insert_role_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        [
            'name' => 'nQuanLyPhieuSuaChua',
            'type' => 1,
            'description' => 'Quản lý phiếu sửa chữa',
            'childrenNames'=>[
                'qXemDanhSachPhieuSuaChua',
                'qThemPhieuSuaChua',
                'qSuaPhieuSuaChua',
                'qXoaPhieuSuaChua',
                'qSuaBaoGiaSuaChua'
            ]
            
        ],
        [
            'name' => 'nQuanLyVatTuKho',
            'type' => 1,
            'description' => 'Quản lý vật tư kho',
            'childrenNames'=>[
                'qXemDanhSachVatTu',
                'qThemVatTu',
                'qSuaVatTu',
                'qXoaVatTu'
            ]
        ],
        [
            'name' => 'nDuyetBaoGiaSuaChua',
            'type' => 1,
            'description' => 'Duyệt báo giá sửa chữa',
            'childrenNames'=>[
                'qDuyetBaoGiaSuaChua'
            ]
        ],
    ];
    public function safeUp()
    {
        
        $check=Role::find()->where([
            'in',
            'name',
            [
                'nQuanLyPhieuSuaChua',
                'nQuanLyVatTuKho',
                'nDuyetBaoGiaSuaChua'
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
            'nQuanLyPhieuSuaChua',
            'nQuanLyVatTuKho',
            'nDuyetBaoGiaSuaChua'
            ]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240528_150329_insert_role_data cannot be reverted.\n";

        return false;
    }
    */
}
