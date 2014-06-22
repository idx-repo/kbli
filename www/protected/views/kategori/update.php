<?php
/* @var $this KategoriController */
/* @var $model Kategori */

$this->breadcrumbs=array(
	'Kategori'=>array('index'),
	$model->kd,
	'Update'
);
?>

<h1>Update Kategori <?php echo $model->kd; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>