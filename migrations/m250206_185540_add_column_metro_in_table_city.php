<?php

use yii\db\Migration;

/**
 * Class m250206_185540_add_column_metro_in_table_city
 */
class m250206_185540_add_column_metro_in_table_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('city' , 'metro' , $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('city' , 'metro');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250206_185540_add_column_metro_in_table_city cannot be reverted.\n";

        return false;
    }
    */
}
