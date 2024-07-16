<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rap}}`.
 */
class m240715_062921_create_rap_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rap}}', [
            'id' => $this->primaryKey(),
            'typeID' => $this->integer()->notNull(),
            'schemeID' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(2)->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'start' => $this->date()->notNull(),
            'end' => $this->date()->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        //creates index for column typeID
        $this->createIndex(
            '{{%idx-rap-typeID}}',
            '{{%rap}}',
            'typeID'
        );

        //adds foreign key for table {{raptypes}}
        $this->addForeignKey(
            '{{%fk-rap-typeID}}',
            '{{%rap}}',
            'typeID',
            '{{%raptypes}}',
            'id',
            'CASCADE'
        );

        //creates index for column schemeID
        $this->createIndex(
            '{{%idx-rap-schemeID}}',
            '{{%rap}}',
            'schemeID'
        );

        //adds foreign key for table {{schemes}}
        $this->addForeignKey(
            '{{%fk-rap-schemeID}}',
            '{{%rap}}',
            'schemeID',
            '{{%schemes}}',
            'id',
            'NO ACTION'
        );

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-rap-created_by}}',
            '{{%rap}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-rap-created_by}}',
            '{{%rap}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-rap-updated_by}}',
            '{{%rap}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-rap-updated_by}}',
            '{{%rap}}',
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
        // drops the foreign key for table `{{%raptypes}}`
        $this->dropForeignKey(
            '{{%fk-rap-typeID}}',
            '{{%rap}}'
        );

        // drops the index for column typeID
        $this->dropIndex(
            '{{%idx-rap-typeID}}',
            '{{%rap}}'
        );

        // drops the foreign key for table `{{%schemes}}`
        $this->dropForeignKey(
            '{{%fk-rap-schemeID}}',
            '{{%rap}}'
        );

        // drops the index for column schemeID
        $this->dropIndex(
            '{{%idx-rap-schemeID}}',
            '{{%rap}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-rap-created_by}}',
            '{{%rap}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-rap-created_by}}',
            '{{%rap}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-rap-updated_by}}',
            '{{%rap}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-rap-updated_by}}',
            '{{%rap}}'
        );

        $this->dropTable('{{%rap}}');
    }
}
