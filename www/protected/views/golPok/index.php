<?php
/* @var $this GolPokController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gol Poks',
);

$this->menu=array(
	array('label'=>'Create GolPok', 'url'=>array('create')),
	array('label'=>'Manage GolPok', 'url'=>array('admin')),
);
?>

<h1>Gol Poks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
