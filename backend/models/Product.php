<?php

namespace backend\models;

use Yii;
use yii\validators\SafeValidator;

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
    public $imageFile;
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
            [['name','price','status','image_url','category_id'], 'required'],
            [['category_id'], 'integer'],
            [['rate'], 'number'],
            [['status','name','product_create_date','image_url', 'description'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 100],
            [['imageFile'],'image','extensions' => 'png, jpg, jpeg, webp', 'maxSize' => 10 * 1024 * 1024],
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
            'status' => 'Status',
            'category_id' => 'Category Id',
            'price' => 'Price',
            // 'imageFile' => 'Product Image',
            'image_url' => 'Product Image',
            'description' => 'Description',
            'rate' => 'Rate',
            'product_create_date'=>'Create Date',
        ];
    }
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['category_id' => 'id']);
    }
    // public function save($runValidate = true, $attributeNames = null)
    // {
    //     if ($this->imageFile){
    //         $this->image = Yii::getAlias('@frontend/web/storage/products');
    //     }
       
    //     $ok = parent::save($runValidate, $attributeNames); 
    // }
}
