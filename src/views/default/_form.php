<?php

use brussens\maintenance\Module;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model brussens\maintenance\models\Maintenance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maintenance-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-inline',
        ]
    ]); ?>

    <?= $form->field($model, 'date')->widget(DatePicker::class, [
        'class' => 'form-control',
        'dateFormat' => Module::getInstance()->dateFormat,
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'time_start')->input('time') ?>

    <?= $form->field($model, 'time_end')->input('time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('maintenance', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
