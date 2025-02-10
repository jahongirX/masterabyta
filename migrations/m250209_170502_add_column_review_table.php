<?php

use yii\db\Migration;

/**
 * Class m250209_170502_add_column_review_table
 */
class m250209_170502_add_column_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('review' , 'user_image', $this->string());
        $this->addColumn('review' , 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('review' , 'user_image');
        $this->dropColumn('review' , 'image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250209_170502_add_column_review_table cannot be reverted.\n";

        return false;
    }
    */
}
