<?php

use yii\db\Migration;

/**
 * Class m240426_075023_create_table_ts_thiet_bi
 */
class m240426_075023_create_table_ts_thiet_bi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_thiet_bi', [
            'id' => $this->primaryKey(),
            'autoid' => $this->integer()->notNull(),
            'ma_thiet_bi' => $this->string()->notNull(),
            'id_vi_tri' => $this->integer(),
            'id_he_thong' => $this->integer(),
            'id_loai_thiet_bi' => $this->integer(),
            'id_bo_phan_quan_ly' => $this->integer(),
            'ten_thiet_bi' => $this->string(),
            'id_thiet_bi_cha' => $this->integer(),
            'id_layout' => $this->integer(),
            'nam_san_xuat' => $this->integer(),
            'serial' => $this->string(),
            'model' => $this->string(),
            'xuat_xu' => $this->string(),
            'id_hang_bao_hanh' => $this->integer(),
            'id_nhien_lieu' => $this->integer(),
            'dac_tinh_ky_thuat' => $this->text(),
            'id_lop_hu_hong' => $this->integer(),
            'id_trung_tam_chi_phi' => $this->integer(),
            'id_don_vi_bao_tri' => $this->integer(),
            'id_nguoi_quan_ly' => $this->integer(),
            'ngay_mua' => $this->date(),
            'han_bao_hanh' => $this->date(),
            'ngay_dua_vao_su_dung' => $this->date(),
            'trang_thai' => $this->string(),
            'ngay_ngung_hoat_dong' => $this->date(),
            'ghi_chu' => $this->text(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_bo_phan
        $this->addForeignKey(
            'fk-ts_thiet_bi-id_bo_phan_quan_ly',
            'ts_thiet_bi',
            'id_bo_phan_quan_ly',
            'ts_bo_phan',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_loai_thiet_bi
        $this->addForeignKey(
            'fk-ts_thiet_bi-id_loai_thiet_bi',
            'ts_thiet_bi',
            'id_loai_thiet_bi',
            'ts_loai_thiet_bi',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_nhan_vien
        $this->addForeignKey(
            'fk-ts_thiet_bi-id_nguoi_quan_ly',
            'ts_thiet_bi',
            'id_nguoi_quan_ly',
            'ts_nhan_vien',
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
            'fk-ts_thiet_bi-id_bo_phan_quan_ly',
            'ts_thiet_bi'
        );

        $this->dropForeignKey(
            'fk-ts_thiet_bi-id_loai_thiet_bi',
            'ts_thiet_bi'
        );

        $this->dropForeignKey(
            'fk-ts_thiet_bi-id_nguoi_quan_ly',
            'ts_thiet_bi'
        );
        $this->dropTable('ts_thiet_bi');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_075023_create_table_ts_thiet_bi cannot be reverted.\n";

        return false;
    }
    */
}
