<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ram}}`.
 */
class m240119_112442_create_ram_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ram}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ram}}');
    }
}
