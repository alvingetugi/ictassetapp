<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rapschedules}}`.
 */
class m240715_062954_create_rapschedules_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rapschedules}}', [
            'id' => $this->primaryKey(),
            'rapID' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'duedate' => $this->date()->notNull(),
            'expectedamount' => $this->decimal(10, 2)->notNull(),
            'comments' => $this->string(50)->notNull(),
        ]);

        //creates index for column rapID
        $this->createIndex(
            '{{%idx-rapschedules-rapID}}',
            '{{%rapschedules}}',
            'rapID'
        );

        //adds foreign key for table {{rap}}
        $this->addForeignKey(
            '{{%fk-rapschedules-rapID}}',
            '{{%rapschedules}}',
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
            '{{%fk-rapschedules-rapID}}',
            '{{%rapschedules}}'
        );

        // drops the index for column rapID
        $this->dropIndex(
            '{{%idx-rapschedules-rapID}}',
            '{{%rapschedules}}'
        );

        $this->dropTable('{{%rapschedules}}');
    }
}
