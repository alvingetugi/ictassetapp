<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assetaccessories}}`.
 */
class m240215_070439_create_assetaccessories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assetaccessories}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'assetID' => $this->integer()->notNull(),
        ]);

        //creates index for column assetID
        $this->createIndex(
            '{{%idx-assetaccessories-assetID}}',
            '{{%assetaccessories}}',
            'assetID'
        );

        //adds foreign key for table {{ictassets}}
        $this->addForeignKey(
            '{{%fk-assetaccessories-assetID}}',
            '{{%assetaccessories}}',
            'assetID',
            '{{%ictassets}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%ictassets}}`
        $this->dropForeignKey(
            '{{%fk-assetaccessories-assetID}}',
            '{{%assetaccessories}}'
        );

        // drops the index for column assetID
        $this->dropIndex(
            '{{%idx-assetaccessories-assetID}}',
            '{{%assetaccessories}}'
        );
        
        $this->dropTable('{{%assetaccessories}}');
    }
}
