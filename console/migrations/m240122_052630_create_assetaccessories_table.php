<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assetaccessories}}`.
 */
class m240122_052630_create_assetaccessories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assetaccessories}}', [
            'id' => $this->primaryKey(),
            'accessorylistID' => $this->integer(),
            'assetID' => $this->integer(),
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

        //creates index for column accessorylistID
        $this->createIndex(
            '{{%idx-assetaccessories-accessorylistID}}',
            '{{%assetaccessories}}',
            'accessorylistID'
        );

        //adds foreign key for table {{accessorylist}}
        $this->addForeignKey(
            '{{%fk-assetaccessories-accessorylistID}}',
            '{{%assetaccessories}}',
            'accessorylistID',
            '{{%accessorylist}}',
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

        // drops the foreign key for table `{{%accessorylist}}`
        $this->dropForeignKey(
            '{{%fk-assetaccessories-accessorylistID}}',
            '{{%assetaccessories}}'
        );

        // drops the index for column accessorylistID
        $this->dropIndex(
            '{{%idx-assetaccessories-accessorylistID}}',
            '{{%assetaccessories}}'
        );

        $this->dropTable('{{%assetaccessories}}');
    }
}
