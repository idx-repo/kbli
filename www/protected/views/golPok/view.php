<?php
$this->breadcrumbs=array(
	'Kategori: '.Kategori::model()->findByPk($golpok->kategori)->kd=>array('kategori/view','id'=>$golpok->kategori),
	'Golongan Pokok: '.$golpok->gol_pok.' '.$golpok->judul,
);

$this->menu=array(
	array('label'=>'Tambah Golongan', 'url'=>array('gol/create','id'=>$golpok->id)),
);
?>

<h1>Golongan Pokok</h1>
<h3><?php echo $golpok->gol_pok.' '.$golpok->judul; ?></h3>
<p><?php echo $golpok->deskripsi; ?></p>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search_gol',array(
	'model'=>$gol,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gol-grid',
	'dataProvider'=>$gol->search(),
	'filter'=>$gol,
	'columns'=>array(
		//'id',
		//'gol_pok',
		'gol',
		'judul',
		'deskripsi',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}',
			'buttons'=>array(
				'view'=>array(
					'url'=>'Yii::app()->createUrl("gol/view",array("id"=>$data->id))',
					),
				'update'=>array(
					'url'=>'Yii::app()->createUrl("gol/update",array("id"=>$data->id))',
					),
				),
		),
	),
)); ?>