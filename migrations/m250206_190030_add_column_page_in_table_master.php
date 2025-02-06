<?php

use yii\db\Migration;

/**
 * Class m250206_190030_add_column_page_in_table_master
 */
class m250206_190030_add_column_page_in_table_master extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('master', 'page' , $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('master' , 'page');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250206_190030_add_column_page_in_table_master cannot be reverted.\n";

        return false;
    }
    */
}
