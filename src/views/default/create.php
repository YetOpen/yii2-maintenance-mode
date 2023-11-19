<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model brussens\maintenance\models\Maintenance */

$this->title = Yii::t('maintenance', 'Create Maintenance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('maintenance', 'Maintenance Windows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
