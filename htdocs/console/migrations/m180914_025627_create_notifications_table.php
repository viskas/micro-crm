<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notifications`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180914_025627_create_notifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('notifications', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'type' => $this->string(),
            'title' => $this->string(),
            'message' => $this->string(),
            'date' => $this->dateTime(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-notifications-user_id',
            'notifications',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-notifications-user_id',
            'notifications',
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
            'fk-notifications-user_id',
            'notifications'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-notifications-user_id',
            'notifications'
        );

        $this->dropTable('notifications');
    }
}
