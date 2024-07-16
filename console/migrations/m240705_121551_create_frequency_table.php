<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%frequency}}`.
 */
class m240705_121551_create_frequency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%frequency}}', [
            'id' => $this->primaryKey(),
            'ref' => $this->string(50)->notNull()->unique(),
            'frequency' => $this->string(50)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%frequency}}');
    }
}
