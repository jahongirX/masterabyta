<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m230923_161013_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull()->unique(),
            'alias' => $this->string(255)->notNull()->unique(),
            'params' => $this->text(),
            'map' => $this->text(),

            'address' => $this->string(255),
            'front_email' => $this->string(255),
            'phone' => $this->string(255),
            'wokrtime' => $this->string(255),

            'price_type' => $this->tinyInteger(3)->unsigned()->defaultValue(2)->notNull(),
            'back_email' => $this->string(255),
            'district' => $this->text(),
            'street' => $this->text(),
            'shortcode_remont' => $this->text(),

            'tag_header' => $this->text(),
            'tag_body' => $this->text(),
            'robots_txt' => $this->text(),
            'number' => $this->integer(11)->unsigned()->defaultValue(1),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
