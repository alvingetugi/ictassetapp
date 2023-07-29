<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction_detail}}`.
 */
class m230729_075400_create_transaction_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction_detail}}', [
            'id' => $this->primaryKey(),
            'trans_id' => $this->integer()->notNull(),
            'equipment_id' => $this->integer()->notNull(),
            'details' => $this->text(),
        ]);

        //creates index for column trans_id
        $this->createIndex(
            '{{%idx-transaction_detail-trans_id}}',
            '{{%transaction_detail}}',
            'trans_id'
        );

        //adds foreign key for table {{transactions}}
        $this->addForeignKey(
            '{{%fk-transaction_detail-trans_id}}',
            '{{%transaction_detail}}',
            'trans_id',
            '{{%transaction}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops the foreign key for table `{{%transaction}}`
         $this->dropForeignKey(
            '{{%fk-transaction_detail-trans_id}}',
            '{{%transaction_detail}}'
        );

        // drops the index for column trans_id
        $this->dropIndex(
            '{{%idx-transaction_detail-trans_id}}',
            '{{%transaction_detail}}'
        );
        
        $this->dropTable('{{%transaction_detail}}');
    }
}
