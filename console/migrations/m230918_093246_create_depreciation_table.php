<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%depreciation}}`.
 */
class m230918_093246_create_depreciation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%depreciation}}', [
            'id' => $this->primaryKey(),
            'equipment_id' => $this->integer()->notNull(),
            'purchase_value' => $this->decimal(10, 2)->notNull(),
            'current_value' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
        ]);

        //creates index for column equipment_id
        $this->createIndex(
            '{{%idx-depreciation-equipment_id}}',
            '{{%depreciation}}',
            'equipment_id'
        );

        //adds foreign key for table {{equipment}}
        $this->addForeignKey(
            '{{%fk-depreciation-equipment_id}}',
            '{{%depreciation}}',
            'equipment_id',
            '{{%equipment}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%equipment}}`
        $this->dropForeignKey(
            '{{%fk-depreciation-equipment_id}}',
            '{{%depreciation}}'
        );

        // drops the index for column equipment_id
        $this->dropIndex(
            '{{%idx-depreciation-equipment_id}}',
            '{{%depreciation}}'
        );
        
        $this->dropTable('{{%depreciation}}');
    }
}
