<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assets_master}}`.
 */
class m230626_132337_create_assets_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assets_master}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string(255)->notNull(),
            'brand' => $this->string(255)->notNull(),
            'model' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11), 
        ]);

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-assets_master-created_by}}',
            '{{%assets_master}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-assets_master-created_by}}',
            '{{%assets_master}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-assets_master-updated_by}}',
            '{{%assets_master}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-assets_master-updated_by}}',
            '{{%assets_master}}',
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
            '{{%fk-assets_master-created_by}}',
            '{{%assets_master}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-assets_master-created_by}}',
            '{{%assets_master}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-assets_master-updated_by}}',
            '{{%assets_master}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-assets_master-updated_by}}',
            '{{%assets_master}}'
        );
        
        $this->dropTable('{{%assets_master}}');
    }
}
