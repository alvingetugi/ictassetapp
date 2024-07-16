<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%planledger}}`.
 */
class m240626_132245_create_planledger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%planledger}}', [
            'id' => $this->primaryKey(),
            'rapID' => $this->integer(),
            'debit' => $this->integer(),
            'credit' => $this->integer(),
            'runningbalance' => $this->integer(),
            'status' => $this->string(255),
            'duedate' => $this->date(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        //creates index for column rapID
        $this->createIndex(
            '{{%idx-planledger-rapID}}',
            '{{%planledger}}',
            'rapID'
        );

        //adds foreign key for table {{remedialactionplans}}
        $this->addForeignKey(
            '{{%fk-planledger-rapID}}',
            '{{%planledger}}',
            'rapID',
            '{{%remedialactionplans}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%remedialactionplans}}`
        $this->dropForeignKey(
            '{{%fk-planledger-rapID}}',
            '{{%planledger}}'
        );

        // drops the index for column assetID
        $this->dropIndex(
            '{{%idx-planledger-rapID}}',
            '{{%planledger}}'
        );

        $this->dropTable('{{%planledger}}');
    }
}
