<?php

use yii\db\Migration;

/**
 * Handles the creation of table `refferal_codes`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180918_022938_create_refferal_codes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('refferal_codes', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'code' => $this->string(11)->notNull(),
            'status' => $this->integer(1)->defaultValue(1),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-refferal_codes-user_id',
            'refferal_codes',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-refferal_codes-user_id',
            'refferal_codes',
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
            'fk-refferal_codes-user_id',
            'refferal_codes'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-refferal_codes-user_id',
            'refferal_codes'
        );

        $this->dropTable('refferal_codes');
    }
}
