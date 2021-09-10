<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubGolongan */

$this->title = 'Ubah Sub Golongan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Golongan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="sub-golongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
