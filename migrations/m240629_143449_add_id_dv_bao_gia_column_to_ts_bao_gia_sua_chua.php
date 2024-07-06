<?php

use yii\db\Migration;

/**
 * Class m240629_142449_add_id_dv_bao_gia_column_to_ts_bao_gia_sua_chua
 */
class m240629_143449_add_id_dv_bao_gia_column_to_ts_bao_gia_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_bao_gia_sua_chua', 'id_dv_bao_gia', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_bao_gia_sua_chua', 'id_dv_bao_gia');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240629_142449_add_id_dv_bao_gia_column_to_ts_bao_gia_sua_chua cannot be reverted.\n";

        return false;
    }
    */
}
