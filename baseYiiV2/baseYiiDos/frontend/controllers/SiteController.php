<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\User;
use frontend\models\ContactForm;
use common\models\AccessHelpers;
use yii\helpers\Html;
use yii\web\Cookie;

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
                        'actions' => ['login', 'signup', 'confirm', 'request-password-reset', 'reset-password', 'access-denied', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'idioma'],
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
        return $this->render('index');
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
            AccessHelpers::getAccess();
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
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
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new User();
        if($model->load(Yii::$app->request->post())) {

            $model->generateAuthKey();
            $model->created_at = strtotime("now");
            $model->updated_at = strtotime("now");
            $model->status = 0;

            if(!$model->validate())
            {
                $model->password_hash = "";
                $model->password_repeat = "";

            } else {
                $model->setPassword($model->password_hash);
                $model->password_repeat = $model->password_hash;
                if(!$model->save())
                {
                    $model->password_hash = "";
                    $model->password_repeat = "";
                } else {

                    $user = User::find()->where(["email" => $model->email])->one();

                    $subject = "Confirmar registro";
                    $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
                    $body .= Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'id' => $user->id, 'authKey' => $user->authKey]);

                    Yii::$app->mailer->compose()
                    ->setTo($model->email)
                    ->setFrom([Yii::$app->params["supportEmail"] => 'prueba'])
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();

                    return $this->render('signup', [
                        'model' => $model, 'mailTrue' => true,
                    ]);
                }
            }
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
                return $this->render('requestPasswordResetToken', [
                    'model' => $model, 'mailTrue' => true,
                ]);
            } else {
                return $this->render('requestPasswordResetToken', [
                    'model' => $model, 'mailTrue' => false,
                ]);
            }
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
        } catch (InvalidParamException $e) {
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

    public function actionConfirm()
    {
        if (Yii::$app->request->get())
        {
            $id = $_GET["id"];
            $authKey = $_GET["authKey"];
            $table = User::find()->where("id=:id", [":id" => $id])->andWhere("auth_key=:authKey", [":authKey" => $authKey]);
            if((int) $id)
            {
                if($table->count() == 1)
                {
                    $model = User::findOne($id);
                    $model->status = 10;
                    $model->password_repeat = $model->password_hash;
                    if($model->save())
                    {
                        return $this->render('confirm', [
                            'model' => $model, 'result' => true,
                        ]);
                    } else {
                        return $this->render('confirm', [
                            'model' => $model, 'result' => false,
                        ]);
                    }

                } else {
                    return $this->redirect(["site/login"]);
                }

            } else {
                return $this->redirect(["site/login"]);
            }
        }
    }

    public function actionIdioma() {
        $supportedLanguages = ['en', 'es'];
        $language = isset(Yii::$app->request->cookies['language']) ? (string) Yii::$app->request->cookies['language'] : null;
        if (empty($language)) {
            $language = Yii::$app->request->getPreferredLanguage($supportedLanguages);
        }
        $language = ($language == 'es') ? 'en' : 'es';
        //  $language = Yii::$app->request->post('language');
        $languageCookie = new Cookie([
            'name' => 'language',
            'value' => $language,
            'expire' => time() + 60 * 60 * 24 * 30, // 30 days
        ]);
        Yii::$app->language = $language;
        Yii::$app->session->setFlash('success', "Idioma cambiado a : " . $language);
        Yii::$app->response->cookies->add($languageCookie);
        return $this->redirect(['site/index']);
    }

    public function actionAccessDenied()
    {
        return $this->render('accessDenied');
    }

}
