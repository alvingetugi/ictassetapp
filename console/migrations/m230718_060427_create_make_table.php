<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%make}}`.
 */
class m230718_060427_create_make_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%make}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        //creates index for column category_id
        $this->createIndex(
            '{{%idx-make-category_id}}',
            '{{%make}}',
            'category_id'
        );

        //adds foreign key for table {{categories}}
        $this->addForeignKey(
            '{{%fk-make-category_id}}',
            '{{%make}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops the foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-make-category_id}}',
            '{{%make}}'
        );

        // drops the index for column category_id
        $this->dropIndex(
            '{{%idx-make-category_id}}',
            '{{%make}}'
        );

        $this->dropTable('{{%make}}');
    }
}
