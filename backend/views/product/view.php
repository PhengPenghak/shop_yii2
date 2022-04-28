<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'category_id',
            'price:currency',
            [
                'attribute' => 'status',
                'format'=>['html'],
                'value' => fn() =>Html::tag('span', $model->status ? 'Active' : 'Draft', ['class' => $model->status ? 'badge badge-success' : 'badge badge-danger'])
            ],
            [
                'attribute' => 'image_url',
                'label' => 'ProductImage',
                'format'=>['html'],
                'value'=> fn()=>Html::img($model->imageUrl, ['style' => 'width:100px;']),


               
                
            ],
            //'image_url:url',
            'description',
            'rate',
            'product_category',
        ],
    ]) ?>

</div>
