<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%leed}}`.
 */
class m250214_131116_create_leed_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%leed}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'message' => $this->text()->notNull(),
            'phone' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            'visible' => $this->integer()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%leed}}');
    }
}
