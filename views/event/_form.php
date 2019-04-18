<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\orm\ActiveForm;
use kartik\datetime\DateTimePicker;
use app\Models\Event;
use dosamigos\selectize\SelectizeTextInput;

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



                <div style="width:250px">
                    <?php
                    if($model->date_begin) {
                        //$model->date_begin = date("d.m.Y H:i", (integer) $model->date_begin);
                    }
                    echo $form->field($model, 'date_begin')->widget(DateTimePicker::className(),[
                                    'name' => 'dp_1',
                                    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                                    'language' => 'ru',
                                    'value'=> date("dd.mm.yyyy hh:ii",(integer) $model->date_begin),
                                    'removeButton' => false,
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'dd.mm.yyyy hh:ii'
                                ]
                        ]);

                     ?>
                 </div>

                <div style="width:250px">
                    <?php
                    if($model->date_end) {
                        //$model->date_end = date("d.m.Y H:i", (integer) $model->date_end);
                    }
                    echo $form->field($model, 'date_end')->widget(DateTimePicker::className(),[
                        'name' => 'dp_1',
                        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                        'language' => 'ru',
                        'value'=> date("dd.mm.yyyy hh:ii",(integer) $model->date_end),
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'dd.mm.yyyy hh:ii'
                        ]
                    ]);

                    ?>
                </div>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'style'=>'max-width:860px']) ?>


                <?= $form->field($model, 'description')->textarea(['rows' => 6, 'style'=>'max-width:860px']) ?>


                <?php
                    if (!empty($model->id && !empty($model->image))) {
                        echo '<img src="' . '/'.Event::IMAGE_PATH.'/' . Event::IMAGE_SMALL_PREF . $model->image. '">';
                    }

                ?>

                <?= $form->field($model, 'fimage')->fileInput() ?>

<?=
                $form->field($model, 'tagNames')->widget(SelectizeTextInput::className(), [
                // calls an action that returns a JSON object with matched
                // tags
                'loadUrl' => ['event/list'],
                'options' => ['class' => 'form-control'],
                'clientOptions' => [
                'plugins' => ['remove_button'],
                'valueField' => 'name',
                'labelField' => 'name',
                'searchField' => ['name'],
                'create' => true,
                ],
                ])->hint('Введите теги')
?>


                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
