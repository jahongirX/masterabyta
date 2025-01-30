<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%redirect}}`.
 */
class m230923_161202_create_redirect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%redirect}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'from_url' => $this->string(255)->notNull(),
            'to_url' => $this->string(255)->notNull(),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%redirect}}');
    }
}
