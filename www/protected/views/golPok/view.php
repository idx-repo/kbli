<?php
/* @var $this GolPokController */
/* @var $model GolPok */

$this->breadcrumbs=array(
	'Gol Poks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GolPok', 'url'=>array('index')),
	array('label'=>'Create GolPok', 'url'=>array('create')),
	array('label'=>'Update GolPok', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GolPok', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GolPok', 'url'=>array('admin')),
);
?>

<h1>View GolPok #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kategori',
		'gol_pok',
		'judul',
		'deskripsi',
	),
)); ?>
