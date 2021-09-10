<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kelompok */

$this->title = 'Ubah Kelompok: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kelompok', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="kelompok-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
