<?php

/**
 * This is the model class for table "noc_cinema".
 *
 * The followings are the available columns in table 'noc_cinema':
 * @property string $id
 * @property integer $cinema_line_id
 * @property integer $cinema_cias_id
 * @property string $cid
 * @property string $linkid
 * @property string $unicode
 * @property string $name
 * @property string $tel
 * @property string $address
 * @property string $introduction
 * @property string $opentime
 * @property string $drive_route
 * @property integer $city_id
 * @property integer $district_id
 * @property string $lat
 * @property string $lon
 * @property integer $machine_type
 * @property integer $hall_count
 * @property string $updatetime
 * @property integer $del
 * @property integer $support_max
 * @property string $eyeglass3d_desc
 * @property string $children_ticket
 * @property integer $support_goods
 * @property string $goods_desc
 * @property integer $support_park
 * @property string $park_desc
 * @property integer $support_entertainment
 * @property string $entertainment_desc
 * @property string $contactor
 * @property string $mobile
 * @property string $note
 * @property string $create_time
 * @property string $zhidian_ratio
 * @property string $cinema_ratio
 * @property integer $status
 * @property integer $device_num
 */
class NocCinema extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'noc_cinema';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cinema_line_id, cinema_cias_id, city_id, district_id, machine_type, hall_count, del, support_max, support_goods, support_park, support_entertainment, status, device_num', 'numerical', 'integerOnly'=>true),
			array('cid, linkid, unicode, lat, lon', 'length', 'max'=>30),
			array('name', 'length', 'max'=>100),
			array('tel, opentime, contactor', 'length', 'max'=>50),
			array('address, eyeglass3d_desc, children_ticket, goods_desc, park_desc, entertainment_desc', 'length', 'max'=>255),
			array('drive_route', 'length', 'max'=>500),
			array('mobile, zhidian_ratio, cinema_ratio', 'length', 'max'=>20),
			array('note', 'length', 'max'=>200),
			array('introduction, updatetime, create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cinema_line_id, cinema_cias_id, cid, linkid, unicode, name, tel, address, introduction, opentime, drive_route, city_id, district_id, lat, lon, machine_type, hall_count, updatetime, del, support_max, eyeglass3d_desc, children_ticket, support_goods, goods_desc, support_park, park_desc, support_entertainment, entertainment_desc, contactor, mobile, note, create_time, zhidian_ratio, cinema_ratio, status, device_num', 'safe', 'on'=>'search'),
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
            'id' => '影院编号',
            'cinema_line_id' => '院线表外键ID',
            'cinema_cias_id' => 'CIAS影院ID',
            'cid' => '平台影院ID',
            'linkid' => 'linkid',
            'unicode' => '专资ID',
            'name' => '影院名称',
            'tel' => '客服电话',
            'address' => '影院地址',
            'introduction' => '影院的简介',
            'opentime' => '营业时间',
            'drive_route' => '驾车路线',
            'city_id' => '城市ID',
            'district_id' => '区县ID',
            'lat' => '纬度',
            'lon' => '经度',
            'machine_type' => '终端机取票类型：0 影院前台，1 嘉禾终端机',
            'hall_count' => '影厅数量',
            'updatetime' => '最后一次更新时间',
            'del' => '可用标志 0 不可用,1 可用',
            'support_max' => '是否支持MAX或巨幕 0 支持 1 不支持',
            'eyeglass3d_desc' => '3d眼睛有关备注',
            'children_ticket' => '儿童票有关备注',
            'support_goods' => '是否支持购物 0 支持 1 不支持',
            'goods_desc' => '卖品描述',
            'support_park' => '是否有停车位,0 支持 1 不支持 ',
            'park_desc' => '车位备注',
            'support_entertainment' => '是否有娱乐场所,0 有 1 没有',
            'entertainment_desc' => '娱乐场所备注',
            'contactor' => '联系人',
            'mobile' => '联系电话',
            'note' => '影院备注',
            'create_time' => '创建时间',
            'isSetContactor'=>'是否设置联系人',
            //自定义属性
            'viewProvinceName'=>'省份名称',
            'viewWideName'=>'区域名称',
            'viewCityName'=>'城市名称',
            'cinemaLineName'=>'院线名称',
            'cinema_line_name'=>'院线名称',
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
		$criteria->compare('cinema_line_id',$this->cinema_line_id);
		$criteria->compare('cinema_cias_id',$this->cinema_cias_id);
		$criteria->compare('cid',$this->cid,true);
		$criteria->compare('linkid',$this->linkid,true);
		$criteria->compare('unicode',$this->unicode,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('introduction',$this->introduction,true);
		$criteria->compare('opentime',$this->opentime,true);
		$criteria->compare('drive_route',$this->drive_route,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('lon',$this->lon,true);
		$criteria->compare('machine_type',$this->machine_type);
		$criteria->compare('hall_count',$this->hall_count);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('del',$this->del);
		$criteria->compare('support_max',$this->support_max);
		$criteria->compare('eyeglass3d_desc',$this->eyeglass3d_desc,true);
		$criteria->compare('children_ticket',$this->children_ticket,true);
		$criteria->compare('support_goods',$this->support_goods);
		$criteria->compare('goods_desc',$this->goods_desc,true);
		$criteria->compare('support_park',$this->support_park);
		$criteria->compare('park_desc',$this->park_desc,true);
		$criteria->compare('support_entertainment',$this->support_entertainment);
		$criteria->compare('entertainment_desc',$this->entertainment_desc,true);
		$criteria->compare('contactor',$this->contactor,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('zhidian_ratio',$this->zhidian_ratio,true);
		$criteria->compare('cinema_ratio',$this->cinema_ratio,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('device_num',$this->device_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NocCinema the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    //获取区域名称
    public function getViewWideName(){
        return yii::app()->db->createCommand("select t2.cityname from yii_city t left join yii_city t1 on t.pid=t1.id left join yii_city t2 on t1.pid=t2.id where t.id=:city_id")->bindValue(':city_id', $this->city_id)->queryScalar();
    }

    //获取省份名称
    public function getViewProvinceName(){
        return yii::app()->db->createCommand("select t1.cityname from yii_city t left join yii_city t1 on t.pid=t1.id where t.id=:city_id")->bindValue(':city_id', $this->city_id)->queryScalar();
    }

    //获取城市名称
    public function getViewCityName(){
        return yii::app()->db->createCommand("select t.cityname from yii_city t where t.id=:city_id")->bindValue(':city_id', $this->city_id)->queryScalar();
    }

    //获取院线名称
    public function getCinemaLineName(){
        return yii::app()->db->createCommand("select t.cinema_line_name from noc_cinema_line t where t.id=:cinema_line_id")->bindValue(':cinema_line_id',$this->cinema_line_id)->queryScalar();
    }
}
