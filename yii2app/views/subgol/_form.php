<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubGolongan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-golongan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gol')->textInput() ?>

    <?= $form->field($model, 'sub_gol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
