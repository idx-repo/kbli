<?php
/* @var $this GolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gols',
);

$this->menu=array(
	array('label'=>'Create Gol', 'url'=>array('create')),
	array('label'=>'Manage Gol', 'url'=>array('admin')),
);
?>

<h1>Gols</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
