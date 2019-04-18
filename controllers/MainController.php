<?php

namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use app\models\Tag;


class MainController extends Controller
{




    public function beforeAction($action)
    {
        $this->view->params['Tags'] = Tag::find()->asArray()->orderBy('name')->all();;
        return parent::beforeAction($action);
    }


}
