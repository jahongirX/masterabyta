<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%searchindex}}`.
 */
class m250206_190735_create_searchindex_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%searchindex}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->notNull(),
            'text' => $this->string(255),
            'page_name' => $this->string(255),
            'page_alias' => $this->string(255),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%searchindex}}');
    }
}
