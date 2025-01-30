<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price}}`.
 */
class m230923_161139_create_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull(),
            'price_section' => $this->integer(11)->unsigned(),
            'unit' => $this->string(255),
            'price_msk' => $this->decimal(10,2)->unsigned()->defaultValue(0)->notNull(),
            'price_region' => $this->decimal(10,2)->unsigned()->defaultValue(0)->notNull(),
            'link' => $this->string(255),
            'number' => $this->integer(11)->unsigned()->defaultValue(1)->notNull(),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%price}}');
    }
}
