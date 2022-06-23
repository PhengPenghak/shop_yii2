<?php

use app\assets\DaterangpickerAsset;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\LinkPager;
use yii\bootstrap4\Modal;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

DaterangpickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
// echo date('Y-m-d H:i:s');
?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],

    'method' => 'get',

]); ?>

<div class="product-index">
    <?php

    Modal::begin([
        'title' => 'Create Order',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
    ?>
    <h1><?= Html::encode($this->title) ?></h1>


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-hover',
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
            'class' => LinkPager::class,
        ],

        'layout' => '
            {items}
            <div class="row mb-3">
                <div class="col-lg-6">
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
            // [
            //     'attribute' => 'image_url',
            //     'label' => 'ProductImages',
            //     'content' => function ($model) {
            //         return Html::img($model->image_url, ['style' => 'width:100px;']);
            //     },
            //     'contentOptions' => [
            //         'style' => 'width:50px;',
            //     ],
            // ],

            'price:currency',
            [
                'attribute' => 'status',
                'content' => function ($model) {
                    /** @var \common\models\Product $model */

                    return Html::tag('span', $model->status ? 'Active' : 'Draft', [
                        'class' => $model->status ? 'badge badge-success' : 'badge badge-danger',
                    ]);
                },
            ],
            [
                'attribute' => 'created_date',
                'format' => 'datetime',
                'contentOptions' => ['style' => 'white-space:nowrap'],

            ],
            // [
            //     'attribute' => 'created_by',
            //     'format' => 'datetime',
            //     'contentOptions' => ['style' => 'white-space:nowrap'],

            // ],

            // 'created_date:datetime',
            // 'product_create_date',
            //'description',
            //'rate',
            // 'id',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }, 'header' => 'action',
            ],
        ],
    ]); ?>