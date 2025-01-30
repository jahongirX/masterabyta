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
                $schema = Yii::$app->db->schema->getTableSchema($tableName ,true);
                if (!empty($schema) && is_object($schema)) {
                    if (!empty($schema->columns) && is_array($schema->columns)) {
                        if (!empty($schema->columns['id']) && is_object($schema->columns['id'])) {
                            if (!empty($schema->columns['id']->autoIncrement)) {
                                // $id = (int) Yii::$app->db->createCommand("SELECT id FROM {$tableName} ORDER BY id DESC LIMIT(1)")->queryScalar(); // PostgreSQL
                                $id = (int) Yii::$app->db->createCommand("SELECT id FROM {$tableName} ORDER BY id DESC LIMIT 1")->queryScalar(); // MySQL
                                if (!empty($id)) {
                                    $id++;
                                    $tableNameSequence = $tableName . '_id_seq';
                                    // Yii::$app->db->createCommand("ALTER SEQUENCE {$tableNameSequence} RESTART WITH {$id}")->execute(); // PostgreSQL
                                    Yii::$app->db->createCommand("ALTER TABLE {$tableName} AUTO_INCREMENT = {$id}")->execute(); // MySQL
                                }
                            }
                        }
                    }
                }
            }
        }
        return false;
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
