<?php

namespace backend\controllers;

use backend\models\Message;
use common\models\LoginForm;
use frontend\models\SignupForm;
use phpDocumentor\Reflection\PseudoTypes\False_;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'chat', 'message'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }
        $this->layout = "homepage";

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionChat()
    {
        return $this->render('chat');
    }
    public function actionMessage()
    {
        $userId = Yii::$app->user->id;
        $order_id = 1;

        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post('action') == 'submit') {

                $message = Yii::$app->request->post('message');
                $model = new Message();
                $model->order_id = $order_id;
                $model->content = $message;
                $model->is_read = 0;
                $model->created_at = date("Y-m-d H:i:s");
                if ($model->save()) {
                    return json_encode("Sucess");
                } else {
                    return json_encode("Error:" . $model->getErrors());
                }
            }
        }
        $user_id = Yii::$app->user->id;
        $totalmessage = Yii::$app->db->createCommand(
            "SELECT 
            user_id
            FROM `message`
            WHERE is_read = 0
            AND user_id IS NOT NULL
            AND user_id = :user_id 
            GROUP BY user_id"

        )->bindParam(':user_id', $user_id)
            ->queryAll();
        $current_user = Yii::$app->user->identity->id;
        $messageData = Message::find()
            ->where(['order_id' => $order_id])
            ->orderBy(['created_at' => SORT_ASC])
            ->all();
        return $this->render('message', [
            'messageData' => $messageData,
            'totalmessage' => $totalmessage
        ]);
    }
}
