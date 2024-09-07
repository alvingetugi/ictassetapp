<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rapscheduletypes}}`.
 */
class m240715_062923_create_rapscheduletypes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rapscheduletypes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rapscheduletypes}}');
    }
}
