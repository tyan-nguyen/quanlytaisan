<?php

use yii\db\Migration;

/**
 * Class m240711_150658_add_columns_to_ts_phieu_mua_sam
 */
class m240711_150658_add_columns_to_ts_phieu_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_mua_sam', 'dm_mua_sam', $this->string()->defaultValue('thiet_bi'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_mua_sam', 'trang_thai');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_150658_add_columns_to_ts_phieu_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
