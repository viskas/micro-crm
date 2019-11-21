<?php

use yii\db\Migration;

/**
 * Handles adding city_2 to table `profile`.
 */
class m181004_101002_add_city_2_column_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('profile', 'city_2', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('profile', 'city_2');
    }
}
