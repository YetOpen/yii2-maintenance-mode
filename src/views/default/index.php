<?php

use brussens\maintenance\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel brussens\maintenance\models\MaintenanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('maintenance', 'Maintenance Windows');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-index">

    <p>
        <?= Html::a(Yii::t('maintenance', 'New Maintenance Window'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'date',
                'format' => 'date',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date',
                    'class' => 'form-control',
                    'dateFormat' => Module::getInstance()->dateFormat,
                    'options' => [
                        'class' => 'form-control',
                    ],
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                    ],
                ])
            ],
            [
                'attribute' => 'time_start',
                'format' => 'time',
            ],
            [
                'attribute' => 'time_end',
                'format' => 'time',
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'created_by',
                'value' => 'createdBy.'.Module::getInstance()->userDisplayAttribute,
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'updated_by',
                'value' => 'updatedBy.'.Module::getInstance()->userDisplayAttribute,
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
