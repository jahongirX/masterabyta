<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pricetablehtml}}`.
 */
class m230923_161150_create_pricetablehtml_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pricetablehtml}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull(),
            'header' => $this->string(255),
            'price' => $this->text(),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pricetablehtml}}');
    }
}
