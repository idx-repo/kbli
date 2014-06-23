<?php
$this->breadcrumbs=array(
	'Golongan Pokok: '.GolPok::model()->findByPk($gol->gol_pok)->gol_pok=>array('golPok/view','id'=>$gol->gol_pok),
	'Golongan: '.$gol->gol.' '.$gol->judul,
);

$this->menu=array(
	array('label'=>'Tambah Sub Golongan', 'url'=>array('subGol/create','id'=>$gol->id)),
);
?>

<h1>Golongan</h1>
<h3><?php echo $gol->gol.' '.$gol->judul; ?></h3>
<p><?php echo $gol->deskripsi; ?></p>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search_subgol',array(
	'model'=>$subgol,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gol-grid',
	'dataProvider'=>$subgol->search(),
	'filter'=>$subgol,
	'columns'=>array(
		//'id',
		//'gol',
		'sub_gol',
		'judul',
		'deskripsi',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}',
			'buttons'=>array(
				'view'=>array(
					'url'=>'Yii::app()->createUrl("subGol/view",array("id"=>$data->id))',
					),
				'update'=>array(
					'url'=>'Yii::app()->createUrl("subGol/update",array("id"=>$data->id))',
					),
				),
		),
	),
)); ?>