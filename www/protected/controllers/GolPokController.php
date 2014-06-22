<?php
class GolPokController extends Controller
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
		$golpok=$this->loadModel($id);
		$gol=new Gol('search');
		$gol->unsetAttributes();  // clear any default values
		if(isset($_GET['Gol'])) $gol->attributes=$_GET['Gol'];
		$this->render('view',array(
			'golpok'=>$golpok,
			'gol'=>$gol,
		));
	}

	public function actionCreate($id)
	{
		$model=new GolPok;
		if(isset($_POST['GolPok']))
		{
			$model->attributes=$_POST['GolPok'];
			if($model->save()) $this->redirect(array('kategori/view','id'=>$id));
		}
		$this->render('create',array('model'=>$model,'kategori'=>$id,));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['GolPok']))
		{
			$model->attributes=$_POST['GolPok'];
			if($model->save()) $this->redirect(array('kategori/view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('GolPok');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function loadModel($id)
	{
		$model=GolPok::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadGol($id)
	{
		$model=Gol::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gol-pok-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
