<?php

use yii\db\Migration;

/**
 * Class m250206_101645_add_column_in_table_page
 */
class m250206_101645_add_column_in_table_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('page' , 'date_create' , $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('page', 'date_create');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250206_101645_add_column_in_table_page cannot be reverted.\n";

        return false;
    }
    */
}
