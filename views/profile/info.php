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
        $this->title = 'Моя информация:';
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
                        echo Html::a('Управление мероприятиями', ['/event/list']);
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-8" >


                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Моя информация:</h1>

                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <div><b>Email: </b>
                                <?= $model->username; ?>
                            </div>
                            <br>


                            <?= $form->field($model, 'fio') ?>


                            <div class="form-group">
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                            <hr>
                            <h2>Для изменения пароля, введите новый пароль:</h2>
                            <?php $form = ActiveForm::begin(['id' => 'pass-signup']); ?>

                            <?= $form->field($password, 'password')->passwordInput() ?>
                            <?= $form->field($password, 'password_repeat')->passwordInput() ?>
                            <div class="form-group">
                                <?= Html::submitButton('Изменить пароль', ['class' => 'btn btn-primary', 'name' => 'pass-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>





                        </div>
                    </div>





            </div>
        </div>
        <br><br>
    </div>




</div>


<script>
    $(function() {
        var id_city = $('#signupform-id_city').val();
        // выбран другой город
        if (id_city == 1){

            $('.show_city_name').css('display', 'block');
        }else{
            $('.show_city_name').css('display', 'none');
            $('.city_name').val('id');

        }

    });


    function showCity(e){
        var id_city = $(e).val();
        // выбран другой город
        if (id_city == 1){
            $('.city_name').val('');
            $('.show_city_name').css('display', 'block');
        }else{
            $('.show_city_name').css('display', 'none');
            $('.city_name').val('id');

        }
    }
</script>

