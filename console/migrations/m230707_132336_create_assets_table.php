<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assets}}`.
 */
class m230707_132336_create_assets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assets}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'category' => $this->string(50)->notNull(),
            'make' => $this->string(50)->notNull(),
            'model' => $this->string(50)->notNull(),
            'name' => $this->string(255)->notNull(),
            'serial_number' => $this->string(50)->notNull()->unique(),
            'tag_number' => $this->string(50)->notNull()->unique(),
            'details' => $this->text(),
            'date_of_delivery' => $this->integer()->notNull()->defaultValue(0),
            'location' => $this->string(255)->notNull(),
            'status' => $this->tinyInteger(2)->notNull(),
            'condition' => $this->tinyInteger(2)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%assets}}');
    }
}
