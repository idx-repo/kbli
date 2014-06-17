<?php
/* @var $this GolPokController */
/* @var $model GolPok */

$this->breadcrumbs=array(
	'Gol Poks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GolPok', 'url'=>array('index')),
	array('label'=>'Manage GolPok', 'url'=>array('admin')),
);
?>

<h1>Create GolPok</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>