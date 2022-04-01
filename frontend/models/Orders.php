<?php

namespace app\models;
use common\models\Order;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property float|null $total_price
 * @property string|null $status
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $transaction
 * @property string|null $created_at
 * @property string|null $create_by
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
            [['status', 'firstname', 'lastname', 'email', 'transaction', 'created_at'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'transaction' => 'Transaction',
            'created_at' => 'Created At',
            'create_by' => 'Create By',
            
        ];
        
    }
}
