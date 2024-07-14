<?php

use yii\db\Migration;

/**
 * Class m240711_153508_create_ts_ct_bao_gia_mua_sam_vt
 */
class m240711_153508_create_ts_ct_bao_gia_mua_sam_vt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_ct_bao_gia_mua_sam_vt', [
            'id' => $this->primaryKey(),
            'id_bao_gia' => $this->integer()->notNull(),
            'id_ct_phieu_mua_sam' => $this->integer()->notNull(),
            'hang_san_xuat' => $this->text(),
            'so_luong' => $this->integer(),
            'ghi_chu' => $this->text(),
            'don_gia' => $this->decimal(10, 2),
            'thanh_tien' => $this->decimal(10, 2),
            'nguoi_tao' => $this->integer(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_cap_nhat' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_bao_gia_mua_sam
        $this->addForeignKey(
            'fk-ts_ct_bao_gia_mua_sam_vt-id_bao_gia',
            'ts_ct_bao_gia_mua_sam_vt',
            'id_bao_gia',
            'ts_bao_gia_mua_sam',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_ct_phieu_mua_sam
        $this->addForeignKey(
            'fk-ts_ct_bao_gia_mua_sam_vt-id_ct_phieu_mua_sam',
            'ts_ct_bao_gia_mua_sam_vt',
            'id_ct_phieu_mua_sam',
            'ts_ct_phieu_mua_sam',
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
            'fk-ts_ct_bao_gia_mua_sam_vt-id_bao_gia',
            'ts_ct_bao_gia_mua_sam_vt'
        );

        $this->dropForeignKey(
            'fk-ts_ct_bao_gia_mua_sam_vt-id_ct_phieu_mua_sam',
            'ts_ct_bao_gia_mua_sam_vt'
        );

        $this->dropTable('ts_ct_bao_gia_mua_sam_vt');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_153508_create_ts_ct_bao_gia_mua_sam_vt cannot be reverted.\n";

        return false;
    }
    */
}
