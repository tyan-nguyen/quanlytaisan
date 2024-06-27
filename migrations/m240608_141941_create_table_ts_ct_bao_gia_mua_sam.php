<?php

use yii\db\Migration;

/**
 * Class m240608_141941_create_table_ts_ct_bao_gia_mua_sam
 */
class m240608_141941_create_table_ts_ct_bao_gia_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_ct_bao_gia_mua_sam', [
            'id' => $this->primaryKey(),
            'id_bao_gia' => $this->integer()->notNull(),
            'id_ct_phieu_mua_sam' => $this->integer()->notNull(),
            'nam_san_xuat' => $this->integer(),
            'model' => $this->string(),
            'xuat_xu' => $this->string(),
            'dac_tinh_ky_thuat' => $this->text(),
            'han_bao_hanh' => $this->integer(),
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
            'fk-ts_ct_bao_gia_mua_sam-id_bao_gia',
            'ts_ct_bao_gia_mua_sam',
            'id_bao_gia',
            'ts_bao_gia_mua_sam',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_ct_phieu_mua_sam
        $this->addForeignKey(
            'fk-ts_ct_bao_gia_mua_sam-id_ct_phieu_mua_sam',
            'ts_ct_bao_gia_mua_sam',
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
            'fk-ts_ct_bao_gia_mua_sam-id_bao_gia',
            'ts_ct_bao_gia_mua_sam'
        );

        $this->dropForeignKey(
            'fk-ts_ct_bao_gia_mua_sam-id_ct_phieu_mua_sam',
            'ts_ct_bao_gia_mua_sam'
        );

        $this->dropTable('ts_ct_bao_gia_mua_sam');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240608_141941_create_table_ts_ct_bao_gia_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
