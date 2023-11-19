<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model brussens\maintenance\models\Maintenance */

$this->title = Yii::t('maintenance', 'Update Maintenance Window');
$this->params['breadcrumbs'][] = ['label' => Yii::t('maintenance', 'Maintenance Windows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('maintenance', 'Update');
?>
<div class="maintenance-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
