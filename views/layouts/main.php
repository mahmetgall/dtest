<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\assets\AppAsset;
use app\widgets\Alert;
use app\widgets\Wowslider;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="main">


        <div class="container">

            <?= Alert::widget() ?>

        </div>

        <div class="container">
            <div class="row top_menu">
                <div class="col-md-1">О нас</div>
                <div class="col-md-1">Контакты</div>
                <div class="col-md-3">

                    <?php $form = ActiveForm::begin(['id' => 'seek', 'action'=>'/site/seek', 'method'=>'POST']); ?>
                    <div class="input-group poisk" >

                        <input name='seek' type="text" class="form-control" placeholder="поиск" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2"><span onclick="document.getElementById('seek').submit();" class="glyphicon glyphicon-search" aria-hidden="true"></span></span>

                    </div>
                    <?php ActiveForm::end(); ?>
                </div>

                <div class="col-md-2 ">

                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Тэги<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            $Tags = $this->params['Tags'];
                            foreach ($Tags as $tag) {
                                echo '<li><a onclick="tag('.$tag['id'].');" href="#">'.$tag['name'].'</a></li>';
                            }

                            ?>

                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-md-push-1 talignr"><?= Yii::$app->user->isGuest ? '<a href="/signup">Зарегистрироваться</a>' : '<a href="/profile">Личный кабинет</a>'?></div>
                <div class="col-md-1 col-md-push-1 talignr"><?= Yii::$app->user->isGuest ? '<a href="/login">Войти</a>' : '<a href="/logout">Выйти</a>'?></div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <a href="/"><img class="logo" src="/images/logo.jpg" width="100px"></a>
                </div>
                <div class="col-lg-6">
                <h1 class="title">Мероприятия Казани</h1>
                </div>
                <div class="col-lg-4 talignr">

                </div>

            </div>

            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Главная', 'url' => '/'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

            ]);?>


            <?php

            echo Wowslider::widget();

            ?>
        </div>




        <?= $content ?>


    </div main>
</div wrap>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script src="/js/bootstrap-dropdown.js"></script>
<script>

    // вывод по тегу
    function tag(id)
    {
        window.location.href = '/site/tag/' + id;

    }


</script>




</body>
</html>
<?php $this->endPage() ?>
