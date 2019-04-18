<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = 'Редактирование: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

        <div class="event-update">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
        </div>
    </div>
</div>
