<?php

use yii\db\Migration;

/**
 * Class m240426_072759_create_table_ts_loai_thiet_bi
 */
class m240426_072759_create_table_ts_loai_thiet_bi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_loai_thiet_bi', [
            'id' => $this->primaryKey(),
            'ma_loai' => $this->string()->notNull(),
            'ten_loai' => $this->string()->notNull(),
            'don_vi_tinh' => $this->string(),
            'truc_thuoc' => $this->integer(),
            'loai_thiet_bi' => $this->string(),
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
        $this->dropTable('ts_loai_thiet_bi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_072759_create_table_ts_loai_thiet_bi cannot be reverted.\n";

        return false;
    }
    */
}
