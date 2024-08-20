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
            'name' => $this->string(255)->notNull(),
            'model_or_part_number' => $this->string(50),
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
