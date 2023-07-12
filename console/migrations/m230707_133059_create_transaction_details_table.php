<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction_details}}`.
 */
class m230707_133059_create_transaction_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction_details}}', [
            'id' => $this->primaryKey(),
            'trans_id' => $this->integer()->notNull(),
            'asset_id' => $this->integer()->notNull(),
            'details' => $this->text(),
        ]);

        //creates index for column trans_id
        $this->createIndex(
            '{{%idx-transaction_details-trans_id}}',
            '{{%transaction_details}}',
            'trans_id'
        );

        //adds foreign key for table {{transactions}}
        $this->addForeignKey(
            '{{%fk-transaction_details-trans_id}}',
            '{{%transaction_details}}',
            'trans_id',
            '{{%transactions}}',
            'id',
            'CASCADE'
        );

        //creates index for column asset_id
        $this->createIndex(
            '{{%idx-transaction_details-asset_id}}',
            '{{%transaction_details}}',
            'asset_id'
        );

        //adds foreign key for table {{assets}}
        $this->addForeignKey(
            '{{%fk-transaction_details-asset_id}}',
            '{{%transaction_details}}',
            'asset_id',
            '{{%assets}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%transactions}}`
        $this->dropForeignKey(
            '{{%fk-transaction_details-trans_id}}',
            '{{%transaction_details}}'
        );

        // drops the index for column trans_id
        $this->dropIndex(
            '{{%idx-transaction_details-trans_id}}',
            '{{%transaction_details}}'
        );

        // drops the foreign key for table `{{%assets}}`
        $this->dropForeignKey(
            '{{%fk-transaction_details-asset_id}}',
            '{{%transaction_details}}'
        );

        // drops the index for column asset_id
        $this->dropIndex(
            '{{%idx-transaction_details-asset_id}}',
            '{{%transaction_details}}'
        );

        $this->dropTable('{{%transaction_details}}');
    }
}
