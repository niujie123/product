<?php

/**
 * This is the model class for table "nj_user".
 *
 * The followings are the available columns in table 'nj_user':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property integer $status
 * @property integer $type
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property string $create_time
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nj_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, password', 'required', 'message'=>'{attribute}为必填项', 'on'=>'save'),
//			array('password', 'match','pattern'=>'/^[A-Za-z0-9\.\@\_\#]{6,}$/','message'=>'{attribute}格式为字母或数字或包含.@_#最少6位', 'on'=>'save'),
//            array('name', 'unique', 'message'=>'{attribute}用户名不可重复', 'on' => 'save'),
            array('name', 'second', 'message'=>'{attribute}用户名不可重复', 'on' => 'save'),
			array('status, type', 'numerical', 'integerOnly'=>true),
			array('name, last_login_ip', 'length', 'max'=>200, 'message'=>'{attribute}超过最大字符限制', 'on'=>'save'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, password, status, type, last_login_time, last_login_ip, create_time', 'safe', 'on'=>'search'),
			array('id, name, password, status, type, last_login_time, last_login_ip, create_time', 'safe'),
		);
	}

    public function second ($attribute, $params) {
        $res = User::model()->findAll('name=:name',array(':name'=>$this->name));
        if (count($res) > 0 && $res[0]->id!=$this->id) {

            $this->addError($attribute, '用户名不能重复!');
        }
    }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'group' => array(self::BELONGS_TO, 'AuthGroup', '', 'on'=>'t.type=group.id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '用户名',
			'password' => '密码',
			'status' => '状态',
			'type' => '分组',
			'last_login_time' => 'Last Login Time',
			'last_login_ip' => 'Last Login Ip',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getGroup () {
        $return = array();
        $groupList = AuthGroup::model()->findAll();
        foreach ($groupList as $key=>$val) {
            $return[$val->id] = $val->name;
        }
        return $return;
    }
}
