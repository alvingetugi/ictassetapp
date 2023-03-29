<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart_items}}`.
 */
class m230327_055440_create_cart_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart_items}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'quantity' => $this->integer(2)->notNull(),
            'created_by' => $this->integer(11),
        ]);

        //creates index for column product_id
        $this->createIndex(
            '{{%idx-cart_items-product_id}}',
            '{{%cart_items}}',
            'product_id'
        );

        //adds foreign key for table {{products}}
        $this->addForeignKey(
            '{{%fk-cart_items-product_id}}',
            '{{%cart_items}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );

        //creates index for column created_by
        $this->createIndex(
            '{{%idx-cart_items-created_by}}',
            '{{%cart_items}}',
            'created_by'
        );

        //adds foreign key for table {{user}}
        $this->addForeignKey(
            '{{%fk-cart_items-created_by}}',
            '{{%cart_items}}',
            'created_by',
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
        // drops the foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-cart_items-product_id}}',
            '{{%cart_items}}'
        );

        // drops the index for column product_id
        $this->dropIndex(
            '{{%idx-cart_items-product_id}}',
            '{{%cart_items}}'
        );

        // drops the foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-cart_items-created_by}}',
            '{{%cart_items}}'
        );

        // drops the index for column created_by
        $this->dropIndex(
            '{{%idx-cart_items-created_by}}',
            '{{%cart_items}}'
        );

        $this->dropTable('{{%cart_items}}');
    }
}
