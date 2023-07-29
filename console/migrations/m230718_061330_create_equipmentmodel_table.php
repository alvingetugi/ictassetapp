<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipmentmodel}}`.
 */
class m230718_061330_create_equipmentmodel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipmentmodel}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'make_id' => $this->integer()->notNull(), 
        ]);

        //creates index for column category_id
        $this->createIndex(
            '{{%idx-equipmentmodel-category_id}}',
            '{{%equipmentmodel}}',
            'category_id'
        );

        //adds foreign key for table {{categories}}
        $this->addForeignKey(
            '{{%fk-equipmentmodel-category_id}}',
            '{{%equipmentmodel}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        //creates index for column make_id
        $this->createIndex(
            '{{%idx-equipmentmodel-make_id}}',
            '{{%equipmentmodel}}',
            'category_id'
        );

        //adds foreign key for table {{makes}}
        $this->addForeignKey(
            '{{%fk-equipmentmodel-make_id}}',
            '{{%equipmentmodel}}',
            'make_id',
            '{{%make}}',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-equipmentmodel-category_id}}',
            '{{%equipmentmodel}}'
        );

        // drops the index for column category_id
        $this->dropIndex(
            '{{%idx-equipmentmodel-category_id}}',
            '{{%equipmentmodel}}'
        );

        // drops the foreign key for table `{{%makes}}`
        $this->dropForeignKey(
            '{{%fk-equipmentmodel-make_id}}',
            '{{%equipmentmodel}}'
        );

        // drops the index for column make_id
        $this->dropIndex(
            '{{%idx-equipmentmodel-make_id}}',
            '{{%equipmentmodel}}'
        );

        $this->dropTable('{{%equipmentmodel}}');
    }
}
