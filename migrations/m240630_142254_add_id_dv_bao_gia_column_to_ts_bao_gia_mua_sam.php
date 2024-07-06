<?php

use yii\db\Migration;

/**
 * Class m240630_142254_add_id_dv_bao_gia_column_to_ts_bao_gia_mua_sam
 */
class m240630_142254_add_id_dv_bao_gia_column_to_ts_bao_gia_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_bao_gia_mua_sam', 'id_dv_bao_gia', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_bao_gia_mua_sam', 'id_dv_bao_gia');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240630_142254_add_id_dv_bao_gia_column_to_ts_bao_gia_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
