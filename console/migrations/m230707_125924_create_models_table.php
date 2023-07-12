<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%models}}`.
 */
class m230707_125924_create_models_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%models}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'category_id' => $this->string(50)->notNull(),
            'make_id' => $this->string(50)->notNull(),            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%models}}');
    }
}
