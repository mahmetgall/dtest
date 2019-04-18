<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Config;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мероприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="event-index">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Создать мероприятие', ['create'], ['class' => 'btn btn-success']) ?>
                </p>


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'name',
                        [
                            'attribute' => 'date_begin',
                            'value' => function ($model) {
                                return Config::timestamp_to_str($model->date_begin);
                            },
                        ],
                        [
                            'attribute' => 'date_end',
                            'value' => function ($model) {
                                return Config::timestamp_to_str($model->date_end);
                            },
                        ],
                        'status',


                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
