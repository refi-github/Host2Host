<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%legal_document}}`.
 */
class m201118_094649_create_legal_document_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%legal_document}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->batchInsert('legal_document', 
            [
                'id',
                'name',
            ], 
            [
                [
                    1,
                    'Ijin Kemenkumham / AHU',
                ],
                [
                    2,
                    'Surat Ijin Domisili',
                ],
                [
                    3,
                    'TDP',
                ],
                [
                    4,
                    'SIUP',
                ],
                [
                    5,
                    'NPWP',
                ],
                [
                    6,
                    'Akta Pendirian & Akta Perubahan Terakhir',
                ],
            ],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%legal_document}}');
    }
}
