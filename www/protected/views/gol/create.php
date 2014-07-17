<?php
/* @var $this GolController */
/* @var $model Gol */

$this->breadcrumbs=array(
	'Perekaman Golongan',
	Golpok::model()->findByPk($golpok)->gol_pok.' '.Golpok::model()->findByPk($golpok)->judul=>array('golpok/view','id'=>$golpok),
);
?>

<h1>Tambah Golongan</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'golpok'=>$golpok)); ?>