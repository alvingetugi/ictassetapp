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
            'date' => $this->date()->notNull(),
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

        $this->dropTable('{{%rappayments}}');
    }
}
