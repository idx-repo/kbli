<?php
$this->breadcrumbs=array(
	'Kategori'=>array('index'),
	$kategori->kd.' '.$kategori->judul,
);

$this->menu=array(
	array('label'=>'Tambah Golongan Pokok', 'url'=>array('golPok/create','id'=>$kategori->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#gol-pok-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $kategori->kd.': '.$kategori->judul; ?></h1>
<p><?php echo $kategori->deskripsi; ?>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search_golpok',array(
	'model'=>$golpok,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gol-pok-grid',
	'dataProvider'=>$golpok->search(),
	'filter'=>$golpok,
	'columns'=>array(
		'id',
		'kategori',
		'gol_pok',
		'judul',
		'deskripsi',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}',
			'buttons'=>array(
				'view'=>array(
					'url'=>'Yii::app()->createUrl("golPok/view",array("id"=>$data->id))',
					),
				'update'=>array(
					'url'=>'Yii::app()->createUrl("golPok/update",array("id"=>$data->id))',
					),
				),
		),
	),
)); ?>
