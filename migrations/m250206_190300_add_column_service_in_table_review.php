<?php

use yii\db\Migration;

/**
 * Class m250206_190300_add_column_service_in_table_review
 */
class m250206_190300_add_column_service_in_table_review extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('review' , 'service' , $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('review' , 'service');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250206_190300_add_column_service_in_table_review cannot be reverted.\n";

        return false;
    }
    */
}
