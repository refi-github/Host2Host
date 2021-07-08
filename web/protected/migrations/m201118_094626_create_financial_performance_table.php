<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%financial_performance}}`.
 */
class m201118_094626_create_financial_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%financial_performance}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->batchInsert('financial_performance', 
            [
                'id',
                'name',
            ], 
            [
                [
                    1,
                    'Proyeksi Bisnis 1 Tahun Mendatang',
                ],
                [
                    2,
                    'Laporan Keungan Un-audited dan Audited (opsional)',
                ],
            ],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%financial_performance}}');
    }
}
