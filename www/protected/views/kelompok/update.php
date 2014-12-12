<?php
/* @var $this KelompokController */
/* @var $model Kelompok */

$this->breadcrumbs=array(
	'SubGolongan: '.SubGol::model()->findByPk($model->sub_gol)->judul => array('/subGol/view','id'=>$model->sub_gol),
	'Kelompok: '.$model->judul,
);

?>

<h1>Update Kelompok <?php echo $model->judul; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>