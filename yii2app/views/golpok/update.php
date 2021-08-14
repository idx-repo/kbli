<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GolonganPokok */

$this->title = 'Update Golongan Pokok: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Golongan Pokoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="golongan-pokok-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
