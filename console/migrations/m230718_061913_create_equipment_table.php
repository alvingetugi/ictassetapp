<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipment}}`.
 */
class m230718_061913_create_equipment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipment}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'category_id' => $this->integer()->notNull(),
            'make_id' => $this->integer()->notNull(),
            'equipmodel_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'serial_number' => $this->string(50)->notNull()->unique(),
            'tag_number' => $this->string(50)->notNull()->unique(),
            'details' => $this->text(),
            'date_of_delivery' => $this->date()->notNull(),
            'location_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(2)->notNull(),
            'condition' => $this->tinyInteger(2)->notNull(),
        ]);

        //creates index for column category_id
        $this->createIndex(
            '{{%idx-equipment-category_id}}',
            '{{%equipment}}',
            'category_id'
        );

        //adds foreign key for table {{category}}
        $this->addForeignKey(
            '{{%fk-equipment-category_id}}',
            '{{%equipment}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        //creates index for column make_id
        $this->createIndex(
            '{{%idx-equipment-make_id}}',
            '{{%equipment}}',
            'make_id'
        );

        //adds foreign key for table {{make}}
        $this->addForeignKey(
            '{{%fk-equipment-make_id}}',
            '{{%equipment}}',
            'make_id',
            '{{%make}}',
            'id',
            'NO ACTION'
        );

        //creates index for column equipmodel_id
        $this->createIndex(
            '{{%idx-equipment-equipmodel_id}}',
            '{{%equipment}}',
            'equipmodel_id'
        );

        //adds foreign key for table {{equipmentmodel}}
        $this->addForeignKey(
            '{{%fk-equipment-equipmodel_id}}',
            '{{%equipment}}',
            'equipmodel_id',
            '{{%equipmentmodel}}',
            'id',
            'NO ACTION'
        );

        //creates index for column location_id
        $this->createIndex(
            '{{%idx-equipment-location_id}}',
            '{{%equipment}}',
            'location_id'
        );

        //adds foreign key for table {{location}}
        $this->addForeignKey(
            '{{%fk-equipment-location_id}}',
            '{{%equipment}}',
            'location_id',
            '{{%location}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-equipment-category_id}}',
            '{{%equipment}}'
        );

        // drops the index for column category_id
        $this->dropIndex(
            '{{%idx-equipment-category_id}}',
            '{{%equipment}}'
        );

        // drops the foreign key for table `{{%make}}`
        $this->dropForeignKey(
            '{{%fk-equipment-make_id}}',
            '{{%equipment}}'
        );

        // drops the index for column make_id
        $this->dropIndex(
            '{{%idx-equipment-make_id}}',
            '{{%equipment}}'
        );

        // drops the foreign key for table `{{%equipment_model}}`
        $this->dropForeignKey(
            '{{%fk-equipment-equipmodel_id}}',
            '{{%equipment}}'
        );

        // drops the index for column model_id
        $this->dropIndex(
            '{{%idx-equipment-equipmodel_id}}',
            '{{%equipment}}'
        );

        // drops the foreign key for table `{{%location}}`
        $this->dropForeignKey(
            '{{%fk-equipment-location_id}}',
            '{{%equipment}}'
        );

        // drops the index for column location_id
        $this->dropIndex(
            '{{%idx-equipment-location_id}}',
            '{{%equipment}}'
        );

        $this->dropTable('{{%equipment}}');
    }
}
