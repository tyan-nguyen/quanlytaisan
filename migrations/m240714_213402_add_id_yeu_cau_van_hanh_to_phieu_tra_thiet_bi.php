<?php

use yii\db\Migration;

/**
 * Class m240714_213402_add_id_yeu_cau_van_hanh_to_phieu_tra_thiet_bi
 */
class m240714_213402_add_id_yeu_cau_van_hanh_to_phieu_tra_thiet_bi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_tra_thiet_bi', 'id_yeu_cau_van_hanh', $this->integer()->null());

        $this->createIndex(
            'idx-phieu_tra_thiet_bi-id_yeu_cau_van_hanh',
            'ts_phieu_tra_thiet_bi',
            'id_yeu_cau_van_hanh'
        );

        $this->addForeignKey(
            'fk-phieu_tra_thiet_bi-id_yeu_cau_van_hanh',
            'ts_phieu_tra_thiet_bi',
            'id_yeu_cau_van_hanh',
            'ts_yeu_cau_van_hanh',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key
        $this->dropForeignKey(
            'fk-phieu_tra_thiet_bi-id_yeu_cau_van_hanh',
            'ts_phieu_tra_thiet_bi'
        );

        // Drop index
        $this->dropIndex(
            'idx-phieu_tra_thiet_bi-id_yeu_cau_van_hanh',
            'ts_phieu_tra_thiet_bi'
        );

        // Drop the column
        $this->dropColumn('ts_phieu_tra_thiet_bi', 'id_yeu_cau_van_hanh');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240714_213402_add_id_yeu_cau_van_hanh_to_phieu_tra_thiet_bi cannot be reverted.\n";

        return false;
    }
    */
}
