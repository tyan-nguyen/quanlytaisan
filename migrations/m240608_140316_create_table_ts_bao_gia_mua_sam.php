<?php

use yii\db\Migration;

/**
 * Class m240608_140316_create_table_ts_bao_gia_mua_sam
 */
class m240608_140316_create_table_ts_bao_gia_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_bao_gia_mua_sam', [
            'id' => $this->primaryKey(),
            'id_phieu_mua_sam' => $this->integer()->notNull(),
            'so_bao_gia' => $this->integer()->defaultValue(0),
            'flag_index' => $this->integer()->defaultValue(0),
            'ngay_bao_gia' => $this->date(),
            'ngay_ket_thuc' => $this->date(),
            'ngay_gui_bg' => $this->date(),
            'trang_thai' => $this->string()->defaultValue('draft'),
            'tong_tien' => $this->decimal(10, 2),
            'ghi_chu_bg1' => $this->text(),
            'ghi_chu_bg2' => $this->text(),
            'nguoi_tao' => $this->integer(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_cap_nhat' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
            'nguoi_duyet_bg' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_phieu_mua_sam
        $this->addForeignKey(
            'fk-ts_bao_gia_mua_sam-id_phieu_mua_sam',
            'ts_bao_gia_mua_sam',
            'id_phieu_mua_sam',
            'ts_phieu_mua_sam',
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
            'fk-ts_bao_gia_mua_sam-id_phieu_mua_sam',
            'ts_bao_gia_mua_sam'
        );

        $this->dropTable('ts_bao_gia_mua_sam');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240608_140316_create_table_ts_bao_gia_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
