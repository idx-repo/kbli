<?php
/* @var $this KelompokController */
/* @var $model Kelompok */

$this->breadcrumbs=array(
	'SubGolongan: '.SubGol::model()->findByPk($model->sub_gol)->judul => array('/subGol/view','id'=>$model->sub_gol),
	'Kelompok: '.$model->judul,
);
$this->menu=array(
	array('label'=>'Update', 'url'=>array('kelompok/update','id'=>$model->id)),
);
?>

<h1>View Kelompok: <?php echo $model->judul; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>array(),
	'attributes'=>array(
		array('name'=>'kelompok','value'=>$model->kelompok),
		array('name'=>'judul','value'=>$model->judul),
		array('name'=>'deskripsi','value'=>nl2br($model->deskripsi)),
	),
)); ?>
