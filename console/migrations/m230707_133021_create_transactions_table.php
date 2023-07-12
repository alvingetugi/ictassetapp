<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transactions}}`.
 */
class m230707_133021_create_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transactions}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'date' => $this->integer()->notNull()->defaultValue(0),
            'transaction_type' => $this->string(50)->notNull(),
            'location' => $this->string(50)->notNull(),
            'details' => $this->text(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        //creates index for column transaction_type
        $this->createIndex(
            '{{%idx-transactions-transaction_type}}',
            '{{%transactions}}',
            'transaction_type'
        );

        //adds foreign key for table {{transaction_types}}
        $this->addForeignKey(
            '{{%fk-transactions-transaction_type}}',
            '{{%transactions}}',
            'transaction_type',
            '{{%transaction_types}}',
            'code',
            'CASCADE'
        );

        //creates index for column location
        $this->createIndex(
            '{{%idx-transactions-location}}',
            '{{%transactions}}',
            'location'
        );

        //adds foreign key for table {{locations}}
        $this->addForeignKey(
            '{{%fk-transactions-location}}',
            '{{%transactions}}',
            'location',
            '{{%locations}}',
            'code',
            'CASCADE'
        );

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-transactions-created_by}}',
            '{{%transactions}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-transactions-created_by}}',
            '{{%transactions}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-transactions-updated_by}}',
            '{{%transactions}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-transactions-updated_by}}',
            '{{%transactions}}',
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
        // drops the foreign key for table `{{%transaction_types}}`
        $this->dropForeignKey(
            '{{%fk-transactions-transaction_type}}',
            '{{%transactions}}'
        );

        // drops the index for column transaction_type
        $this->dropIndex(
            '{{%idx-transactions-transaction_type}}',
            '{{%transactions}}'
        );

        // drops the foreign key for table `{{%locations}}`
        $this->dropForeignKey(
            '{{%fk-transactions-location}}',
            '{{%transactions}}'
        );

        // drops the index for column location
        $this->dropIndex(
            '{{%idx-transactions-location}}',
            '{{%transactions}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-transactions-created_by}}',
            '{{%transactions}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-transactions-created_by}}',
            '{{%transactions}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-transactions-updated_by}}',
            '{{%transactions}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-transactions-updated_by}}',
            '{{%transactions}}'
        );

        $this->dropTable('{{%transactions}}');
    }
}
