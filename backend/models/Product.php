<?php

namespace backend\models;

use Yii;
use yii\validators\SafeValidator;
use yii\helpers\FileHelper;

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
            [['image_url'],'file'],
            [['rate'], 'number'],
            [['status','name','product_create_date','image_url', 'description'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 100],
            [['product_create_date'], 'safe'],
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
            'name' =>'Product Name',
            'image_url' => 'Product Image',
            'price' => 'Price',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'rate' => 'Rate',
            'product_create_date'=>'Create Date',
        ];
    }
    //  public function getCategory(){
    //     return $this->hasOne(ProductCategory::class, ['id' => 'category_id']);
    // }
    
    public function getImageUrl()
    {
        return str_replace("backend", 'frontend', Yii::$app->request->baseUrl) . "/upload/" . $this->image_url;
    }
   
}

