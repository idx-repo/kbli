<?php
/* @var $this SubGolController */
/* @var $model SubGol */

$this->breadcrumbs=array(
	'Sub Gols'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SubGol', 'url'=>array('index')),
	array('label'=>'Create SubGol', 'url'=>array('create')),
	array('label'=>'View SubGol', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SubGol', 'url'=>array('admin')),
);
?>

<h1>Update SubGol <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>