<?php

use yii\db\Migration;

/**
 * Class m240425_130703_create_table_ts_he_thong
 */
class m240425_130703_create_table_ts_he_thong extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_he_thong', [
            'id' => $this->primaryKey(),
            'ma_he_thong' => $this->string()->notNull(),
            'ten_he_thong' => $this->string()->notNull(),
            'truc_thuoc' => $this->integer(),
            'mo_ta' => $this->text(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_he_thong');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240425_130703_create_table_ts_he_thong cannot be reverted.\n";

        return false;
    }
    */
}
