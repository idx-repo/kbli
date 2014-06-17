<?php

/**
 * This is the model class for table "gol".
 *
 * The followings are the available columns in table 'gol':
 * @property integer $id
 * @property integer $gol_pok
 * @property string $gol
 * @property string $judul
 * @property string $deskripsi
 */
class Gol extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gol';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gol_pok, gol, judul', 'required'),
			array('gol_pok', 'numerical', 'integerOnly'=>true),
			array('gol', 'length', 'max'=>3),
			array('judul', 'length', 'max'=>200),
			array('deskripsi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gol_pok, gol, judul, deskripsi', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gol_pok' => 'Gol Pok',
			'gol' => 'Gol',
			'judul' => 'Judul',
			'deskripsi' => 'Deskripsi',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('gol_pok',$this->gol_pok);
		$criteria->compare('gol',$this->gol,true);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gol the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
