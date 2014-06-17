<?php
/* @var $this GolController */
/* @var $model Gol */

$this->breadcrumbs=array(
	'Gols'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gol', 'url'=>array('index')),
	array('label'=>'Manage Gol', 'url'=>array('admin')),
);
?>

<h1>Create Gol</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>