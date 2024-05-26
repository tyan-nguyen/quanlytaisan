<?php

use yii\db\Migration;

/**
 * Class m240426_071111_create_table_ts_history
 */
class m240426_071111_create_table_ts_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_history', [
            'id' => $this->primaryKey(),
            'loai' => $this->string()->notNull(),
            'id_tham_chieu' => $this->integer()->notNull(),
            'noi_dung' => $this->text(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_history');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_071111_create_table_ts_history cannot be reverted.\n";

        return false;
    }
    */
}
