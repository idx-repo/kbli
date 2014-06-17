<?php
/* @var $this KelompokController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kelompoks',
);

$this->menu=array(
	array('label'=>'Create Kelompok', 'url'=>array('create')),
	array('label'=>'Manage Kelompok', 'url'=>array('admin')),
);
?>

<h1>Kelompoks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
