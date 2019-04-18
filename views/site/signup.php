<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация:';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="site-signup">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Для регистрации заполните следующие поля::</p>

                <div class="row">
                    <div class="col-lg-5">

                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username') ?>



                            <?= $form->field($model, 'password')->passwordInput() ?>
                            <?= $form->field($model, 'password_repeat')->passwordInput() ?>


                            <?= $form->field($model, 'fio') ?>




                        <div class="form-group">
                                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
