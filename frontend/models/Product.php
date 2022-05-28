<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string|null $status
 * @property string|null $price
 * @property string|null $image_url
 * @property string|null $description
 * @property float|null $rate
 * @property int|null $category_id
 * @property string|null $created_date
 * @property string|null $created_by
 * @property string|null $product_category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\uploadedFile
     */
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }
    public $image_url;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['rate'], 'number'],
            [['category_id'], 'integer'],
            [['created_date'], 'safe'],
            [['imageFile'], 'file'],
            [['name'], 'string', 'max' => 250],
            [['status', 'image_url', 'created_by', 'product_category'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 500],
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
            'status' => 'Status',
            'price' => 'Price',
            'image_url' => 'Image Url',
            'description' => 'Description',
            'rate' => 'Rate',
            'category_id' => 'Category ID',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'product_category' => 'Product Category',
        ];
    }

}
