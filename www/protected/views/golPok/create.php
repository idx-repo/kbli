<?php
/* @var $this GolPokController */
/* @var $model GolPok */

$this->breadcrumbs=array(
	'Perekaman Golongan Pokok',
	Kategori::model()->findByPk($kategori)->kd.' '.Kategori::model()->findByPk($kategori)->judul=>array('kategori/view','id'=>$kategori),
);
?>

<h1>Perekaman Golongan Pokok</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'kategori'=>$kategori)); ?>