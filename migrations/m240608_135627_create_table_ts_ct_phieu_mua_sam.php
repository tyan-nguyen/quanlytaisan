<?php

use yii\db\Migration;

/**
 * Class m240608_135627_create_table_ts_ct_phieu_mua_sam
 */
class m240608_135627_create_table_ts_ct_phieu_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_ct_phieu_mua_sam', [
            'id' => $this->primaryKey(),
            'id_phieu_mua_sam' => $this->integer()->notNull(),
            'ten_thiet_bi' => $this->string()->notNull(),
            'id_loai_thiet_bi' => $this->integer()->notNull(),
            'dac_tinh_ky_thuat' => $this->text(),
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
            'fk-ts_ct_phieu_mua_sam-id_phieu_mua_sam',
            'ts_ct_phieu_mua_sam',
            'id_phieu_mua_sam',
            'ts_phieu_mua_sam',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_loai_thiet_bi
        $this->addForeignKey(
            'fk-ts_ct_phieu_mua_sam-id_loai_thiet_bi',
            'ts_ct_phieu_mua_sam',
            'id_loai_thiet_bi',
            'ts_loai_thiet_bi',
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
            'fk-ts_ct_phieu_mua_sam-id_phieu_mua_sam',
            'ts_ct_phieu_mua_sam'
        );

        $this->dropForeignKey(
            'fk-ts_ct_phieu_mua_sam-id_loai_thiet_bi',
            'ts_ct_phieu_mua_sam'
        );

        $this->dropTable('ts_ct_phieu_mua_sam');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240608_135627_create_table_ts_ct_phieu_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
