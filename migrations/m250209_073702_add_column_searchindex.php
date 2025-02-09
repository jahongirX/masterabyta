<?php

use yii\db\Migration;

/**
 * Class m250209_073702_add_column_searchindex
 */
class m250209_073702_add_column_searchindex extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('searchindex' , 'page_visible' , $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250209_073702_add_column_searchindex cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250209_073702_add_column_searchindex cannot be reverted.\n";

        return false;
    }
    */
}
