<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assetmakes}}`.
 */
class m240119_110740_create_assetmakes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assetmakes}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'categoryID' => $this->integer()->notNull(),
        ]);

        //creates index for column assetcategory
        $this->createIndex(
            '{{%idx-assetmakes-categoryID}}',
            '{{%assetmakes}}',
            'categoryID'
        );

        //adds foreign key for table {{assetcategories}}
        $this->addForeignKey(
            '{{%fk-assetmakes-categoryID}}',
            '{{%assetmakes}}',
            'categoryID',
            '{{%assetcategories}}',
            'id',
            'CASCADE'
        );
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%assetcategories}}`
        $this->dropForeignKey(
            '{{%fk-assetmakes-categoryID}}',
            '{{%assetmakes}}'
        );

        // drops the index for column categoryID
        $this->dropIndex(
            '{{%idx-assetmakes-categoryID}}',
            '{{%assetmakes}}'
        );

        $this->dropTable('{{%assetmakes}}');
    }
}
