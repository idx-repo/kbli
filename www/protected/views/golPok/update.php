<?php
/* @var $this GolPokController */
/* @var $model GolPok */

$this->breadcrumbs=array(
	'Golongan Pokok',
	$model->gol_pok.' '.$model->judul=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update Golongan Pokok</h1>
<h3><?php echo $model->gol_pok.' '.$model->judul; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>