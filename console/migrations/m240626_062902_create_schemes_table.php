<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%schemes}}`.
 */
class m240626_062902_create_schemes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schemes}}', [
            'id' => $this->primaryKey(),
            'ref' => $this->string(50)->notNull()->unique(),
            'type' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%schemes}}');
    }
}
