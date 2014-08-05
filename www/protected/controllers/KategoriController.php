<?php
class KategoriController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','view','create','update'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$kategori=$this->loadModel($id);
		$golpok=new GolPok('search');
		$golpok->unsetAttributes();  // clear any default values
		if(isset($_GET['GolPok'])) {
			$golpok->attributes=$_GET['Gol'];
		} else {
			$golpok->kategori = $id;
		};
		$this->render('view',array(
			'kategori'=>$kategori,
			'golpok'=>$golpok,
		));
	}

	public function actionCreate()
	{
		$model=new Kategori;
		if(isset($_POST['Kategori']))
		{
			$model->attributes=$_POST['Kategori'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array('model'=>$model));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Kategori']))
		{
			$model->attributes=$_POST['Kategori'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array('model'=>$model));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$model=new Kategori('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kategori']))
			$model->attributes=$_GET['Kategori'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Kategori::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadGolPok($id)
	{
		$model=GolPok::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kategori-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
