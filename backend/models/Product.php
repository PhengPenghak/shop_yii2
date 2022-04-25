<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $status
 * @property int|null $category_id
 * @property string|null $price
 * @property string|null $image_url
 * @property string|null $description
 * @property float|null $rate
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['name','price','status','category_id'], 'required'],
            [['image_url'], 'file'],
            [['rate'], 'number'],
            [['status', 'name', 'created_at', 'created_by', 'image_url', 'description'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 100],
            // [['release_date'], 'safe']
            // [['image_url'],'image','extensions' => 'png, jpg, jpeg, webp', 'maxSize' => 10 * 1024 * 1024],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Product Name',
            'image_url' => 'Product Image',
            'price' => 'Price',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'rate' => 'Rate',
            // 'created_at' => 'Create Ad',
            // 'created_by' => 'Create By',
            // 'release_date'=> 'Create Date',
        ];
    }
   
    public function getImageUrl()
    {
        return str_replace("backend", 'frontend', Yii::$app->request->baseUrl) . "/upload/" . $this->image_url;
    }
    public function getCategory(){
        
        return $this->hasOne(ProductCategory::class,['id' => 'category_id']);
    }
}
