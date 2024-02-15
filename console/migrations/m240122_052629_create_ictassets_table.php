<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ictassets}}`.
 */
class m240122_052629_create_ictassets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ictassets}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'categoryID' => $this->integer()->notNull(),
            'makeID' => $this->integer()->notNull(),
            'modelID' => $this->integer()->notNull(),
            'name' => $this->string(50)->notNull()->unique(),
            'tag_number' => $this->string(50)->notNull()->unique(),
            'storage' => $this->integer()->notNull(),
            'ram' => $this->integer()->notNull(),
            'operating_system' => $this->string(50)->notNull(),
            'date_of_delivery' => $this->date()->notNull(),
            'locationID' => $this->integer()->notNull(),
            'assetstatus' => $this->integer()->notNull(),
            'assetcondition' => $this->string(50)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        //creates index for column categoryID
        $this->createIndex(
            '{{%idx-ictassets-categoryID}}',
            '{{%ictassets}}',
            'categoryID'
        );

        //adds foreign key for table {{assetcategories}}
        $this->addForeignKey(
            '{{%fk-ictassets-categoryID}}',
            '{{%ictassets}}',
            'categoryID',
            '{{%assetcategories}}',
            'id',
            'CASCADE'
        );

        //creates index for column makeID
        $this->createIndex(
            '{{%idx-ictassets-makeID}}',
            '{{%ictassets}}',
            'makeID'
        );

        //adds foreign key for table {{assetmakes}}
        $this->addForeignKey(
            '{{%fk-ictassets-makeID}}',
            '{{%ictassets}}',
            'makeID',
            '{{%assetmakes}}',
            'id',
            'NO ACTION'
        );

        //creates index for column modelID
        $this->createIndex(
            '{{%idx-ictassets-modelID}}',
            '{{%ictassets}}',
            'modelID'
        );

        //adds foreign key for table {{assetmodels}}
        $this->addForeignKey(
            '{{%fk-ictassets-modelID}}',
            '{{%ictassets}}',
            'modelID',
            '{{%assetmodels}}',
            'id',
            'NO ACTION'
        );

        //creates index for column locationID
        $this->createIndex(
            '{{%idx-ictassets-locationID}}',
            '{{%ictassets}}',
            'locationID'
        );

        //adds foreign key for table {{locations}}
        $this->addForeignKey(
            '{{%fk-ictassets-locationID}}',
            '{{%ictassets}}',
            'locationID',
            '{{%locations}}',
            'id',
            'CASCADE'
        );

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-ictassets-created_by}}',
            '{{%ictassets}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-ictassets-created_by}}',
            '{{%ictassets}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        //creates index for column updated_by
        $this->createIndex(
            '{{%idx-ictassets-updated_by}}',
            '{{%ictassets}}',
            'updated_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-ictassets-updated_by}}',
            '{{%ictassets}}',
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
        // drops the foreign key for table `{{%assetcategories}}`
        $this->dropForeignKey(
            '{{%fk-ictassets-categoryID}}',
            '{{%ictassets}}'
        );

        // drops the index for column categoryID
        $this->dropIndex(
            '{{%idx-ictassets-categoryID}}',
            '{{%ictassets}}'
        );

        // drops the foreign key for table `{{%assetmakes}}`
        $this->dropForeignKey(
            '{{%fk-ictassets-makeID}}',
            '{{%ictassets}}'
        );

        // drops the index for column makeID
        $this->dropIndex(
            '{{%idx-ictassets-makeID}}',
            '{{%ictassets}}'
        );

        // drops the foreign key for table `{{%assetmodels}}`
        $this->dropForeignKey(
            '{{%fk-ictassets-modelID}}',
            '{{%ictassets}}'
        );

        // drops the index for column modelID
        $this->dropIndex(
            '{{%idx-ictassets-modelID}}',
            '{{%ictassets}}'
        );

        // drops the foreign key for table `{{%locations}}`
        $this->dropForeignKey(
            '{{%fk-ictassets-locationID}}',
            '{{%ictassets}}'
        );

        // drops the index for column locationID
        $this->dropIndex(
            '{{%idx-ictassets-locationID}}',
            '{{%ictassets}}'
        );
        
        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-ictassets-created_by}}',
            '{{%ictassets}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-ictassets-created_by}}',
            '{{%ictassets}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-ictassets-updated_by}}',
            '{{%ictassets}}'
        );

        // drops the index for column updated_by
        $this->dropIndex(
            '{{%idx-ictassets-updated_by}}',
            '{{%ictassets}}'
        );
        
        $this->dropTable('{{%ictassets}}');
    }
}
