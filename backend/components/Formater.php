
<?php
namespace backend\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Formater extends component
{
  public function fmDate($date)
  {
    return date_format(date_create($date), 'Y, M d');
  }
}
