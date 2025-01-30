<?php

use yii\db\Migration;

/**
 * Class m981108_234537_insert_data
 */
class m981108_234537_insert_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $res = 0;
        $filename = Yii::getAlias('@app') . DIRECTORY_SEPARATOR .'migrations' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'export-2024-02-27.txt';
        if (!empty($filename) && file_exists($filename)) {
            $data = file_get_contents($filename);
            if (!empty($data)) {
                $data = str_replace('profivdom.ru', 'egdu.ru', $data);
                $data = str_replace('profivdom', 'egdu', $data);
                $data = str_replace('Профи в дом', 'Единая Городская диспетчерская', $data);
                $data = json_decode($data, true);
                if (!empty($data) && is_array($data)) {
                    foreach ($data as $tableName => $tableData) {
                        if (!empty($tableData[0])) {
                            $tableAttributes = array_keys($tableData[0]);
                            $tableData_chunk = array_chunk($tableData, 50);
                            $tableData_chunk_count = count($tableData_chunk);
                            for ($i=0; $i < $tableData_chunk_count; $i++) { 
                                $rows = array();
                                if (!empty($tableData_chunk[$i]) && is_array($tableData_chunk[$i])) {
                                    $tableData_chunk_item_count = count($tableData_chunk[$i]);
                                    for ($u=0; $u < $tableData_chunk_item_count; $u++) { 
                                        $rows[] = array_values($tableData_chunk[$i][$u]);
                                    }
                                }
                                if (!empty($rows)) {
                                    $this->batchInsert($tableName, $tableAttributes, $rows);
                                    $res++;
                                }
                            }
                        }
                    }
                }
            }
        }
        if ($res > 0) {
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m981108_234537_insert_data cannot be reverted.\n";

        return false;
    }
}
