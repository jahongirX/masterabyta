<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blocktechnical}}`.
 */
class m230923_160941_create_blocktechnical_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blocktechnical}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull(),
            'header' => $this->string(255),
            'subtitle' => $this->string(255),
            'image' => $this->string(255),
            'item' => $this->text(),
            'button' => $this->string(255),
            'note' => $this->text(),
            'form' => $this->text(),
            'menu1' => $this->integer(11)->unsigned(),
            'menu2' => $this->integer(11)->unsigned(),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blocktechnical}}');
    }
}
