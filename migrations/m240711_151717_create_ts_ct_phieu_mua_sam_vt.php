<?php

use yii\db\Migration;

/**
 * Class m240711_151717_create_ts_ct_phieu_mua_sam_vt
 */
class m240711_151717_create_ts_ct_phieu_mua_sam_vt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_ct_phieu_mua_sam_vt', [
            'id' => $this->primaryKey(),
            'id_phieu_mua_sam' => $this->integer()->notNull(),
            'ten_vat_tu' => $this->string()->notNull(),
            'id_kho' => $this->integer()->notNull(),
            'hang_san_xuat' => $this->string(),
            'so_luong' => $this->integer(),
            'trang_thai' => $this->string()->defaultValue("draf"),
            'ghi_chu' => $this->text(),
            'nguoi_tao' => $this->integer(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_cap_nhat' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_phieu_mua_sam
        $this->addForeignKey(
            'fk-ts_ct_phieu_mua_sam_vt-id_phieu_mua_sam',
            'ts_ct_phieu_mua_sam_vt',
            'id_phieu_mua_sam',
            'ts_phieu_mua_sam',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_loai_thiet_bi
        $this->addForeignKey(
            'fk-ts_ct_phieu_mua_sam_vt-id_kho',
            'ts_ct_phieu_mua_sam_vt',
            'id_kho',
            'ts_kho_luu_tru',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Xóa khóa ngoại trước khi xóa bảng
        $this->dropForeignKey(
            'fk-ts_ct_phieu_mua_sam_vt-id_phieu_mua_sam',
            'ts_ct_phieu_mua_sam_vt'
        );

        $this->dropForeignKey(
            'fk-ts_ct_phieu_mua_sam_vt-id_kho',
            'ts_ct_phieu_mua_sam_vt'
        );

        $this->dropTable('ts_ct_phieu_mua_sam_vt');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_151717_create_ts_ct_phieu_mua_sam_vt cannot be reverted.\n";

        return false;
    }
    */
}
