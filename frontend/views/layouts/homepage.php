<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>" class="h-100">

<head>
  <meta charset="<?=Yii::$app->charset?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $this->registerCsrfMetaTags()?>
  <title>z<?=Html::encode($this->title)?></title>
  <?php $this->head()?>
</head>

<body class="d-flex flex-column h-100">

  <?php $this->beginBody()?>
  <?=$this->render('header');?>

  <main>

    <?=Alert::widget()?>
    <?=
$content
?>
  </main>
  <footer>
    <?=$this->render('footer');?>
  </footer>
  <?php $this->endBody()?>
</body>

</html>

<?php $this->endPage()?>