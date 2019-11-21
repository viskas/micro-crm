<?php

use yii\db\Migration;

/**
 * Handles adding zip_code_2 to table `profile`.
 */
class m181004_101051_add_zip_code_2_column_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('profile', 'zip_code_2', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('profile', 'zip_code_2');
    }
}
