<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%maintenance}}`.
 */
class m240219_115441_create_maintenance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%maintenance}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%maintenance}}');
    }
}
