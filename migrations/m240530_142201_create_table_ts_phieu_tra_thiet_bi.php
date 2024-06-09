<?php

use yii\db\Migration;

/**
 * Class m240530_142201_create_table_ts_phieu_tra_thiet_bi
 */
class m240530_142201_create_table_ts_phieu_tra_thiet_bi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_phieu_tra_thiet_bi', [
            'id' => $this->primaryKey(),
            'id_nguoi_tra' => $this->integer()->notNull(),
            'ngay_tra' => $this->dateTime()->null(),
            'noi_dung_tra' => $this->string()->null(),

            'hieu_luc' => $this->string()->null(),

            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->null(),
            'deleted_at' => $this->datetime()->null(),
        ]);

        // Add foreign keys with appropriate ON DELETE and ON UPDATE actions
        $this->addForeignKey(
            'fk_phieu_tra_thiet_bi_nguoi_tra',
            'ts_phieu_tra_thiet_bi',
            'id_nguoi_tra',
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
        // echo "m240530_142201_create_table_ts_phieu_tra_thiet_bi cannot be reverted.\n";
        // return false;
        $this->dropForeignKey('fk_phieu_tra_thiet_bi_nguoi_tra', 'ts_phieu_tra_thiet_bi');
        $this->dropTable('ts_phieu_tra_thiet_bi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240530_142201_create_table_ts_phieu_tra_thiet_bi cannot be reverted.\n";

        return false;
    }
    */
}
