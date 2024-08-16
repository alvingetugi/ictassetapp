<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storage}}`.
 */
class m240119_112441_create_storage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%storage}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%storage}}');
    }
}
