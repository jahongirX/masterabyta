<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banner}}`.
 */
class m231026_194704_create_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull()->unique(),
            'header' => $this->string(255),
            'use_page_header' => $this->tinyInteger(1)->unsigned()->defaultValue(0)->notNull(),
            'subtitle' => $this->string(255),
            'image' => $this->string(255),
            'item1' => $this->string(255),
            'item2' => $this->string(255),
            'item3' => $this->string(255),
            'item4' => $this->string(255),
            'ico1' => $this->string(255),
            'ico2' => $this->string(255),
            'ico3' => $this->string(255),
            'ico4' => $this->string(255),
            'item' => $this->text(),
            'form' => $this->text(),
            'button' => $this->string(255),
            'note' => $this->text(),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banner}}');
    }
}
