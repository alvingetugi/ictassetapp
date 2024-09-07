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
            'rapscheduletypeID' => $this->integer()->notNull(),
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

        //creates index for column rapscheduletypeID
        $this->createIndex(
            '{{%idx-rapschedules-rapscheduletypeID}}',
            '{{%rapschedules}}',
            'rapscheduletypeID'
        );

        //adds foreign key for table {{rapscheduletypes}}
        $this->addForeignKey(
            '{{%fk-rapschedules-rapscheduletypeID}}',
            '{{%rapschedules}}',
            'rapscheduletypeID',
            '{{%rapscheduletypes}}',
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
            '{{%fk-rapschedules-rapID}}',
            '{{%rapschedules}}'
        );

        // drops the index for column rapID
        $this->dropIndex(
            '{{%idx-rapschedules-rapID}}',
            '{{%rapschedules}}'
        );

        // drops the foreign key for table `{{%rapscheduletypes}}`
        $this->dropForeignKey(
            '{{%fk-rapschedules-rapscheduletypeID}}',
            '{{%rapschedules}}'
        );

        // drops the index for column rapscheduletypeID
        $this->dropIndex(
            '{{%idx-rapschedules-rapscheduletypeID}}',
            '{{%rapschedules}}'
        );

        $this->dropTable('{{%rapschedules}}');
    }
}
