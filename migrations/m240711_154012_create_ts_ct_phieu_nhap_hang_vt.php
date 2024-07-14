<?php

use yii\db\Migration;

/**
 * Class m240711_154012_create_ts_ct_phieu_nhap_hang_vt
 */
class m240711_154012_create_ts_ct_phieu_nhap_hang_vt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_ct_phieu_nhap_hang_vt', [
            'id' => $this->primaryKey(),
            'id_phieu_mua_sam' => $this->integer(),
            'id_ct_phieu_mua_sam_vt' => $this->integer(),
            'hang_san_xuat' => $this->text(),
            'so_luong' => $this->integer(),
            'ghi_chu' => $this->text(),
            'don_gia' => $this->decimal(10, 2),
            'id_vat_tu' => $this->integer(),
            'id_kho' => $this->integer(),
            'don_vi_tinh' => $this->string(),
            'nguoi_tao' => $this->integer(),
            'ngay_tao' => $this->dateTime(),
            'nguoi_cap_nhat' => $this->integer(),
            'ngay_cap_nhat' => $this->dateTime(),
        ]);

        // Add foreign keys
        $this->addForeignKey('fk_ts_ct_phieu_nhap_hang_vt-id_phieu_mua_sam', 'ts_ct_phieu_nhap_hang_vt', 'id_phieu_mua_sam', 'ts_phieu_mua_sam', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_ts_ct_phieu_nhap_hang_vt-id_ct_phieu_mua_sam_vt', 'ts_ct_phieu_nhap_hang_vt', 'id_ct_phieu_mua_sam_vt', 'ts_ct_phieu_mua_sam_vt', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign keys first
        $this->dropForeignKey('fk_ts_ct_phieu_nhap_hang_vt-id_phieu_mua_sam', 'ts_ct_phieu_nhap_hang_vt');
        $this->dropForeignKey('fk_ts_ct_phieu_nhap_hang_vt-id_ct_phieu_mua_sam_vt', 'ts_ct_phieu_nhap_hang_vt');

        $this->dropTable('ts_ct_phieu_nhap_hang_vt');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_154012_create_ts_ct_phieu_nhap_hang_vt cannot be reverted.\n";

        return false;
    }
    */
}
