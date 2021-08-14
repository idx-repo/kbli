<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kelompok */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelompok-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sub_gol')->textInput() ?>

    <?= $form->field($model, 'kelompok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
