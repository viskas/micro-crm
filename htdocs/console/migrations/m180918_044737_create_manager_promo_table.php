<?php

use yii\db\Migration;

/**
 * Handles the creation of table `manager_promo`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `promo_code`
 */
class m180918_044737_create_manager_promo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('manager_promo', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'poromo_id' => $this->integer(11),
            'status' => $this->integer(1)->defaultValue(1),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-manager_promo-user_id',
            'manager_promo',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-manager_promo-user_id',
            'manager_promo',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `poromo_id`
        $this->createIndex(
            'idx-manager_promo-poromo_id',
            'manager_promo',
            'poromo_id'
        );

        // add foreign key for table `promo_code`
        $this->addForeignKey(
            'fk-manager_promo-poromo_id',
            'manager_promo',
            'poromo_id',
            'promo_code',
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
            'fk-manager_promo-user_id',
            'manager_promo'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-manager_promo-user_id',
            'manager_promo'
        );

        // drops foreign key for table `promo_code`
        $this->dropForeignKey(
            'fk-manager_promo-poromo_id',
            'manager_promo'
        );

        // drops index for column `poromo_id`
        $this->dropIndex(
            'idx-manager_promo-poromo_id',
            'manager_promo'
        );

        $this->dropTable('manager_promo');
    }
}
