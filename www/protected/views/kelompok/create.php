<?php
/* @var $this KelompokController */
/* @var $model Kelompok */

$this->breadcrumbs=array(
	'Kelompoks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kelompok', 'url'=>array('index')),
	array('label'=>'Manage Kelompok', 'url'=>array('admin')),
);
?>

<h1>Create Kelompok</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>