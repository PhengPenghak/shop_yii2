<?php

namespace console\controllers;



use backend\daemons\ChatServer;
use consik\yii2websocket\WebSocketServer;
use yii\console\Controller;
class ServerController extends Controller

{

  public function actionStart($port = null)

  {

    $server = new ChatServer();

    if ($port) {

      $server->port = $port;
    }

    $server->start();
  }
}
