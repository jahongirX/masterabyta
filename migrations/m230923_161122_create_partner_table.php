<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partner}}`.
 */
class m230923_161122_create_partner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partner}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull(),
            'params' => $this->text(),

            'phone' => $this->string(255),
            'front_email' => $this->string(255),
            'back_email' => $this->string(255)->notNull(),
            'mail_subject' => $this->string(255),
            'wokrtime' => $this->string(255),
            'tag_header' => $this->text(),
            'tag_body' => $this->text(),
            'city' => $this->text(),
            'page' => $this->text(),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partner}}');
    }
}
