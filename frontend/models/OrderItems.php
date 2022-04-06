<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property string|null $product_name
 * @property int|null $product_id
 * @property int|null $quantity
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id','product_id', 'quantity'], 'integer'],
            [['unit_price', 'total_price'], 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
        ];
    }
}
