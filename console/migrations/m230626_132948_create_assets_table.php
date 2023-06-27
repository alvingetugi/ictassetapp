<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assets}}`.
 */
class m230626_132948_create_assets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assets}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string(255)->notNull(),
            'asset_master_id' => $this->integer(11)->notNull(),
            'location_id' => $this->integer(11)->notNull(),
            'serial_number' => $this->string(255)->notNull(),
            'tag_number' => $this->string(255)->notNull(),
            'storage' => $this->integer(11)->notNull(),
            'ram' => $this->integer(11)->notNull(),
            'accessories' => $this->string(255),
            'condition' => $this->string(255)->notNull(),
            'location' => $this->string(255)->notNull(),
            'status' => $this->tinyInteger(2)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11), 
        ]);

        //creates index for column asset_master_id
        $this->createIndex(
            '{{%idx-assets-asset_master_id}}',
            '{{%assets}}',
            'asset_master_id'
        );

        //adds foreign key for table {{assets master}}
        $this->addForeignKey(
            '{{%fk-assets-asset_master_id}}',
            '{{%assets}}',
            'asset_master_id',
            '{{%assets_master}}',
            'id',
            'CASCADE'
        );

        //creates index for column location_id
        $this->createIndex(
            '{{%idx-assets-location_id}}',
            '{{%assets}}',
            'location_id'
        );

        //adds foreign key for table {{assets master}}
        $this->addForeignKey(
            '{{%fk-assets-location_id}}',
            '{{%assets}}',
            'location_id',
            '{{%locations}}',
            'id',
            // 'CASCADE'
        );

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-assets-created_by}}',
            '{{%assets}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-assets-created_by}}',
            '{{%assets}}',
            'created_by',
            '{{%user}}',
            'id',
            // 'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-assets-updated_by}}',
            '{{%assets}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-assets-updated_by}}',
            '{{%assets}}',
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
        // drops the foreign key for table `{{%locations}}`
        $this->dropForeignKey(
            '{{%fk-assets-location_id}}',
            '{{%assets}}'
        );

        // drops the index for column location_id
        $this->dropIndex(
            '{{%idx-assets-location_id}}',
            '{{%assets}}'
        ); 

        // drops the foreign key for table `{{%assets_master}}`
        $this->dropForeignKey(
            '{{%fk-assets-asset_master_id}}',
            '{{%assets}}'
        );

        // drops the index for column asset_master_id
        $this->dropIndex(
            '{{%idx-assets-asset_master_id}}',
            '{{%assets}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-assets-created_by}}',
            '{{%assets}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-assets-created_by}}',
            '{{%assets}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-assets-updated_by}}',
            '{{%assets}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-assets-updated_by}}',
            '{{%assets}}'
        );

        $this->dropTable('{{%assets}}');
    }
}
