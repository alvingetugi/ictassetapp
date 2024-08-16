<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assetcategories}}`.
 */
class m240119_110646_create_assetcategories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assetcategories}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%assetcategories}}');
    }
}
