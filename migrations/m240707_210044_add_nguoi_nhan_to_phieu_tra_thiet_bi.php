<?php

use yii\db\Migration;

/**
 * Class m240707_210044_add_nguoi_nhan_to_phieu_tra_thiet_bi
 */
class m240707_210044_add_nguoi_nhan_to_phieu_tra_thiet_bi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_tra_thiet_bi', 'id_nguoi_nhan', $this->integer());

        $this->addForeignKey(
            'fk_phieu_tra_thiet_bi_nguoi_nhan',
            'ts_phieu_tra_thiet_bi',
            'id_nguoi_nhan',
            'ts_nhan_vien',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m240707_210044_add_nguoi_nhan_to_phieu_tra_thiet_bi cannot be reverted.\n";
        $this->dropForeignKey('fk_phieu_tra_thiet_bi_nguoi_nhan', 'ts_phieu_tra_thiet_bi');
        $this->dropColumn('ts_phieu_tra_thiet_bi', 'id_nguoi_nhan');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240707_210044_add_nguoi_nhan_to_phieu_tra_thiet_bi cannot be reverted.\n";

        return false;
    }
    */
}
