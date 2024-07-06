<?php

use yii\db\Migration;

/**
 * Class m240705_151358_add_danh_gia_columns_to_ts_phieu_sua_chua
 */
class m240705_151358_add_danh_gia_columns_to_ts_phieu_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_sua_chua', 'danh_gia_bg', $this->integer()->defaultValue(0));
        $this->addColumn('ts_phieu_mua_sam', 'danh_gia_bg', $this->integer()->defaultValue(0));
        $this->addColumn('ts_phieu_mua_sam', 'danh_gia_ms', $this->integer()->defaultValue(0));
        $this->addColumn('ts_phieu_mua_sam', 'ghi_chu2', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_sua_chua', 'danh_gia_bg');
        $this->dropColumn('ts_phieu_mua_sam', 'danh_gia_bg');
        $this->dropColumn('ts_phieu_mua_sam', 'danh_gia_ms');
        $this->dropColumn('ts_phieu_mua_sam', 'ghi_chu2');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240705_151358_add_danh_gia_columns_to_ts_phieu_sua_chua cannot be reverted.\n";

        return false;
    }
    */
}
