<?php

use yii\db\Migration;

/**
 * Class m240608_144012_create_table_ts_ct_phieu_nhap_hang
 */
class m240608_144012_create_table_ts_ct_phieu_nhap_hang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_ct_phieu_nhap_hang', [
            'id' => $this->primaryKey(),
            'ma_thiet_bi' => $this->string(),
            'id_vi_tri' => $this->integer(),
            'id_he_thong' => $this->integer(),
            'id_thiet_bi_cha' => $this->integer(),
            'id_phieu_mua_sam' => $this->integer(),
            'id_ct_phieu_mua_sam' => $this->integer(),
            'nam_san_xuat' => $this->integer(),
            'serial' => $this->string(),
            'model' => $this->string(),
            'xuat_xu' => $this->string(),
            'id_hang_bao_hanh' => $this->integer(),
            'id_nhien_lieu' => $this->integer(),
            'dac_tinh_ky_thuat' => $this->text(),
            'id_don_vi_bao_tri' => $this->integer(),
            'han_bao_hanh' => $this->date(),
            'ghi_chu' => $this->text(),
            'id_nguoi_quan_ly' => $this->integer(),
            'id_bo_phan_quan_ly' => $this->integer(),
            'id_thiet_bi' => $this->integer(),
            'nguoi_tao' => $this->integer(),
            'ngay_tao' => $this->dateTime(),
            'nguoi_cap_nhat' => $this->integer(),
            'ngay_cap_nhat' => $this->dateTime(),
        ]);

        // Add foreign keys
        $this->addForeignKey('fk_ts_ct_phieu_nhap_hang-id_phieu_mua_sam', 'ts_ct_phieu_nhap_hang', 'id_phieu_mua_sam', 'ts_phieu_mua_sam', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_ts_ct_phieu_nhap_hang-id_ct_phieu_mua_sam', 'ts_ct_phieu_nhap_hang', 'id_ct_phieu_mua_sam', 'ts_ct_phieu_mua_sam', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign keys first
        $this->dropForeignKey('fk_ts_ct_phieu_nhap_hang-id_phieu_mua_sam', 'ts_ct_phieu_nhap_hang');
        $this->dropForeignKey('fk_ts_ct_phieu_nhap_hang-id_ct_phieu_mua_sam', 'ts_ct_phieu_nhap_hang');

        $this->dropTable('ts_ct_phieu_nhap_hang');
    }

    /*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
echo "m240608_144012_create_table_ts_ct_phieu_nhap_hang cannot be reverted.\n";

return false;
}
 */
}
