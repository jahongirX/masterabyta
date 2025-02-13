<?php

use yii\db\Migration;

/**
 * Class m250213_093625_add_column_news_table
 */
class m250213_093625_add_column_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', ' slug' , $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'slug');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250213_093625_add_column_news_table cannot be reverted.\n";

        return false;
    }
    */
}
