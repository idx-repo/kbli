<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\icons\Icon;

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
            //['class' => 'yii\grid\SerialColumn'],

            //'id', 'kategori',
            'gol_pok',
            'judul',
            'deskripsi:ntext',

            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{view}{update}{delete}',
               'buttons' => [
                 'view' => function ($url, $model) {
                     return Html::a('V', ['golpok/view', 'id' => $model->id], ['class' => 'btn btn-success']);
                     },
                 'update' => function ($url, $model) {
                     return Html::a('U', ['golpok/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                     },
                 'delete' => function ($url, $model) {
                     return Html::a('D', ['golpok/delete', 'id' => $model->id], ['class' => 'btn btn-danger']);
                     },
                 ],
            ],
        ],
    ]); ?>

</div>
