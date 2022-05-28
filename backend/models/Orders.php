<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property float|null $total_price
 * @property string|null $status
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $transaction
 * @property string|null $email
 * @property string|null $created_at
 * @property int|null $create_by
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_price'], 'number'],
            [['create_by'], 'integer'],
            [['status', 'firstname', 'lastname', 'transaction', 'email', 'created_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total_price' => 'Total Price',
            'status' => 'Status',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'transaction' => 'Transaction',
            'email' => 'Email',
            'created_at' => 'Created At',
            'create_by' => 'Create By',
        ];
    }
}
