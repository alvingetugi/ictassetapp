<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rappayments}}`.
 */
class m240715_063015_create_rappayments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rappayments}}', [
            'id' => $this->primaryKey(),
            'rapID' => $this->integer()->notNull(),
            'scheduleID' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'paymentdate' => $this->date()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'comments' => $this->string(50)->notNull(),
            'proof' => $this->string(2000)->notNull(),
        ]);

        //creates index for column rapID
        $this->createIndex(
            '{{%idx-rappayments-rapID}}',
            '{{%rappayments}}',
            'rapID'
        );

        //adds foreign key for table {{rap}}
        $this->addForeignKey(
            '{{%fk-rappayments-rapID}}',
            '{{%rappayments}}',
            'rapID',
            '{{%rap}}',
            'id',
            'CASCADE'
        );

        //creates index for column scheduleID
        $this->createIndex(
            '{{%idx-rappayments-scheduleID}}',
            '{{%rappayments}}',
            'scheduleID'
        );

        //adds foreign key for table {{rapschedules}}
        $this->addForeignKey(
            '{{%fk-rappayments-scheduleID}}',
            '{{%rappayments}}',
            'scheduleID',
            '{{%rapschedules}}',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%rap}}`
        $this->dropForeignKey(
            '{{%fk-rappayments-rapID}}',
            '{{%rappayments}}'
        );

        // drops the index for column rapID
        $this->dropIndex(
            '{{%idx-rappayments-rapID}}',
            '{{%rappayments}}'
        );

        // drops the foreign key for table `{{%rapschedules}}`
        $this->dropForeignKey(
            '{{%fk-rappayments-scheduleID}}',
            '{{%rappayments}}'
        );

        // drops the index for column scheduleID
        $this->dropIndex(
            '{{%idx-rappayments-scheduleID}}',
            '{{%rappayments}}'
        );

        $this->dropTable('{{%rappayments}}');
    }
}
