<?php
namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\SignupForm;
use app\models\Password;
use app\models\Event;



/**
 * Profile controller
 */
class ProfileController extends MainController
{
    public function actionIndex($id = 0)
    {
        $Events = Event::find()->innerJoinWith(['users' =>
                function($query) {$query->andWhere('user.id = '. Yii::$app->user->id);}]
        )->asArray()->all();

        return $this->render('index',
            [
                'Events' =>$Events,
            ]
        );

    }

    /*
     * просмотр профиля
     */
    public function actionInfo()
    {

        $mUser = User::findIdentity(Yii::$app->user->id);
        if (!$mUser){
            die('error');
        }

        $model = new SignupForm();
        $model->username = $mUser->username;
        $model->fio = $mUser->fio;

        $password = new Password();

        if ($model->load(Yii::$app->request->post())) {
            $mUser->fio = $model->fio;
            if (!$mUser->save()) {
                var_dump($mUser->getErrors());
                die();
            }
        }

        if ($password->load(Yii::$app->request->post())) {
            $mUser->setPassword($password->password);
            $mUser->generateAuthKey();
            $mUser->save();
            $password = new Password();
        }

        return $this->render('info',
            [
                'model' => $model,
                'password' => $password,
            ]
        );

    }

}