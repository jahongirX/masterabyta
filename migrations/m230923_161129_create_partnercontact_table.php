<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partnercontact}}`.
 */
class m230923_161129_create_partnercontact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partnercontact}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'partner_id' => $this->integer(11)->unsigned()->notNull(),
            'name' => $this->string(255),
            'phone' => $this->string(255),
            'token_cpa_rukiizplech' => $this->string(255),
            'token_cpa_servicelead' => $this->string(255),
            'offer_id_cpa_servicelead' => $this->integer(11)->unsigned(),
            'thread_id_cpa_servicelead' => $this->integer(11)->unsigned(),
            'token_cpa_leadcentre' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partnercontact}}');
    }
}
