<?php

namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Event;
use app\models\User;
use app\models\EventUser;
use app\models\Tag;


class SiteController extends MainController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
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
     * @return string
     */
    public function actionIndex()
    {
        $Events = Event::find()->asArray()->orderBy('id DESC')->all();

        return $this->render('index',
            [
                'Events' => $Events,

            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSeek()
    {
        $Events = [];
        if (!empty($_POST['seek'])) {


            $seek = trim($_POST['seek']);

            $Events = Event::find()->where(['like', 'name', $seek])
                ->orderBy('id DESC')
                ->asArray()->all();

        }

        return $this->render('index',
            [
                'Events' => $Events,

            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTag($id)
    {
        $Events = [];
        if (!empty($id)) {
            $Events = Event::find()->innerJoinWith(['tags' =>
                    function($query)  use ($id) {$query->andWhere('tag.id = '. $id);}]
            )->asArray()->all();

        }

        return $this->render('index',
            [
                'Events' => $Events,

            ]
        );
    }


    /**
     * Просмотр события
     *
     * @return string
     */
    public function actionView($id)
    {
        $model = Event::find()->where(['id' => $id])->asArray()->one();

        return $this->render('view',
            [
                'model' => $model,

            ]
        );
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
        if ($model->load(Yii::$app->request->post())){
            if($model->login()) {
                return $this->goBack();
            }
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

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($user = $model->signup()) {
                $auth = Yii::$app->authManager;
                // задать пользователю роль - user
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $user->getId());
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
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
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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



    /*
     * Подписаться на мероприятие
     */
    public function actionSign()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {

            $result = Yii::$app->request->post();

            if (isset($result['event_id'])) {
                $event_id = (int)$result['event_id'];
                $event_user = EventUser::find()->where(['user_id' => Yii::$app->user->id, 'event_id' => $event_id])->one();

                if (empty($event_user)) {
                   $event_user = new EventUser();
                   $event_user->user_id = Yii::$app->user->id;
                   $event_user->event_id = $event_id;

                   if ($event_user->save()) {
                       \Yii::$app->response->statusCode = 200;
                       return ['status' => 'ok'];
                   }

                } else {
                    \Yii::$app->response->statusCode = 423;
                    return ['status' => 'Вы уже зарегистрированы на этом мероприятии'];
                }

            }

            \Yii::$app->response->statusCode = 404;
            return ['status' => 'error'];
        }
    }





    /*
     * Создание ролей
     * существуют:
     * admin, manager, user
     */
    public function actionRbac() {



        return;

        $auth = Yii::$app->authManager;


        $author = $auth->createRole('user');


        $auth->add($author);
        die('ok');
        return;

    }
}
