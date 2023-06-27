<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%surrenders}}`.
 */
class m230626_133518_create_surrenders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%surrenders}}', [
            'id' => $this->primaryKey(),
            'issuance_id' => $this->integer(11)->notNull(),
            'firstname' => $this->string(45)->notNull(),
            'lastname' => $this->string(45)->notNull(),
            'department' => $this->string(255)->notNull(),
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
        //creates index for column issuance_id
        $this->createIndex(
            '{{%idx-surrenders-issuance_id}}',
            '{{%surrenders}}',
            'issuance_id'
        );

        //adds foreign key for table {{issuances}}
        $this->addForeignKey(
            '{{%fk-surrenders-issuance_id}}',
            '{{%surrenders}}',
            'issuance_id',
            '{{%issuances}}',
            'id',
            'CASCADE'
        );

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-surrenders-created_by}}',
            '{{%surrenders}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-surrenders-created_by}}',
            '{{%surrenders}}',
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
        // drops the foreign key for table `{{%issuances}}`
        $this->dropForeignKey(
            '{{%fk-surrenders-issuance_id}}',
            '{{%surrenders}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-surrenders-issuance_id}}',
            '{{%surrenders}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-surrenders-created_by}}',
            '{{%surrenders}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-surrenders-created_by}}',
            '{{%surrenders}}'
        );
        
        $this->dropTable('{{%surrenders}}');
    }
}
