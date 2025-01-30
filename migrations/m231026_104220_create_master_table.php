<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%master}}`.
 */
class m231026_104220_create_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%master}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull(),
            'image' => $this->string(255),
            'projects' => $this->string(255),
            'experience' => $this->string(255),
            'age' => $this->string(255),
            'specialization' => $this->string(255),
            'in_company' => $this->string(255),
            'about' => $this->text(),
            'number' => $this->integer(11)->unsigned()->defaultValue(1),
            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%master}}');
    }
}
