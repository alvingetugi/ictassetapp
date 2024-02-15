<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%depreciation}}`.
 */
class m240215_084311_create_depreciation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%depreciation}}', [
            'id' => $this->primaryKey(),
            'assetID' => $this->integer()->notNull(),
            'purchase_value' => $this->decimal(10, 2)->notNull(),
            'current_value' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        //creates index for column assetID
        $this->createIndex(
            '{{%idx-depreciation-assetID}}',
            '{{%depreciation}}',
            'assetID'
        );

        //adds foreign key for table {{ictassets}}
        $this->addForeignKey(
            '{{%fk-depreciation-assetID}}',
            '{{%depreciation}}',
            'assetID',
            '{{%ictassets}}',
            'id',
            'CASCADE'
        );

         //creates index for column created_by
         $this->createIndex(
            '{{%idx-depreciation-created_by}}',
            '{{%depreciation}}',
            'created_by'
            
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-depreciation-created_by}}',
            '{{%depreciation}}',
            'created_by',
            '{{%user}}',
            'id',
            //'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-depreciation-updated_by}}',
            '{{%depreciation}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-depreciation-updated_by}}',
            '{{%depreciation}}',
            'updated_by',
            '{{%user}}',
            'id',
            // 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-depreciation-created_by}}',
            '{{%depreciation}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-depreciation-created_by}}',
            '{{%depreciation}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-depreciation-updated_by}}',
            '{{%depreciation}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-depreciation-updated_by}}',
            '{{%depreciation}}'
        );

        // drops the foreign key for table `{{%ictassets}}`
        $this->dropForeignKey(
            '{{%fk-depreciation-assetID}}',
            '{{%depreciation}}'
        );

        // drops the index for column asset
        $this->dropIndex(
            '{{%idx-depreciation-assetID}}',
            '{{%depreciation}}'
        );

        $this->dropTable('{{%depreciation}}');
    }
}
