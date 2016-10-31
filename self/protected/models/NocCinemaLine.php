<?php

/**
 * This is the model class for table "noc_cinema_line".
 *
 * The followings are the available columns in table 'noc_cinema_line':
 * @property string $id
 * @property string $cinema_line_name
 * @property string $cinema_linename_py
 * @property string $contactor
 * @property string $mobile
 * @property string $note
 * @property string $create_time
 * @property string $email
 */
class NocCinemaLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'noc_cinema_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cinema_line_name, contactor', 'length', 'max'=>100),
			array('cinema_linename_py, mobile, note, email', 'length', 'max'=>200),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cinema_line_name, cinema_linename_py, contactor, mobile, note, create_time, email', 'safe', 'on'=>'search'),
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
			'cinema_line_name' => 'Cinema Line Name',
			'cinema_linename_py' => 'Cinema Linename Py',
			'contactor' => 'Contactor',
			'mobile' => 'Mobile',
			'note' => 'Note',
			'create_time' => 'Create Time',
			'email' => 'Email',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('cinema_line_name',$this->cinema_line_name,true);
		$criteria->compare('cinema_linename_py',$this->cinema_linename_py,true);
		$criteria->compare('contactor',$this->contactor,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NocCinemaLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
