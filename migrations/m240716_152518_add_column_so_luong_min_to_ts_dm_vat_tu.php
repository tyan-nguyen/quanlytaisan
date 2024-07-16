<?php

use yii\db\Migration;

/**
 * Class m240716_152518_add_column_so_luong_min_to_ts_dm_vat_tu
 */
class m240716_152518_add_column_so_luong_min_to_ts_dm_vat_tu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_dm_vat_tu', 'so_luong_min', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_dm_vat_tu', 'so_luong_min');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240716_152518_add_column_so_luong_min_to_ts_dm_vat_tu cannot be reverted.\n";

        return false;
    }
    */
}
