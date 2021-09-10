<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubGolongan */

$this->title = 'Tambah Sub Golongan';
$this->params['breadcrumbs'][] = ['label' => 'Sub Golongan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-golongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
