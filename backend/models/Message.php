<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $content
 * @property string|null $created_at
 * @property int|null $is_read
 * @property int|null $order_id
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'is_read', 'order_id'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'created_at' => 'Created At',
            'is_read' => 'Is Read',
            'order_id' => 'Order ID',
        ];
    }
    public function getCustomerName()
    {
        return $this->customer->firstname . ' ' . $this->customer->lastname;
    }

    public function getCustomer()
    {
        return $this->hasOne(Orders::class, ['id' => 'order_id']);
    }
}
