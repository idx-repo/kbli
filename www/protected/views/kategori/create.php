<?php
/* @var $this KategoriController */
/* @var $model Kategori */

$this->breadcrumbs=array(
	'Perekaman'=>array('index'),
	'Kategori',
);

?>

<h1>Tambah Kategori</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>