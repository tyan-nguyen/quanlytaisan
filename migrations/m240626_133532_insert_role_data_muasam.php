<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Role;
/**
 * Class m240626_133532_insert_role_data_muasam
 */
class m240626_133532_insert_role_data_muasam extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        [
            'name' => 'nQuanLyPhieuMuaSam',
            'type' => 1,
            'description' => 'Quản lý phiếu mua sắm',
            'childrenNames'=>[
                'qXemDanhSachPhieuMuaSam',
                'qThemPhieuMuaSam',
                'qSuaPhieuMuaSam',
                'qXoaPhieuMuaSam',
                'qSuaBaoGiaMuaSam',
                'qDuyetPhieuMuaSam'
            ]
            
        ],
        
        [
            'name' => 'nDuyetBaoGiaMuaSam',
            'type' => 1,
            'description' => 'Duyệt báo giá mua sắm',
            'childrenNames'=>[
                'qDuyetBaoGiaMuaSam',
                'qXemDanhSachPhieuMuaSam',
            ]
        ],
        [
            'name' => 'nDuyetPhieuMuaSam',
            'type' => 1,
            'description' => 'Duyệt phiếu mua sắm',
            'childrenNames'=>[
                'qDuyetPhieuMuaSam',
                'qXemDanhSachPhieuMuaSam',
            ]
        ],
        [
            'name' => 'nThemPhieuMuaSam',
            'type' => 1,
            'description' => 'Thêm phiếu mua sắm',
            'childrenNames'=>[
                'qThemPhieuMuaSam',
                'qXemDanhSachPhieuMuaSam'
            ]
        ]
    ];
    public function safeUp()
    {
        $check=Role::find()->where([
            'in',
            'name',
            [
                'nQuanLyPhieuMuaSam',
                'nDuyetBaoGiaMuaSam',
                'nThemPhieuMuaSam'
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
            'nQuanLyPhieuMuaSam',
            'nDuyetBaoGiaMuaSam',
            'nThemPhieuMuaSam'
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
