<?php

use yii\db\Migration;

/**
 * Class m240507_133739_create_table_ts_bao_gia_sua_chua
 */
class m240507_133739_create_table_ts_bao_gia_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_bao_gia_sua_chua', [
            'id' => $this->primaryKey(),
            'id_phieu_sua_chua' => $this->integer()->notNull(),
            'so_bao_gia' => $this->integer()->defaultValue(0),
            'flag_index' => $this->smallInteger()->defaultValue(0),
            'ngay_bao_gia' => $this->datetime(),
            'ngay_ket_thuc' => $this->datetime(),
            'ngay_gui_bg' => $this->datetime(),
            'trang_thai' => $this->string(),
            'phi_linh_kien' => $this->decimal(10, 2),
            'phi_khac' => $this->decimal(10, 2),
            'tong_tien' => $this->decimal(10, 2),
            'ghi_chu_bg1' => $this->text(),
            'ghi_chu_bg2' => $this->text(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
            'nguoi_cap_nhat' => $this->integer(),
            'nguoi_duyet_bg' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_phieu_sua_chua
        $this->addForeignKey(
            'fk-ts_bao_gia_sua_chua-id_phieu_sua_chua',
            'ts_bao_gia_sua_chua',
            'id_phieu_sua_chua',
            'ts_phieu_sua_chua',
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
            'fk-ts_bao_gia_sua_chua-id_phieu_sua_chua',
            'ts_bao_gia_sua_chua'
        );

        $this->dropTable('ts_bao_gia_sua_chua');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_133739_create_table_ts_bao_gia_sua_chua cannot be reverted.\n";

        return false;
    }
    */
}
