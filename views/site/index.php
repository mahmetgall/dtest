<?php
use yii\helpers\Html;
use app\models\Event;

/* @var $this yii\web\View */
$this->registerAssetBundle(yii\web\JqueryAsset::className(), \yii\web\View::POS_HEAD);
?>
<div class="container">
    <div class="cat">
        <div class="row">
            <?php
            // вывод мероприятий
            echo '';
            foreach ($Events as $event) {
                echo '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">';
                    echo '<div class="cat_area">';
                        echo '<img height="224" src="' . '/'.Event::IMAGE_PATH.'/' . Event::IMAGE_SMALL_PREF . $event['image']. '">';
                        echo '<div class="cat_name">';
                        echo Html::a($event['name'], ['/site/view', 'id' => $event['id']]);
                        echo '</div>';
                        echo '<div class="cat_sign">';
                        if (!Yii::$app->user->isGuest) {
                            echo '<span data-event_id="' . $event['id'] . '" class="sign span_sign">Подписаться</span>';
                        }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            }
            ?>
        </div>

    </div>


</div>

<script src="/js/sign.js"></script>