<?php

use yii\db\Migration;

/**
 * Class m240507_125934_create_table_ts_ke_hoach_bao_tri
 */
class m240625_125934_alter_table_ts_ke_hoach_bao_tri extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->renameColumn('ts_ke_hoach_bao_tri', 'ngay_bao_tri_cuoi', 'ngay_bat_dau');
    }

    public function down()
    {
        $this->renameColumn('ts_ke_hoach_bao_tri', 'ngay_bat_dau', 'ngay_bao_tri_cuoi' );
    }
    
}
