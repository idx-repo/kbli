<?php

/**
 * This is the model class for table "kelompok".
 *
 * The followings are the available columns in table 'kelompok':
 * @property integer $id
 * @property integer $sub_gol
 * @property string $kelompok
 * @property string $judul
 * @property string $deskripsi
 */
class Kelompok extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kelompok';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sub_gol, kelompok, judul', 'required'),
			array('sub_gol', 'numerical', 'integerOnly'=>true),
			array('kelompok', 'length', 'max'=>5),
			array('judul', 'length', 'max'=>200),
			array('deskripsi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sub_gol, kelompok, judul, deskripsi', 'safe', 'on'=>'search'),
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
			'sub_gol' => 'Sub Gol',
			'kelompok' => 'Kelompok',
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
		$criteria->compare('sub_gol',$this->sub_gol);
		$criteria->compare('kelompok',$this->kelompok,true);
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
	 * @return Kelompok the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
