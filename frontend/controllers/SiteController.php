<?php

namespace frontend\controllers;

use app\models\Cart;
use app\models\OrderItems;
use backend\models\Product;
use backend\models\ProductCategory;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\ActiveDataProvider;
use Bar;
use yii\base\Action;
use yii\base\Model;
use yii\web\NotFoundHttpException;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
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
    public function actionIndex()
    {
        $product = Product::find()->all();
        $this->layout = "homepage";
        return $this->render('index', [
            'product' => $product
        ]);
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */


    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }
        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    public function actionAbout()
    {
        $this->layout = "homepage";
        return $this->render('about');
    }
    public function actionProduct()
    {

        $product = Product::find()->all();
        $this->layout = "homepage";

        return $this->render('product', [
            'product' => $product,
        ]);
    }


    public function actionWhy()
    {
        $this->layout = "homepage";
        return $this->render('why');
    }

    public function actionProductDetail($id)
    {
        $model = $this->findProductModel($id);

        $this->layout = "homepage";
        return $this->render('product-detail', [
            'model' => $model,
        ]);
    }
    public function actionTestimonial()
    {
        $this->layout = "homepage";
        return $this->render('testimonial');
    }
    public function actionCheckout()
    {
        $this->layout = "homepage";
        return $this->render('page-checkout');
    }

    /**
     * TODO: it should be actionDependent
     *
     * @return 
     */
    public function actionCart()
    {
        if ($this->request->isAjax) {


            if ($this->request->post('action') == 'remove_cart_item') {
                $id = $this->request->post('id');
                $current_user = Yii::$app->user->identity->id;
                $model = Cart::findOne($id);
                if (!$model) return json_encode(['success' => false, 'message' => 'Cart item not found!']);

                if (!$model->delete()) {
                    return json_encode(['success' => false, 'message' => 'Unable to remove cart item']);
                }
                $totalPrice = (float)$this->getCartTotalPrice();
                $totalCart = (int)Cart::find(['user_id' => $current_user])->count();

                return json_encode([
                    'success' => true,
                    'total_price' => Yii::$app->formatter->asCurrency($totalPrice),
                    'total_cart' => $totalCart
                ]);
            }
            if ($this->request->post('action') == 'update_qty') {
                $cartId = $this->request->post('cartId');
                $qty = $this->request->post('qty');
                $model = Cart::findOne($cartId);
                if (!$model) return json_encode(['status' => false, 'message' => 'no cart item found!']);
                $model->quantity = $qty;
                if (!$model->update()) {
                    return json_encode(['status' => false, 'message' => 'updated']);
                }
            }

            if ($this->request->post('action') == 'add-to-cart') {
                $id = $this->request->post('id');
                $userId = Yii::$app->user->id;
                $product = Product::findOne($id);
                // return $id;
                // exit;
                $cart = Cart::find()->where(['product_id' => $id, 'user_id' => $userId])
                    ->one();
                if ($cart) {
                    $cart->quantity++;
                } else {
                    $cart = new Cart();
                    $cart->user_id = $userId;
                    $cart->product_id = $id;
                    $cart->quantity = 1;
                }
                $cart->unit_price = $product->price;
                $cart->total_price = $cart->quantity *  $cart->unit_price;
                if ($cart->save()) {
                    $current_user = Yii::$app->user->id;
                    $totalCart = Cart::find()
                        ->select(['SUM(quantity) quantity'])
                        ->where(['user_id' => $current_user])
                        ->one();
                    $totalCart = $totalCart->quantity;
                    return json_encode(['status' => 'success', 'totalCart' => $totalCart]);
                } else {
                    return json_encode(['status' => 'error', 'message' => $cart->getErrors()]);;
                }
            }
        }
    }
    /**
     * TODO: It should be actionCart
     *
     * @return
     */
    public function actionPage()
    {

        $this->layout = "homepage";
        $current_user = Yii::$app->user->identity->id;
        $carts = Yii::$app->db->createCommand(
            "SELECT  cart.*, product.`name`, product.image_url, product.price
            FROM cart
            INNER JOIN product ON product.id = cart.product_id 
            WHERE cart.user_id = " . $current_user
        )->queryAll();
        $totalPrice = (float)$this->getCartTotalPrice();
        $totalCart = (int)Cart::find(['user_id' => $current_user])->count();
        return $this->render('page-cart', ['carts' => $carts, 'total_price' => $totalPrice, 'total_cart' => $totalCart]);
    }
    private function getCartTotalPrice()
    {
        $current_user = Yii::$app->user->identity->id;
        return Yii::$app->db->createCommand("SELECT 
                SUM(cart.quantity * product.price) as total_price
                FROM cart
                INNER JOIN product ON product.id = cart.product_id
                WHERE user_id = :userId
        ")->bindParam("userId", $current_user)->queryScalar();
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findProductModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}