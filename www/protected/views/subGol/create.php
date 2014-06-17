<?php
/* @var $this SubGolController */
/* @var $model SubGol */

$this->breadcrumbs=array(
	'Sub Gols'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SubGol', 'url'=>array('index')),
	array('label'=>'Manage SubGol', 'url'=>array('admin')),
);
?>

<h1>Create SubGol</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>