<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\orm\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
$this->registerAssetBundle(yii\web\JqueryAsset::className(), \yii\web\View::POS_HEAD);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="event-form">



                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'style'=>'max-width:860px']) ?>

                <div class="input-group date" data-provider="datepicker">
                    <div style="width:150px">
                        <?= $form->field($model, 'date_begin')->textInput() ?>
                    </div>
                </div>


                <div class="input-group date" data-provider="datepicker">
                    <div style="width:250px">
                        <?= $form->field($model, 'date_end')->textInput() ?>
                    </div>
                </div>

            <div style="width:250px">
                <?php
                if($model->date_begin) {
                    $model->date_begin = date("d.m.Y H:i", (integer) $model->date_begin);
                }
                echo $form->field($model, 'date_begin')->widget(DateTimePicker::className(),[
                                'name' => 'dp_1',
                                'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                                'language' => 'ru',
                                'value'=> date("dd.mm.yyyy hh:ii",(integer) $model->date_begin),
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd.mm.yyyy hh:ii'
                            ]
                    ]);

                 ?>
             </div>










                <?= $form->field($model, 'description')->textarea(['rows' => 6, 'style'=>'max-width:860px']) ?>

                <?= $form->field($model, 'image')->fileInput() ?>




                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#event-date_begin').datepicker({
            language: "ru"
        });

        $('#event-date_end').datepicker({
            language: "ru"
        });


    });
</script>


<link href="/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/datepicker/js/bootstrap-datepicker.ru.min.js" charset="UTF-8"></script>


