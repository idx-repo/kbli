<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GolonganPokok */

$this->title = 'Create Golongan Pokok';
$this->params['breadcrumbs'][] = ['label' => 'Golongan Pokoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-pokok-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
