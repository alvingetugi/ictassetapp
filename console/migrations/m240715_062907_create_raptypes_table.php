<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%raptypes}}`.
 */
class m240715_062907_create_raptypes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%raptypes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%raptypes}}');
    }
}
