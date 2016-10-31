<?php

/**
 * This is the model class for table "{{city}}".
 *
 * The followings are the available columns in table '{{city}}':
 * @property string $id
 * @property integer $pid
 * @property string $cityname
 * @property integer $level
 * @property string $pinyin
 * @property string $grade
 * @property string $lat
 * @property integer $hot
 * @property string $lon
 * @property string $note
 * @property string $create_time
 */
class City extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, cityname, level', 'required'),
			array('pid, level, hot', 'numerical', 'integerOnly'=>true),
			array('cityname, pinyin', 'length', 'max'=>50),
			array('grade, note', 'length', 'max'=>200),
			array('lat, lon', 'length', 'max'=>20),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pid, cityname, level, pinyin, grade, lat, hot, lon, note, create_time', 'safe', 'on'=>'search'),
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
			'id' => 'Id',
			'pid' => 'Pid',
			'cityname' => 'Cityname',
			'level' => 'Level',
			'pinyin' => 'Pinyin',
			'grade' => 'Grade',
			'lat' => 'Lat',
			'hot' => 'Hot',
			'lon' => 'Lon',
			'note' => 'Note',
			'create_time' => 'Create Time',
            'areaList'=>'区域名称',
            'provinceList'=>'省份名称',
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
		$criteria->compare('pid',$this->pid);
		$criteria->compare('cityname',$this->cityname,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('pinyin',$this->pinyin,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('hot',$this->hot);
		$criteria->compare('lon',$this->lon,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('create_time',$this->create_time,true);

        $criteria->limit =20;
        $criteria->offset =10;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return City the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAreaList()
    {
        $model = City::model()->findAllByAttributes(array('pid'=>0));
        return CHtml::listData($model, 'id', 'cityname');
    }

    public function getProvinceList($pid)
    {
        $model = @City::model()->findAllByAttributes(array('pid'=>$pid));
        return CHtml::listData($model, 'id', 'cityname');
    }

    public function getCityList($pid)
    {
        $model = @City::model()->findAllByAttributes(array('pid'=>$pid));
        return CHtml::listData($model, 'id', 'cityname');
    }

    public function getCityName($id)
    {
        $model = City::model()->findByPk($id);
        return $model->name;
    }
}
