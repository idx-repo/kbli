<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kelompok */

$this->title = 'Tambah Kelompok';
$this->params['breadcrumbs'][] = ['label' => 'Kelompok', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelompok-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
