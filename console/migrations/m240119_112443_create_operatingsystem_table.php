<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%operatingsystem}}`.
 */
class m240119_112443_create_operatingsystem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%operatingsystem}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%operatingsystem}}');
    }
}
