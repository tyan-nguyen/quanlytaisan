<?php

use yii\db\Migration;

/**
 * Class m240514_164146_create_table_ts_yeu_cau_van_hanh
 */
class m240514_164146_create_table_ts_yeu_cau_van_hanh extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_yeu_cau_van_hanh', [
            'id' => $this->primaryKey(),
            'id_nguoi_lap' => $this->integer()->notNull(),
            'id_nguoi_yeu_cau' => $this->integer()->null(),
            'id_nguoi_gui' => $this->integer()->null(),
            'id_nguoi_duyet' => $this->integer()->null(),
            'id_nguoi_xuat' => $this->integer()->null(),
            'id_nguoi_nhan' => $this->integer()->null(),

            'id_bo_phan_quan_ly' => $this->integer()->null(),
            'cong_trinh' => $this->string()->null(),

            'ngay_lap' => $this->dateTime(),
            'ngay_gui' => $this->dateTime()->null(),
            'ngay_duyet' => $this->dateTime()->null(),
            'ngay_xuat' => $this->dateTime()->null(),
            'ngay_nhan' => $this->dateTime()->null(),

            'ly_do' => $this->string()->null(),
            'hieu_luc' => $this->string()->null(),

            'noi_dung_lap' => $this->string()->null(),
            'noi_dung_gui' => $this->string()->null(),
            'noi_dung_duyet' => $this->string()->null(),
            'noi_dung_xuat' => $this->string()->null(),
            'noi_dung_nhan' => $this->string()->null(),
            'dia_diem' => $this->string()->null(),

            'created_at' => $this->datetime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->datetime()->null(),
            'deleted_at' => $this->datetime()->null(),
        ]);

        // Add foreign keys with appropriate ON DELETE and ON UPDATE actions
        $this->addForeignKey(
            'fk_yeu_cau_van_hanh_nguoi_lap',
            'ts_yeu_cau_van_hanh',
            'id_nguoi_lap',
            'ts_nhan_vien',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_yeu_cau_van_hanh_nguoi_yeu_cau',
            'ts_yeu_cau_van_hanh',
            'id_nguoi_yeu_cau',
            'ts_nhan_vien',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_yeu_cau_van_hanh_nguoi_gui',
            'ts_yeu_cau_van_hanh',
            'id_nguoi_gui',
            'ts_nhan_vien',
            'id',
            'RESTRICT',
            'CASCADE'
            );

        $this->addForeignKey(
            'fk_yeu_cau_van_hanh_nguoi_duyet',
            'ts_yeu_cau_van_hanh',
            'id_nguoi_duyet',
            'ts_nhan_vien',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_yeu_cau_van_hanh_nguoi_xuat',
            'ts_yeu_cau_van_hanh',
            'id_nguoi_xuat',
            'ts_nhan_vien',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_yeu_cau_van_hanh_nguoi_nhan',
            'ts_yeu_cau_van_hanh',
            'id_nguoi_nhan',
            'ts_nhan_vien',
            'id',
            'RESTRICT',
            'CASCADE'
        );


        $this->addForeignKey(
            'fk_yeu_cau_van_hanh_bo_phan_quan_ly',
            'ts_yeu_cau_van_hanh',
            'id_bo_phan_quan_ly',
            'ts_bo_phan',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m240514_164146_create_table_ts_yeu_cau_van_hanh cannot be reverted.\n";

        $this->dropForeignKey('fk_yeu_cau_van_hanh_nguoi_lap', 'ts_yeu_cau_van_hanh');
        $this->dropForeignKey('fk_yeu_cau_van_hanh_nguoi_yeu_cau', 'ts_yeu_cau_van_hanh');
        $this->dropForeignKey('fk_yeu_cau_van_hanh_nguoi_gui', 'ts_yeu_cau_van_hanh');
        $this->dropForeignKey('fk_yeu_cau_van_hanh_nguoi_duyet', 'ts_yeu_cau_van_hanh');
        $this->dropForeignKey('fk_yeu_cau_van_hanh_nguoi_xuat', 'ts_yeu_cau_van_hanh');
        $this->dropForeignKey('fk_yeu_cau_van_hanh_nguoi_nhan', 'ts_yeu_cau_van_hanh');
        $this->dropForeignKey('fk_yeu_cau_van_hanh_bo_phan_quan_ly', 'ts_bo_phan');

        $this->dropTable('ts_yeu_cau_van_hanh');
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240514_164146_create_table_ts_yeu_cau_van_hanh cannot be reverted.\n";

        return false;
    }
    */
}
