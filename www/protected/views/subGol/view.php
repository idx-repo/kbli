<?php
$this->breadcrumbs=array(
	'Golongan: '.Gol::model()->findByPk($subgol->gol)->gol=>array('gol/view','id'=>$subgol->gol),
	'Sub Golongan: '.$subgol->sub_gol.' '.$subgol->judul,
);

$this->menu=array(
	array('label'=>'Tambah Kelompok', 'url'=>array('kelompok/create','id'=>$subgol->id)),
	array('label'=>'Update Sub Golongan', 'url'=>array('subGol/update','id'=>$subgol->id)),
);
?>

<h1>Sub Golongan</h1>
<h3><?php echo $subgol->sub_gol.' '.$subgol->judul; ?></h3>
<p><?php echo nl2br($subgol->deskripsi); ?></p>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search_kelompok',array(
	'model'=>$kelompok,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gol-grid',
	'dataProvider'=>$kelompok->search(),
	'filter'=>$kelompok,
	'columns'=>array(
		//'id',
		//'sub_gol',
		'kelompok',
		'judul',
		'deskripsi',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}',
			'buttons'=>array(
				'view'=>array(
					'url'=>'Yii::app()->createUrl("kelompok/view",array("id"=>$data->id))',
					),
				'update'=>array(
					'url'=>'Yii::app()->createUrl("kelompok/update",array("id"=>$data->id))',
					),
				),
		),
	),
)); ?>
