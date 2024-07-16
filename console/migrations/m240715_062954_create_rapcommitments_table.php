<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rapcommitments}}`.
 */
class m240715_062954_create_rapcommitments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rapcommitments}}', [
            'id' => $this->primaryKey(),
            'rapID' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'expectedamount' => $this->decimal(10, 2)->notNull(),
            'comments' => $this->string(50)->notNull(),
            'document' => $this->string(2000)->notNull(),
        ]);

        //creates index for column rapID
        $this->createIndex(
            '{{%idx-rapcommitments-rapID}}',
            '{{%rapcommitments}}',
            'rapID'
        );

        //adds foreign key for table {{rap}}
        $this->addForeignKey(
            '{{%fk-rapcommitments-rapID}}',
            '{{%rapcommitments}}',
            'rapID',
            '{{%rap}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%rap}}`
        $this->dropForeignKey(
            '{{%fk-rapcommitments-rapID}}',
            '{{%rapcommitments}}'
        );

        // drops the index for column rapID
        $this->dropIndex(
            '{{%idx-rapcommitments-rapID}}',
            '{{%rapcommitments}}'
        );

        $this->dropTable('{{%rapcommitments}}');
    }
}
