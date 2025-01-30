<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 */
class m231026_112913_create_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'header' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'master' => $this->integer(11)->unsigned(),
            'rating' => $this->tinyInteger(3)->unsigned(),
            'text' => $this->text(),
            'page' => $this->text(),
            'date' => $this->integer(11)->unsigned(),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%review}}');
    }
}
