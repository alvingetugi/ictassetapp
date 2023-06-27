<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%issuances}}`.
 */
class m230626_133314_create_issuances_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%issuances}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(45)->notNull(),
            'lastname' => $this->string(45)->notNull(),
            'department' => $this->string(255)->notNull(),
            'asset_id' => $this->integer(11)->notNull(),
            'model' => $this->string(255)->notNull(),
            'serial_number' => $this->string(255)->notNull(),
            'tag_number' => $this->string(255)->notNull(),
            'ram' => $this->string(255)->notNull(),
            'storage' => $this->string(255)->notNull(),
            'accessories' => $this->string(255)->notNull(),
            'condition' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
        ]);

        //creates index for column asset_id
        $this->createIndex(
            '{{%idx-issuances-asset_id}}',
            '{{%issuances}}',
            'asset_id'
        );

        //adds foreign key for table {{assets}}
        $this->addForeignKey(
            '{{%fk-issuances-asset_id}}',
            '{{%issuances}}',
            'asset_id',
            '{{%assets}}',
            'id',
            'CASCADE'
        );

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-issuances-created_by}}',
            '{{%issuances}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-issuances-created_by}}',
            '{{%issuances}}',
            'created_by',
            '{{%user}}',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%assets}}`
        $this->dropForeignKey(
            '{{%fk-issuances-asset_id}}',
            '{{%issuances}}'
        );

        // drops the index for column asset_id
        $this->dropIndex(
            '{{%idx-issuances-asset_id}}',
            '{{%issuances}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-issuances-created_by}}',
            '{{%issuances}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-issuances-created_by}}',
            '{{%issuances}}'
        );
        
        $this->dropTable('{{%issuances}}');
    }
}
