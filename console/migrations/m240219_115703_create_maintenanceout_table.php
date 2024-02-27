<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%maintenanceout}}`.
 */
class m240219_115703_create_maintenanceout_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%maintenanceout}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'outwarddate' => $this->date()->notNull(),
            'categoryID' => $this->integer()->notNull(),
            'modelID' => $this->integer()->notNull(),
            'serialnumber' => $this->integer()->notNull(),
            'userID' => $this->integer()->notNull(),
            'comments' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-maintenanceout-created_by}}',
            '{{%maintenanceout}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-maintenanceout-created_by}}',
            '{{%maintenanceout}}',
            'created_by',
            '{{%user}}',
            'id',
            // 'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-maintenanceout-updated_by}}',
            '{{%maintenanceout}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-maintenanceout-updated_by}}',
            '{{%maintenanceout}}',
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
            '{{%fk-maintenanceout-created_by}}',
            '{{%maintenanceout}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-maintenanceout-created_by}}',
            '{{%maintenanceout}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-maintenanceout-updated_by}}',
            '{{%maintenanceout}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-maintenanceout-updated_by}}',
            '{{%maintenanceout}}'
        );

        $this->dropTable('{{%maintenanceout}}');
    }
}
