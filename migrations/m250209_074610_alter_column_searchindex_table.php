<?php

use yii\db\Migration;

/**
 * Class m250209_074610_alter_column_searchindex_table
 */
class m250209_074610_alter_column_searchindex_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('searchindex' , 'text' , $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250209_074610_alter_column_searchindex_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250209_074610_alter_column_searchindex_table cannot be reverted.\n";

        return false;
    }
    */
}
