<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use app\models\Config;
use app\models\Right;



/* @var $this yii\web\View */





?>
<div class="container">
    <?php
        $this->title = 'Мои мероприятия:';
        $this->params['breadcrumbs'][] = $this->title;
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <br>
                <div class="prof">
                    <div class="prof_title">
                        Личный кабинет
                    </div>

                    <?= Html::a('Мои мероприятия', ['/profile']); ?>
                    <br>
                    <?= Html::a('Профиль', ['/profile/info']); ?>
                    <?php
                        // пункт показывается только админу
                        if (Right::isAdmin()) {
                            echo '<br>';
                            echo Html::a('Управление мероприятиями', ['/event']);
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-8" >


                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Мои мероприятия:</h1>
                            <table class="zakaz">
                                <tr>

                                    <td class="bold">Дата
                                    <td class="bold">Название
                                    <td class="bold">Описание
                                        <?php
                                        foreach ($Events as $event){
                                        ?>
                                            <tr>
                                                <td><?= Html::a($event['date_begin'] ? Config::date_to_str_short($event['date_begin']): '', ['/site/view/', 'id' => $event['id']]); ?>
                                                <td><?= Html::a($event['name'], ['/site/view/', 'id' => $event['id']]); ?>
                                                <td><?= Html::a($event['description'], ['/site/view/', 'id' => $event['id']]); ?>


                                        <?php

                                        }

                                        ?>


                            </table>



                        </div>
                    </div>





            </div>
        </div>
        <br><br>
    </div>




</div>

