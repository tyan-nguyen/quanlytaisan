<?php

use yii\db\Migration;

/**
 * Class m240507_125934_create_table_ts_ke_hoach_bao_tri
 */
class m240507_125934_create_table_ts_ke_hoach_bao_tri extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_ke_hoach_bao_tri', [
            'id' => $this->primaryKey(),
            'id_he_thong' => $this->integer(),
            'id_thiet_bi' => $this->integer(),
            'id_chi_tiet' => $this->integer(),
            'ten_cong_viec' => $this->string(),
            'id_loai_bao_tri' => $this->integer(),
            'ngay_bao_tri_cuoi' => $this->date(),
            'bao_truoc' => $this->integer(),
            'can_cu' => $this->text(),
            'so_ky' => $this->integer(),
            'ky_bao_tri' => $this->string(),
            'id_don_vi_bao_tri' => $this->integer(),
            'id_nguoi_chiu_trach_nhiem' => $this->integer(),
            'muc_do_uu_tien' => $this->string(),
            'truc_thuoc' => $this->integer(),
            'thoi_gian_thuc_hien' => $this->integer(),
            'don_vi_thoi_gian' => $this->string(),
            'dung_may' => $this->boolean(),
            'thue_ngoai' => $this->boolean(),
            'da_het_hieu_luc' => $this->boolean(),
            'ngay_het_hieu_luc' => $this->date(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
            'ngay_thuc_hien' => $this->date(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_thiet_bi
        $this->addForeignKey(
            'fk-ts_ke_hoach_bao_tri-id_thiet_bi',
            'ts_ke_hoach_bao_tri',
            'id_thiet_bi',
            'ts_thiet_bi',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_loai_bao_tri
        $this->addForeignKey(
            'fk-ts_ke_hoach_bao_tri-id_loai_bao_tri',
            'ts_ke_hoach_bao_tri',
            'id_loai_bao_tri',
            'ts_loai_bao_tri',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_bo_phan
        $this->addForeignKey(
            'fk-ts_ke_hoach_bao_tri-id_don_vi_bao_tri',
            'ts_ke_hoach_bao_tri',
            'id_don_vi_bao_tri',
            'ts_bo_phan',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_nhan_vien
        $this->addForeignKey(
            'fk-ts_ke_hoach_bao_tri-id_nguoi_chiu_trach_nhiem',
            'ts_ke_hoach_bao_tri',
            'id_nguoi_chiu_trach_nhiem',
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
            'fk-ts_ke_hoach_bao_tri-id_nguoi_chiu_trach_nhiem',
            'ts_ke_hoach_bao_tri'
        );

        $this->dropForeignKey(
            'fk-ts_ke_hoach_bao_tri-id_don_vi_bao_tri',
            'ts_ke_hoach_bao_tri'
        );

        $this->dropForeignKey(
            'fk-ts_ke_hoach_bao_tri-id_loai_bao_tri',
            'ts_ke_hoach_bao_tri'
        );

        $this->dropForeignKey(
            'fk-ts_ke_hoach_bao_tri-id_thiet_bi',
            'ts_ke_hoach_bao_tri'
        );

        $this->dropTable('ts_ke_hoach_bao_tri');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_125934_create_table_ts_ke_hoach_bao_tri cannot be reverted.\n";

        return false;
    }
    */
}
