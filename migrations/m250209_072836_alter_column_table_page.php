<?php

use yii\db\Migration;

/**
 * Class m250209_072836_alter_column_table_page
 */
class m250209_072836_alter_column_table_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('page' , 'date_create' , $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250209_072836_alter_column_table_page cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250209_072836_alter_column_table_page cannot be reverted.\n";

        return false;
    }
    */
}
