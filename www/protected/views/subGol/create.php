<?php
$this->breadcrumbs=array(
	'Golongan: '.SubGol::model()->findByPk($gol)->gol=>array('gol/view','id'=>$gol),
	'Tambah Sub Golongan'
);
?>

<h1>Tambah Sub Golongan</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'gol'=>$gol)); ?>