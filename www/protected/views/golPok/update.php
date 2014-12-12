<?php
/* @var $this GolPokController */
/* @var $model GolPok */

$this->breadcrumbs=array(
	'Kategori: '.Kategori::model()->findByPk($model->kategori)->kategori=>array('kategori/view','id'=>$model->kategori),
	'Update: '.$model->judul,
);

?>

<h1>Update Golongan Pokok </h1>
<h3><?php echo $model->gol_pok.' '.$model->judul; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>