<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m230530_101437_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'book_name' => $this->string()->notNull(),
            'genre_id' => $this->integer()->notNull(),
            'publication_date'=> $this->integer()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');

    }
}
