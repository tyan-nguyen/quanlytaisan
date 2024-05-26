<?php

use yii\db\Migration;

/**
 * Class m240426_073957_create_table_ts_tai_lieu
 */
class m240426_073957_create_table_ts_tai_lieu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_tai_lieu', [
            'id' => $this->primaryKey(),
            'loai' => $this->string()->notNull(),
            'id_tham_chieu' => $this->integer()->notNull(),
            'ten_tai_lieu' => $this->string(),
            'duong_dan' => $this->string(),
            'ten_file_luu' => $this->string(),
            'file_extension' => $this->string(),
            'file_size' => $this->integer(),
            'ghi_chu' => $this->text(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_tai_lieu');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_073957_create_table_ts_tai_lieu cannot be reverted.\n";

        return false;
    }
    */
}
