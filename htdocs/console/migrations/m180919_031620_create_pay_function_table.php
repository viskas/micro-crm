<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pay_function`.
 */
class m180919_031620_create_pay_function_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pay_function', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100),
            'status' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pay_function');
    }
}
