<?php

use yii\db\Migration;

/**
 * Class m240713_143118_add_don_vi_tinh_to_ts_ct_phieu_mua_sam_vt
 */
class m240713_143118_add_don_vi_tinh_to_ts_ct_phieu_mua_sam_vt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_ct_phieu_mua_sam_vt', 'don_vi_tinh', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_ct_phieu_mua_sam_vt', 'don_vi_tinh');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240713_143118_add_don_vi_tinh_to_ts_ct_phieu_mua_sam_vt cannot be reverted.\n";

        return false;
    }
    */
}
