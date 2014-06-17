<?php
/* @var $this SubGolController */
/* @var $model SubGol */

$this->breadcrumbs=array(
	'Sub Gols'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SubGol', 'url'=>array('index')),
	array('label'=>'Create SubGol', 'url'=>array('create')),
	array('label'=>'Update SubGol', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SubGol', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SubGol', 'url'=>array('admin')),
);
?>

<h1>View SubGol #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gol',
		'sub_gol',
		'judul',
		'deskripsi',
	),
)); ?>
