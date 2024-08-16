<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%accessorylist}}`.
 */
class m240119_112444_create_accessorylist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%accessorylist}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(255)->notNull()->unique(),
            'tag_number' => $this->string(50)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {        
        $this->dropTable('{{%accessorylist}}');
    }
}
