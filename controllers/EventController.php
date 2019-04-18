<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

use app\models\Event;
use app\models\EventForm;
use app\models\User;
use app\models\Config;
use app\models\Tag;


/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends MainController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

            // доступ к контроллеру только админу
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],

                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->date_begin = Config::timestamp_to_str($model->date_begin);
        $model->date_end = Config::timestamp_to_str($model->date_end);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Event();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {

            $model->date_begin = Config::strdate_to_timestamp($model->date_begin);
            $model->date_end = Config::strdate_to_timestamp($model->date_end);

            $model->fimage = UploadedFile::getInstance($model, 'fimage');

            $fileName = 'image_' . Yii::$app->user->id . '_' . time() . '.' . $model->fimage->extension;
            $model->image = $fileName;

            if ($model->save()) {
                if ($model->saveImage($fileName)) {
                    return $this->redirect(['/event']);
                }

            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->date_begin = Config::timestamp_to_str($model->date_begin);
        $model->date_end = Config::timestamp_to_str($model->date_end);

        if ($model->load(Yii::$app->request->post())) {

            $attr = $model->attributes;

            $model->fimage = UploadedFile::getInstance($model, 'fimage');

            $model->date_begin = Config::strdate_to_timestamp($_POST['Event']['date_begin']);
            $model->date_end = Config::strdate_to_timestamp($_POST['Event']['date_end']);


            if ($model->fimage) {
                $fileName = 'image_' . Yii::$app->user->id . '_' . time() . '.' . $model->fimage->extension;
                $model->image = $fileName;
            }

            if ($model->save()) {
                if ($model->fimage) {
                    $model->saveImage($fileName);
                }
                return $this->redirect(['/event']);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // On TagController (example)
    // actionList to return matched tags
    public function actionList($query)
    {

        $models = Tag::find()->where(['like', 'name', $query])->all();

        //$models = Tag::find()->where(['name' => $query])->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }
        // We know we can use ContentNegotiator filter
        // this way is easier to show you here :)
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $items;
    }
}
