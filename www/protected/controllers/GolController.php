<?php
class GolController extends Controller
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
				'actions'=>array('view','create','update'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$gol=$this->loadModel($id);
		$subgol=new SubGol('search');
		$subgol->unsetAttributes();
		if(isset($_GET['SubGol'])) {
			$subgol->attributes=$_GET['SubGol'];
		} else {
			$subgol->gol = $id;
		};
		$this->render('view',array('gol'=>$gol,'subgol'=>$subgol));
	}

	public function actionCreate($id)
	{
		$model=new Gol;
		if(isset($_POST['Gol']))
		{
			$model->attributes=$_POST['Gol'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array('model'=>$model,'golpok'=>$id));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Gol']))
		{
			$model->attributes=$_POST['Gol'];
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

	public function loadModel($id)
	{
		$model=Gol::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gol-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
