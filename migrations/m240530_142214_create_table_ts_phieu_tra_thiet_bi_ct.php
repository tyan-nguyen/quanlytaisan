<?php

use yii\db\Migration;

/**
 * Class m240530_142214_create_table_ts_phieu_tra_thiet_bi_ct
 */
class m240530_142214_create_table_ts_phieu_tra_thiet_bi_ct extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_phieu_tra_thiet_bi_ct',[
            'id' => $this->primaryKey(),
            'id_thiet_bi' => $this->integer()->notNull(),
            'id_phieu_tra_thiet_bi' => $this->integer()->notNull(),
            'ngay_tra' => $this->dateTime()->null(),

            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->null(),
            'deleted_at' => $this->datetime()->null(),
        ]);

        $this->createIndex(
            'idx-phieu_tra_thiet_bi_ct-id_phieu_tra_thiet_bi',
            'ts_phieu_tra_thiet_bi_ct',
            'id_phieu_tra_thiet_bi'
        );

        $this->addForeignKey(
            'fk-phieu_tra_thiet_bi_ct-id_phieu_tra_thiet_bi',
            'ts_phieu_tra_thiet_bi_ct',
            'id_phieu_tra_thiet_bi',
            'ts_phieu_tra_thiet_bi',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-phieu_tra_thiet_bi_ct-id_thiet_bi',
            'ts_phieu_tra_thiet_bi_ct',
            'id_thiet_bi'
        );

        $this->addForeignKey(
            'fk-phieu_tra_thiet_bi_ct-id_thiet_bi',
            'ts_phieu_tra_thiet_bi_ct',
            'id_thiet_bi',
            'ts_thiet_bi',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-phieu_tra_thiet_bi_ct-id_phieu_tra_thiet_bi',
            'ts_phieu_tra_thiet_bi_ct'
        );

        $this->dropIndex(
            'idx-phieu_tra_thiet_bi_ct-id_phieu_tra_thiet_bi',
            'ts_phieu_tra_thiet_bi_ct'
        );

        $this->dropForeignKey(
            'fk-phieu_tra_thiet_bi_ct-id_thiet_bi',
            'ts_phieu_tra_thiet_bi_ct'
        );

        $this->dropIndex(
            'idx-phieu_tra_thiet_bi_ct-id_thiet_bi',
            'ts_phieu_tra_thiet_bi_ct'
        );

        // echo "m240530_142214_create_table_ts_phieu_tra_thiet_bi_ct cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240530_142214_create_table_ts_phieu_tra_thiet_bi_ct cannot be reverted.\n";

        return false;
    }
    */
}
