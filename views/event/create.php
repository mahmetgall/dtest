<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = 'Новое мероприятие';
$this->params['breadcrumbs'][] = ['label' => 'Управление мероприятиями', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="event-create">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
