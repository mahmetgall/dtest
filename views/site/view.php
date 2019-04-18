<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Config;
use app\models\Event;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model['name'];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(yii\web\JqueryAsset::className(), \yii\web\View::POS_HEAD);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="event-view">

                <h1><?= Html::encode($this->title) ?></h1>

                <h3>Начало:</h3>
                <?= Config::timestamp_to_str($model['date_begin']) ?>
                <h3>Окончание:</h3>
                <?= Config::timestamp_to_str($model['date_end']) ?>
                <h3>Адрес проведения:</h3>
                <?= $model['address'] ?>
                <h3>Описание:</h3>
                <?= $model['description'] ?>

                <hr>

                <?php
                if (!empty($model['image'])) {
                    echo '<img src="' . '/'.Event::IMAGE_PATH.'/' . Event::IMAGE_SMALL_PREF . $model['image']. '">';
                }

                ?>
                <hr>
                <p>
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        echo '<button data-event_id = "'.$model['id'].'" class="sign btn btn-primary">Зарегистрироваться</button >';
                    }
                    ?>

                </p>
                <br>


            </div>
        </div>
    </div>
</div>

<script src="/js/sign.js"></script>
