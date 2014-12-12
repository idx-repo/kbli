<?php
/* @var $this KelompokController */
/* @var $model Kelompok */

$this->breadcrumbs=array(
	'Kelompoks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update Kelompok <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>