<?php

use yii\db\Migration;

/**
 * Class m991108_234537_update_auto_increments
 */
class m991108_234537_update_auto_increments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableNames = Yii::$app->db->getSchema()->tableNames;

        if (!empty($tableNames) && is_array($tableNames)) {
            foreach ($tableNames as $tableName) {
                $schema = Yii::$app->db->schema->getTableSchema($tableName, true);

                if ($schema && isset($schema->columns['id']) && $schema->columns['id']->autoIncrement) {
                    $quotedTableName = Yii::$app->db->quoteTableName($tableName);
                    $id = (int) Yii::$app->db->createCommand("SELECT id FROM {$quotedTableName} ORDER BY id DESC LIMIT 1")->queryScalar();

                    if ($id > 0) {
                        $id++;
                        Yii::$app->db->createCommand("ALTER TABLE {$quotedTableName} AUTO_INCREMENT = {$id}")->execute();
                    }
                }
            }
        }

        return true;
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231105_200737_update_auto_increments cannot be reverted.\n";

        return false;
    }
}
