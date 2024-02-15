<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assetstatus}}`.
 */
class m240215_135908_create_assetstatus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assetstatus}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(50)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%assetstatus}}');
    }
}
