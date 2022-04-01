<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string|null $name
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public $category_name;
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['categort_name'],'safe']
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
  
}
