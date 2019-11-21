<?php

use yii\db\Migration;

/**
 * Handles the creation of table `refferals`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180918_023016_create_refferals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('refferals', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'parent_id' => $this->integer(11)->defaultValue(null),
            'status' => $this->integer(1)->defaultValue(1),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-refferals-user_id',
            'refferals',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-refferals-user_id',
            'refferals',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-refferals-user_id',
            'refferals'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-refferals-user_id',
            'refferals'
        );

        $this->dropTable('refferals');
    }
}
