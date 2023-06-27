<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%locations}}`.
 */
class m230626_131844_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%locations}}', [
            'id' => $this->primaryKey(),
            'location' => $this->string(255)->notNull(),
            'type' => $this->string(255)->notNull(),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11), 
        ]);

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-locations-created_by}}',
            '{{%locations}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-locations-created_by}}',
            '{{%locations}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-locations-updated_by}}',
            '{{%locations}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-locations-updated_by}}',
            '{{%locations}}',
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
        // drops the foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-locations-created_by}}',
            '{{%locations}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-locations-created_by}}',
            '{{%locations}}'
        ); 

         // drops the foreign key for table `{{%users}}`
         $this->dropForeignKey(
            '{{%fk-locations-updated_by}}',
            '{{%locations}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-locations-updated_by}}',
            '{{%locations}}'
        ); 

        $this->dropTable('{{%locations}}');
    }
}
