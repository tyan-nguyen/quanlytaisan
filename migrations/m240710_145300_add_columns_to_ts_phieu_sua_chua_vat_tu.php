<?php

use yii\db\Migration;

/**
 * Class m240710_145300_add_columns_to_ts_phieu_sua_chua_vat_tu
 */
class m240710_145300_add_columns_to_ts_phieu_sua_chua_vat_tu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_sua_chua_vat_tu', 'ten_vat_tu', $this->string());
        $this->addColumn('ts_phieu_sua_chua_vat_tu', 'id_kho_luu_tru', $this->integer());
        $this->addColumn('ts_phieu_sua_chua_vat_tu', 'hang_san_xuat', $this->string());
        $this->addColumn('ts_phieu_sua_chua_vat_tu', 'trang_thai', $this->string()->defaultValue('new'));
        $this->alterColumn('ts_phieu_sua_chua_vat_tu', 'id_vat_tu', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_sua_chua_vat_tu', 'ten_vat_tu');
        $this->dropColumn('ts_phieu_sua_chua_vat_tu', 'id_kho_luu_tru');
        $this->dropColumn('ts_phieu_sua_chua_vat_tu', 'hang_san_xuat');
        $this->dropColumn('ts_phieu_sua_chua_vat_tu', 'trang_thai');
        $this->alterColumn('ts_phieu_sua_chua_vat_tu', 'id_vat_tu', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240710_145300_add_columns_to_ts_phieu_sua_chua_vat_tu cannot be reverted.\n";

        return false;
    }
    */
}
