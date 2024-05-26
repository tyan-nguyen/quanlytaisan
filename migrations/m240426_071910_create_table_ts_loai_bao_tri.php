<?php

use yii\db\Migration;

/**
 * Class m240426_071910_create_table_ts_loai_bao_tri
 */
class m240426_071910_create_table_ts_loai_bao_tri extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_loai_bao_tri', [
            'id' => $this->primaryKey(),
            'ten' => $this->string()->notNull(),
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
        $this->dropTable('ts_loai_bao_tri');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_071910_create_table_ts_loai_bao_tri cannot be reverted.\n";

        return false;
    }
    */
}
