<?php

use yii\db\Migration;

/**
 * Class m240701_153319_add_id_tt_mua_sam_column_to_ts_phieu_mua_sam
 */
class m240701_153319_add_id_tt_mua_sam_column_to_ts_phieu_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_mua_sam', 'id_tt_mua_sam', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_mua_sam', 'id_tt_mua_sam');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240701_153319_add_id_tt_mua_sam_column_to_ts_phieu_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
