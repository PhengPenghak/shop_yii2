<?php

namespace frontend\controllers;

use app\models\Cart;
use app\models\OrderAddress;
use app\models\OrderItems;
use app\models\Orders;
use backend\models\Message;
use backend\models\Product;
use common\models\LoginForm;
use common\models\User;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\Action;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\debug\models\search\Profile;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);
        $dataProvider->setPagination(['pageSize' => 8]);

        $product = Product::find()->all();
        $this->layout = "homepage";

        return $this->render('index', [
            'product' => $product,
            'dataProvider' => $dataProvider,

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
        $this->layout = "homepage";
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
        $this->layout = "homepage";

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
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {

        $this->layout = "homepage";
        return $this->render('about');
    }
    public function actionProduct()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);
        $dataProvider->setPagination(['pageSize' => 8]);
        $product = Product::find()->where(['product_category' => 2])->all();
        $this->layout = "homepage";
        return $this->render('product', [
            'product' => $product
        ]);
    }

    public function actionWhy()
    {
        $this->layout = "homepage";
        return $this->render('why');
    }

    public function actionTestimonial()
    {
        $this->layout = "homepage";
        return $this->render('testimonial');
    }
    public function actionProductDetail($id)
    {
        $model = $this->findProductModel($id);
        $this->layout = "homepage";
        return $this->render('product-detail', [
            'model' => $model,
        ]);
    }
    public function actionCheckout()
    {
        $model = new OrderAddress();
        $user = Yii::$app->user->identity;
        $model->firstName = $user->firstname;
        $model->lastName = $user->lastname;
        $model->email = $user->email;
        $totalPrice = (float) $this->getCartTotalPrice();
        if ($model->load(Yii::$app->request->post())) {
            $order = new Orders();
            $order->firstname = $model->firstName;
            $order->lastname = $model->lastName;
            $order->email = $model->email;
            $order->total_price = $totalPrice;
            $order->create_by = $user->getId();
            $order->created_at = date("Y-m-d h:i:s");
            if ($order->save()) {
                $current_cart = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
                if (!empty($current_cart)) {
                    foreach ($current_cart as $key => $value) {
                        $item = new OrderItems();
                        $item->order_id = $order->id;
                        $item->product_id = $value->product_id;
                        $item->quantity = $value->quantity;
                        $item->unit_price = $value->unit_price;
                        $item->total_price = $value->total_price;
                        $item->save();
                    }
                }
                Cart::deleteAll(['user_id' => Yii::$app->user->identity->id]);

                $model->order_id = $order->id;
                if ($model->save()) {
                    Yii::$app->session->setFlash("success", "Checkout successfully!");
                } else {

                    Yii::$app->session->setFlash("error", "Failed to checkout!");
                }
            } else {

                Yii::$app->session->setFlash("error", "Failed to checkout!");
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

        if ($this->request->isAjax && $this->request->isPost) {
            $userId = Yii::$app->user->id;
            $profile = Yii::$app->user->identity->username;
            $carts = Cart::find()->where(['user_id' => $userId])->all();
        }
        $this->layout = "homepage";
        $current_user = Yii::$app->user->identity->id;
        $carts = Yii::$app->db->createCommand(
            "SELECT  cart.*, product.`name`, product.image_url, product.price,product.id as pro_id
            FROM cart
            INNER JOIN product ON product.id = cart.product_id
            WHERE cart.user_id  = " . $current_user
        )->queryAll();
        $totalPrice = (float) $this->getCartTotalPrice();
        $totalCart = (int) Cart::find(['user_id' => $current_user])->count();
        return $this->render(
            'page-checkout',
            [
                'model' => $model,
                'carts' => $carts,
                'total_price' => $totalPrice,
                'total_cart' => $totalCart,
            ]
        );
    }
    public function actionMsi()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);
        $dataProvider->setPagination(['pageSize' => 8]);

        $this->layout = "homepage";
        $product_msi = Product::find()->where(['product_category' => 1])->all();
        return $this->render('product-msi', [
            'product_msi' => $product_msi,
            'dataProvider' => $dataProvider,

        ]);
    }
    public function actionAsus()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);
        $dataProvider->setPagination(['pageSize' => 8]);
        $this->layout = "homepage";
        $product_asus = Product::find()->where(['product_category' => 3])->all();
        return $this->render('product-asus', [
            'product_asus' => $product_asus,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDell()
    {
        $this->layout = "homepage";
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->all(),
        ]);
        $product_dell = Product::find()->where(['product_category' => 2])->all();
        return $this->render('product-dell', [
            'dataProvider' => $dataProvider,
            'product_dell' => $product_dell,
        ]);
    }
    public function actionMessage()
    {
        $order_id = 1;
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post('action') == 'submit') {

                $message = Yii::$app->request->post('message');
                $model = new Message();
                $model->order_id = $order_id;
                $model->content = $message;
                $model->is_read = 0;
                $model->user_id = Yii::$app->user->identity->id;
                $model->created_at = date("Y-m-d H:i:s");
                if ($model->save()) {
                    return json_encode("Sucess");
                } else {
                    return json_encode("Error:" . $model->getErrors());
                }
            }
        }
        $messageData = Message::find()
            ->where(['order_id' => $order_id])
            ->orderBy(['created_at' => SORT_ASC])
            ->all();
        return $this->render('message', [
            'messageData' => $messageData,

        ]);
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
                if (!$model) {
                    return json_encode(['success' => false, 'message' => 'Cart item not found!']);
                }

                if (!$model->delete()) {
                    return json_encode(['success' => false, 'message' => 'Unable to remove cart item']);
                }
                $totalPrice = (float) $this->getCartTotalPrice();
                $totalCart = (int) Cart::find(['user_id' => $current_user])->count();

                return json_encode([
                    'success' => true,
                    'total_price' => Yii::$app->formatter->asCurrency($totalPrice),
                    'total_cart' => $totalCart,
                ]);
            }
            if ($this->request->post('action') == 'update_qty') {
                $cartId = $this->request->post('cartId');
                $qty = $this->request->post('qty');
                $model = Cart::findOne($cartId);
                if (!$model) {
                    return json_encode(['status' => false, 'message' => 'no cart item found!']);
                }

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
                $cart->total_price = $cart->quantity * $cart->unit_price;
                if ($cart->save()) {
                    $current_user = Yii::$app->user->id;
                    $totalCart = Cart::find()
                        ->select(['SUM(quantity) quantity'])
                        ->where(['user_id' => $current_user])
                        ->one();
                    $totalCart = $totalCart->quantity;
                    return json_encode(['status' => 'success', 'totalCart' => $totalCart]);
                } else {
                    return json_encode(['status' => 'error', 'message' => $cart->getErrors()]);
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
        $totalPrice = (float) $this->getCartTotalPrice();
        $totalCart = (int) Cart::find(['user_id' => $current_user])->count();
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

    public function actionProfile()
    {
        $model = new Profile();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $model = User::findOne(Yii::$app->user->id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $imagename = Inflector::slug($model->status) . '-' . time();
            $model->image_url = UploadedFile::getInstance($model, 'image_url');
            $upload_path = ("profile/uploads/");
            if (!empty($model->image_url)) {
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                $model->image_url->saveAs($upload_path . $imagename . '.' . $model->image_url->extension);
                //save file uploaded to db
                $model->image_url = $imagename . '.' . $model->image_url->extension;
            }
            $userId = Yii::$app->user->id;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Profile updated successfully');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update profile');
            }

            return $this->redirect(["site/profile"]);
        }

        $this->layout = "homepage";

        return $this->render(
            'profile',
            [
                'model' => $model,
            ]
        );
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
