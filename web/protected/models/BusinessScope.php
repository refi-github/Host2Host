<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business_scope".
 *
 * @property int $id
 * @property string $name
 */
class BusinessScope extends \yii\db\ActiveRecord
{
    const PAGE_SIZE = 10;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_scope';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function getAll($params)
    {
        $query = self::find()
            ->asArray();

        $query->offset($params['offset'])
            ->limit($params['limit'])
            ->orderBy(['id' => SORT_DESC]);

        return $query->all();
    }

    public static function countAll()
    {
        return self::find()
            ->count();
    }
}
