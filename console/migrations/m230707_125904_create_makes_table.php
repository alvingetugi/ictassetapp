<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%makes}}`.
 */
class m230707_125904_create_makes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%makes}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'category_id' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {        
        $this->dropTable('{{%makes}}');
    }
}
