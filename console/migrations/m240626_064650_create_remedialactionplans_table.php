<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%remedialactionplans}}`.
 */
class m240626_064650_create_remedialactionplans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%remedialactionplans}}', [
            'id' => $this->primaryKey(),
            'rapref' => $this->string(255)->notNull()->unique(),
            'schemeID' => $this->integer()->notNull(),
            'raptype' => $this->string(255),
            'deficit' => $this->integer()->notNull(),
            'planstart' => $this->date()->notNull(),
            'frequency' => $this->string(255)->notNull(),
            'installmentamount' => $this->integer()->notNull(),
            'planend' => $this->date()->notNull(),
            'comments' => $this->string(255)->notNull(),
            'runningbalance' => $this->integer()->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            
        ]);

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-remedialactionplans-created_by}}',
            '{{%remedialactionplans}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-remedialactionplans-created_by}}',
            '{{%remedialactionplans}}',
            'created_by',
            '{{%user}}',
            'id',
            // 'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-remedialactionplans-updated_by}}',
            '{{%remedialactionplans}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-remedialactionplans-updated_by}}',
            '{{%remedialactionplans}}',
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
        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-remedialactionplans-created_by}}',
            '{{%remedialactionplans}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-remedialactionplans-created_by}}',
            '{{%remedialactionplans}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-remedialactionplans-updated_by}}',
            '{{%remedialactionplans}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-remedialactionplans-updated_by}}',
            '{{%remedialactionplans}}'
        );

        $this->dropTable('{{%remedialactionplans}}');
    }
}
