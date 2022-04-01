<?php
use yii\bootstrap4\LinkPager;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\rbac\Item;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>


  <div class="float-right">       
    <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
 </div>
<div class="clearfix"></div>
  

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions'=> [
            'class'=> 'table table-hover',
        ],
        'layout'=> '
            {items}
            <div class="row mb-3">
                <div class="col-lg-4">
                   {summary}
                </div>
                    <div class="col-lg-6">
                        {pager}
                    </div>
            </div>
        ',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'name',

            // [
            //     'attribute' => 'release_date',
            //     'value' => function ($model) {
            //         $formater = Yii::$app->formater;
            //         return $formater->fmDate($model->release_date);
            //     }
            // ],
            //show image in backend
            [
                'attribute' => 'image_url',
                'label' => 'ProductImage',
                'content' => function ($model) {
                    return Html::img($model->imageUrl, ['style' => 'width:150px;']);
                },
                'contentOptions' => [
                    'style' => 'width:50px;'
                ]
            ],
            
            'price:currency',
            [
                'attribute' => 'status',
                'content' => function($model){
                /** @var \common\models\Product $model */

                return Html::tag('span', $model->status ? 'Active' : 'Draft', [
                    'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                ]);
                }
            ],

            // 'image_url:url',
            // 'product_create_date',
            //'description',
            //'rate',
            // 'id',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column){
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
                 ,'header'=>'action',
            ],
        ],
    ]); ?>


</div>
