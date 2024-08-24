<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%issuances}}`.
 */
class m240215_090641_create_issuances_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%issuances}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'issuancedate' => $this->date()->notNull(),
            'categoryID' => $this->integer()->notNull(),
            'modelID' => $this->integer()->notNull(),
            'serialnumber' => $this->integer()->notNull(),
            'accessorylistID' => $this->string(300),
            'userID' => $this->integer()->notNull(),
            'comments' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

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
            // 'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-issuances-updated_by}}',
            '{{%issuances}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-issuances-updated_by}}',
            '{{%issuances}}',
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
            '{{%fk-issuances-created_by}}',
            '{{%issuances}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-issuances-created_by}}',
            '{{%issuances}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-issuances-updated_by}}',
            '{{%issuances}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-issuances-updated_by}}',
            '{{%issuances}}'
        );

        $this->dropTable('{{%issuances}}');
    }
}
