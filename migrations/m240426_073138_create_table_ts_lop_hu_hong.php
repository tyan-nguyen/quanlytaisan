<?php

use yii\db\Migration;

/**
 * Class m240426_073138_create_table_ts_lop_hu_hong
 */
class m240426_073138_create_table_ts_lop_hu_hong extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_lop_hu_hong', [
            'id' => $this->primaryKey(),
            'ma_lop' => $this->string()->notNull(),
            'ten_lop' => $this->string()->notNull(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_lop_hu_hong');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_073138_create_table_ts_lop_hu_hong cannot be reverted.\n";

        return false;
    }
    */
}
