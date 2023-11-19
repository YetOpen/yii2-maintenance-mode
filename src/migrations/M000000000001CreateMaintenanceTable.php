<?php

namespace brussens\maintenance\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%maintenance}}`.
 */
class M000000000001CreateMaintenanceTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%maintenance}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'time_start' => $this->time()->notNull(),
            'time_end' => $this->time()->notNull(),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%maintenance}}');
    }
}
