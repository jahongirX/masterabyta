<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m230923_161208_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'phone' => $this->string(255),
            'city' => $this->integer(11)->unsigned(),
            'page' => $this->integer(11)->unsigned(),
            'partner' => $this->integer(11)->unsigned(),
            'rukiizplech_code' => $this->smallInteger(5)->unsigned(),
            'servicelead_code' => $this->smallInteger(5)->unsigned(),
            'leadcentre_code' => $this->smallInteger(5)->unsigned(),
            'date' => $this->integer(11)->unsigned()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }
}
