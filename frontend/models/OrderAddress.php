<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_address".
 *
 * @property int $id
 * @property int|null $order_id
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $zipcode
 */
class OrderAddress extends \yii\db\ActiveRecord
{

    public $firstName;
    public $lastName;

    public $email;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'email'], 'required'],
            [['id', 'order_id'], 'integer'],
            [['address', 'city', 'state', 'country', 'zipcode', 'firstName', 'lastName'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'zipcode' => 'Zipcode',
        ];
    }
}
