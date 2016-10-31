<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property integer $id
 * @property string $url
 * @property string $method
 * @property string $project
 * @property integer $secret
 * @property string $field
 * @property integer $header_type
 * @property string $header_content
 * @property string $create_time
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, method, project, secret, field, header_type', 'required', 'message'=>'{attribute}为必填项', 'on'=>'save'),
			array('secret, header_type', 'numerical', 'integerOnly'=>true),
			array('url, method', 'length', 'max'=>200),
			array('project, field, header_content', 'length', 'max'=>500),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, url, method, project, secret, field, header_type, header_content, create_time', 'safe', 'on'=>'search'),
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
			'url' => '地址',
			'method' => '方法',
			'project' => '项目',
			'secret' => 'Secret',
			'field' => 'Field',
			'header_type' => 'Header Type',
			'header_content' => 'Header Content',
			'create_time' => 'Create Time',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('project',$this->project,true);
		$criteria->compare('secret',$this->secret);
		$criteria->compare('field',$this->field,true);
		$criteria->compare('header_type',$this->header_type);
		$criteria->compare('header_content',$this->header_content,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public $secretArr = array(
        '1' => '电商加密',
        '2' => '影讯加密',
        '3' => 'noc加密',
    );
}
