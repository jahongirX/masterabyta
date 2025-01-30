<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230923_161331_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'email' => $this->string(255)->notNull()->unique(),
            'role' => $this->tinyInteger(2)->unsigned()->notNull(),
            'password' => $this->string(255)->append('CHARACTER SET utf8 COLLATE utf8_bin NOT NULL'),   // MySQL
            'auth_key' => $this->string(255)->append('CHARACTER SET utf8 COLLATE utf8_bin UNIQUE'),     // MySQL
            // 'password' => $this->string(255)->append('COLLATE "C" NOT NULL'),   // PostgreSQL
            // 'auth_key' => $this->string(255)->append('COLLATE "C" UNIQUE'),     // PostgreSQL
            'ban' => $this->tinyInteger(1)->unsigned()->defaultValue(0)->notNull(),
            'date_reg' => $this->integer(11)->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
