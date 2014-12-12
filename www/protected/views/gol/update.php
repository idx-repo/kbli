<?php
/* @var $this GolController */
/* @var $model Gol */

$this->breadcrumbs=array(
	'Golongan Pokok: '.GolPok::model()->findByPk($model->gol_pok)->gol_pok=>array('golPok/view','id'=>$model->gol_pok),
	'Update: '.$model->judul,
);
?>

<h1>Update Golongan <?php echo $model->judul; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>