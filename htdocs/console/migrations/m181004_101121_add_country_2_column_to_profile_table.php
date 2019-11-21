<?php

use yii\db\Migration;

/**
 * Handles adding country_2 to table `profile`.
 */
class m181004_101121_add_country_2_column_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('profile', 'country_2', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('profile', 'country_2');
    }
}
