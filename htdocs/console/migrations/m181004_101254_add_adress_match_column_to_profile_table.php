<?php

use yii\db\Migration;

/**
 * Handles adding adress_match to table `profile`.
 */
class m181004_101254_add_adress_match_column_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('profile', 'adress_match', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('profile', 'adress_match');
    }
}
