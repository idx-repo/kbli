<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kelompok-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php if ($model->isNewRecord) { ?>
	<div class="row">
		<?php echo $form->hiddenField($model,'sub_gol',array('value'=>$subgol)); ?>
		<?php echo $form->error($model,'sub_gol'); ?>
	</div>
	<?php }; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kelompok'); ?>
		<?php echo $form->textField($model,'kelompok',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kelompok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judul'); ?>
		<?php echo $form->textField($model,'judul',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'judul'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deskripsi'); ?>
		<?php echo $form->textArea($model,'deskripsi',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'deskripsi'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->