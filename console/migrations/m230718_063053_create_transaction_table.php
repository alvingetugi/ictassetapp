<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction}}`.
 */
class m230718_063053_create_transaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'date' => $this->date()->notNull(),
            'transaction_type' => $this->integer()->notNull(),
            'staff' => $this->string(255)->notNull(),
            'location_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        //creates index for column transaction_type
        $this->createIndex(
            '{{%idx-transaction-transaction_type}}',
            '{{%transaction}}',
            'transaction_type'
        );

        //adds foreign key for table {{transaction_type}}
        $this->addForeignKey(
            '{{%fk-transaction-transaction_type}}',
            '{{%transaction}}',
            'transaction_type',
            '{{%transaction_type}}',
            'id',
            'CASCADE'
        );

        //creates index for column location
        $this->createIndex(
            '{{%idx-transaction-location_id}}',
            '{{%transaction}}',
            'location_id'
        );

        //adds foreign key for table {{location}}
        $this->addForeignKey(
            '{{%fk-transaction-location_id}}',
            '{{%transaction}}',
            'location_id',
            '{{%location}}',
            'id',
            'CASCADE'
        );

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-transaction-created_by}}',
            '{{%transaction}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-transaction-created_by}}',
            '{{%transaction}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-transaction-updated_by}}',
            '{{%transaction}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-transaction-updated_by}}',
            '{{%transaction}}',
            'updated_by',
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
        // drops the foreign key for table `{{%transaction_types}}`
        $this->dropForeignKey(
            '{{%fk-transaction-transaction_type}}',
            '{{%transaction}}'
        );

        // drops the index for column transaction_type
        $this->dropIndex(
            '{{%idx-transaction-transaction_type}}',
            '{{%transaction}}'
        );

        // drops the foreign key for table `{{%locations}}`
        $this->dropForeignKey(
            '{{%fk-transaction-location_id}}',
            '{{%transaction}}'
        );

        // drops the index for column location
        $this->dropIndex(
            '{{%idx-transaction-location_id}}',
            '{{%transaction}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-transaction-created_by}}',
            '{{%transaction}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-transaction-created_by}}',
            '{{%transaction}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-transaction-updated_by}}',
            '{{%transaction}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-transaction-updated_by}}',
            '{{%transaction}}'
        );

        $this->dropTable('{{%transaction}}');
    }
}
