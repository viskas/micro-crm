<?php

use yii\db\Migration;

/**
 * Handles adding status to table `notifications`.
 */
class m180928_093538_add_status_column_to_notifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('notifications', 'status', $this->integer(1)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('notifications', 'status');
    }
}
