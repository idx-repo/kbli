<?php
/* @var $this GolPokController */
/* @var $model GolPok */

$this->breadcrumbs=array(
	'Gol Poks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GolPok', 'url'=>array('index')),
	array('label'=>'Create GolPok', 'url'=>array('create')),
	array('label'=>'View GolPok', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GolPok', 'url'=>array('admin')),
);
?>

<h1>Update GolPok <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>