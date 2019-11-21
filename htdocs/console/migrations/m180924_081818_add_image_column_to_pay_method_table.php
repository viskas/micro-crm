<?php

use yii\db\Migration;

/**
 * Handles adding image to table `pay_method`.
 */
class m180924_081818_add_image_column_to_pay_method_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pay_method', 'image', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pay_method', 'image');
    }
}
