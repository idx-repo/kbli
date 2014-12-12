<?php
/* @var $this KategoriController */
/* @var $model Kategori */

$this->breadcrumbs=array(
	'Kategori'=>array('index'),
	'Update :'.$model->judul,
);
?>

<h1>Update Kategori <?php echo $model->judul; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>