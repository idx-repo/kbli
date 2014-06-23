<?php
class SubGolController extends Controller
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
		$subgol=$this->loadModel($id);
		$kelompok=new Kelompok('search');
		$kelompok->unsetAttributes();
		if(isset($_GET['Kelompok'])) {
			$kelompok->attributes=$_GET['Kelompok'];
		} else {
			$kelompok->sub_gol=$id;
		};
		$this->render('view',array('subgol'=>$subgol,'kelompok'=>$kelompok));
	}

	public function actionCreate($id)
	{
		$model=new SubGol;
		if(isset($_POST['SubGol']))
		{
			$model->attributes=$_POST['SubGol'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array('model'=>$model,'gol'=>$id));
	}
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['SubGol']))
		{
			$model->attributes=$_POST['SubGol'];
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
		$model=SubGol::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sub-gol-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
