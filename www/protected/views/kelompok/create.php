<?php
$this->breadcrumbs=array(
	'Sub Golongan: '.SubGol::model()->findByPk($subgol)->sub_gol=>array('subGol/view','id'=>$subgol),
	'Tambah Kelompok',
);
?>

<h1>Tambah Kelompok</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'subgol'=>$subgol)); ?>