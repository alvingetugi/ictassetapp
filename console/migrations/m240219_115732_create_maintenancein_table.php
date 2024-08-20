<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%maintenancein}}`.
 */
class m240219_115732_create_maintenancein_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%maintenancein}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'inwarddate' => $this->date()->notNull(),
            'categoryID' => $this->integer()->notNull(),
            'modelID' => $this->integer()->notNull(),
            'serialnumber' => $this->integer()->notNull(),
            'accessorylistID' => $this->integer(),
            'userID' => $this->integer()->notNull(),
            'comments' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

         //creates index for column created_by
         $this->createIndex(
            '{{%idx-maintenancein-created_by}}',
            '{{%maintenancein}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-maintenancein-created_by}}',
            '{{%maintenancein}}',
            'created_by',
            '{{%user}}',
            'id',
            // 'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-maintenancein-updated_by}}',
            '{{%maintenancein}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-maintenancein-updated_by}}',
            '{{%maintenancein}}',
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
            '{{%fk-maintenancein-created_by}}',
            '{{%maintenancein}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-maintenancein-created_by}}',
            '{{%maintenancein}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-maintenancein-updated_by}}',
            '{{%maintenancein}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-maintenancein-updated_by}}',
            '{{%maintenancein}}'
        );

        $this->dropTable('{{%maintenancein}}');
    }
}
