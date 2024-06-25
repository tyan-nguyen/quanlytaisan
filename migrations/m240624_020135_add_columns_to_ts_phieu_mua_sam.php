<?php

use yii\db\Migration;

/**
 * Class m240624_020135_add_columns_to_ts_phieu_mua_sam
 */
class m240624_020135_add_columns_to_ts_phieu_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_mua_sam', 'id_nguoi_quan_ly', $this->integer());
        $this->addColumn('ts_phieu_mua_sam', 'id_bo_phan_quan_ly', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_mua_sam', 'id_nguoi_quan_ly');
        $this->dropColumn('ts_phieu_mua_sam', 'id_bo_phan_quan_ly');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240624_020135_add_columns_to_ts_phieu_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
