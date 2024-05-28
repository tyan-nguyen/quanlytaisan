<?php

use yii\db\Migration;

/**
 * Class m240521_134158_create_table_ts_yeu_cau_van_hanh_ct
 */
class m240521_134158_create_table_ts_yeu_cau_van_hanh_ct extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_yeu_cau_van_hanh_ct', [
            'id' => $this->primaryKey(),
            'id_thiet_bi' => $this->integer()->notNull(),
            'id_yeu_cau_van_hanh' => $this->integer()->notNull(),
            'ngay_bat_dau' => $this->dateTime()->null(),
            'ngay_ket_thuc' => $this->dateTime()->null(),
            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->null(),
            'deleted_at' => $this->datetime()->null(),
        ]);

        // Create indexes and add foreign keys
        
        $this->createIndex(
            'idx-yeu_cau_van_hanh_ct-id_yeu_cau_van_hanh',
            'ts_yeu_cau_van_hanh_ct',
            'id_yeu_cau_van_hanh'
        );

        $this->addForeignKey(
            'fk-yeu_cau_van_hanh_ct-id_yeu_cau_van_hanh',
            'ts_yeu_cau_van_hanh_ct',
            'id_yeu_cau_van_hanh',
            'ts_yeu_cau_van_hanh',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-yeu_cau_van_hanh_ct-id_thiet_bi',
            'ts_yeu_cau_van_hanh_ct',
            'id_thiet_bi'
        );

        $this->addForeignKey(
            'fk-yeu_cau_van_hanh_ct-id_thiet_bi',
            'ts_yeu_cau_van_hanh_ct',
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
        // echo "m240521_134158_create_table_ts_yeu_cau_van_hanh_ct cannot be reverted.\n";

        $this->dropForeignKey(
            'fk-yeu_cau_van_hanh_ct-id_yeu_cau_van_hanh',
            'ts_yeu_cau_van_hanh_ct'
        );

        $this->dropIndex(
            'idx-yeu_cau_van_hanh_ct-id_yeu_cau_van_hanh',
            'ts_yeu_cau_van_hanh_ct'
        );

        $this->dropForeignKey(
            'fk-yeu_cau_van_hanh_ct-id_thiet_bi',
            'ts_yeu_cau_van_hanh_ct'
        );

        $this->dropIndex(
            'idx-yeu_cau_van_hanh_ct-id_thiet_bi',
            'ts_yeu_cau_van_hanh_ct'
        );
        $this->dropTable('ts_yeu_cau_van_hanh_ct');
//        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240521_134158_create_table_ts_yeu_cau_van_hanh_ct cannot be reverted.\n";

        return false;
    }
    */
}
