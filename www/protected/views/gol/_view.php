<?php
/* @var $this GolController */
/* @var $data Gol */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gol_pok')); ?>:</b>
	<?php echo CHtml::encode($data->gol_pok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gol')); ?>:</b>
	<?php echo CHtml::encode($data->gol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judul')); ?>:</b>
	<?php echo CHtml::encode($data->judul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi); ?>
	<br />


</div>