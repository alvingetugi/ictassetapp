<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%surrenders}}`.
 */
class m240215_164053_create_surrenders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%surrenders}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'surrenderdate' => $this->date()->notNull(),
            'categoryID' => $this->integer()->notNull(),
            'modelID' => $this->integer()->notNull(),
            'serialnumber' => $this->integer()->notNull(),
            'accessorylistID' => $this->integer(),
            'userID' => $this->integer()->notNull(),
            'comments' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

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
            // 'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-surrenders-updated_by}}',
            '{{%surrenders}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-surrenders-updated_by}}',
            '{{%surrenders}}',
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
            '{{%fk-surrenders-created_by}}',
            '{{%surrenders}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-surrenders-created_by}}',
            '{{%surrenders}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-surrenders-updated_by}}',
            '{{%surrenders}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-surrenders-updated_by}}',
            '{{%surrenders}}'
        );

        $this->dropTable('{{%surrenders}}');
    }
}
