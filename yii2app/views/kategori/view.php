<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Kategori */

$this->title = $model->kd . ' ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kategori-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Yakin akan menghapus?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'kd',
            'judul',
            'deskripsi:ntext',
        ],
    ]) ?>

    <p>
        <?= Html::a('Tambah Golongan Pokok', ['golpok/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id', 'kategori',
            'gol_pok',
            'judul',
            'deskripsi:ntext',

            [
               'class' => 'yii\grid\ActionColumn'
               'template' => '{view}{update}{delete}',
               'buttons' => [
                 'view' => function ($url, $model) {
                     return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'view'),
                            ]);
                     },
                 'update' => function ($url, $model) {
                     return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'update'),
                            ]);
                     },
                 'delete' => function ($url, $model) {
                     return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'delete'),
                            ]);
                     }
               'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'view') {
                    $url ='index.php?r=golpok/view&id='.$model->id;
                    return $url;
                    }
                  if ($action === 'update') {
                    $url ='index.php?r=golpok/update&id='.$model->id;
                    return $url;
                    }
                 if ($action === 'delete') {
                    $url ='index.php?r=golpok/delete&id='.$model->id;
                    return $url;
                    }
                 }
              ],
            ],
        ],
    ]); ?>

</div>
