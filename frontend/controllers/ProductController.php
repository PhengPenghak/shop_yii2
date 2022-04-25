<?php

namespace frontend\controllers;

use backend\models\Product;
use backend\models\ProductCategory;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class ProductsController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::class,
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  /**
   * Displays homepage.
   *
   * @return mixed
   */
  public function actionIndex($category = '')
  {

    $productCategory = ProductCategory::find()->all();

    $product = [];
    $product = Product::find()
      ->select(['product.*'])
      ->joinWith('category')
      ->where(['LOWER(product_category.name)' => strtolower($category)])
      ->all();

    $product = Yii::$app->db->createCommand("SELECT a.*
      FROM product a
      LEFT JOIN product_category b ON a.category_id = b.id
      WHERE b.`name` = :category
      ")
      ->bindParam(":category", $category)
      ->queryAll();

    if (empty($product) && $category == '') {
      $product = Product::find()->all();
    }
   
  
    return $this->render('index', [
      'productCategory' => $productCategory,
    ]);
  }
}