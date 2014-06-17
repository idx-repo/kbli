<?php
/* @var $this SubGolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sub Gols',
);

$this->menu=array(
	array('label'=>'Create SubGol', 'url'=>array('create')),
	array('label'=>'Manage SubGol', 'url'=>array('admin')),
);
?>

<h1>Sub Gols</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
