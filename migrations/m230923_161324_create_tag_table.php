<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tag}}`.
 */
class m230923_161324_create_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull(),
            'disposition' => $this->tinyInteger(3)->unsigned()->notNull(),
            'text' => $this->text(),
            'city' => $this->text(),
            'number' => $this->tinyInteger(3)->unsigned()->defaultValue(1)->notNull(),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tag}}');
    }
}
