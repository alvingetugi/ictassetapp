<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assetmodels}}`.
 */
class m240119_111356_create_assetmodels_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assetmodels}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(255)->notNull()->unique(),
            'categoryID' => $this->integer()->notNull(),
            'makeID' => $this->integer()->notNull(), 
        ]);

        //creates index for column categoryID
        $this->createIndex(
            '{{%idx-assetmodels-categoryID}}',
            '{{%assetmodels}}',
            'categoryID'
        );

        //adds foreign key for table {{assetcategories}}
        $this->addForeignKey(
            '{{%fk-assetmodels-categoryID}}',
            '{{%assetmodels}}',
            'categoryID',
            '{{%assetcategories}}',
            'id',
            'CASCADE'
        );

        //creates index for column makeID
        $this->createIndex(
            '{{%idx-assetmodels-makeID}}',
            '{{%assetmodels}}',
            'makeID'
        );

        //adds foreign key for table {{assetmakes}}
        $this->addForeignKey(
            '{{%fk-assetmodels-makeID}}',
            '{{%assetmodels}}',
            'makeID',
            '{{%assetmakes}}',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%assetcategories}}`
        $this->dropForeignKey(
            '{{%fk-assetmodels-categoryID}}',
            '{{%assetmodels}}'
        );

        // drops the index for column categoryID
        $this->dropIndex(
            '{{%idx-assetmodels-categoryID}}',
            '{{%assetmodels}}'
        );

        // drops the foreign key for table `{{%assetmakes}}`
        $this->dropForeignKey(
            '{{%fk-assetmodels-makeID}}',
            '{{%assetmodels}}'
        );

        // drops the index for column makeID
        $this->dropIndex(
            '{{%idx-assetmodels-makeID}}',
            '{{%assetmodels}}'
        );

        $this->dropTable('{{%assetmodels}}');
    
    }
}
