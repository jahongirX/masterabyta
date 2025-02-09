<?php

use yii\db\Migration;

/**
 * Class m250209_101720_add_column_page
 */
class m250209_101720_add_column_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('page' , 'content_three' , $this->text());
        $this->addColumn('page' , 'content_three_on' , $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('page' , 'content_three');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250209_101720_add_column_page cannot be reverted.\n";

        return false;
    }
    */
}
