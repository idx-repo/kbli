<?php
/* @var $this SubGolController */
/* @var $model SubGol */

$this->breadcrumbs=array(
	'SubGolongan: '.Gol::model()->findByPk($model->gol)->gol=>array('gol/view','id'=>$model->gol),
	'Update: '.$model->judul,
);
?>

<h1>Update SubGolongan <?php echo $model->judul; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>