<?php

/**
 * This is the model class for table "films".
 *
 * The followings are the available columns in table 'films':
 * @property integer $id
 * @property string $name
 * @property integer $timestamp
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Films extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $datetime ;
	public function tableName()
	{
		return 'films';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, user_id', 'required'),
			array('timestamp, user_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, timestamp, user_id', 'safe', 'on'=>'search'),
			array('id, name, timestamp, user_id,datetime,where,favorite', 'safe', 'on'=>'filmlist'),
			array('id, name, timestamp, user_id,datetime,favorite', 'safe', 'on'=>'userfilmlist'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'timestamp' => 'Timestamp',
			'user_id' => 'User',
			'datetime' => 'Date',
			'where' => 'Where',
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
		$criteria->compare('timestamp',$this->timestamp);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
			'pagination'=>array('pageSize'=>20),

		));
	}
		public function filmlist()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('favorite',$this->favorite);
		//$criteria->compare('timestamp',$this->timestamp);
		$criteria->compare('FROM_UNIXTIME(`timestamp`,"%Y-%m-%d %H:%i")', $this->datetime,true);
		$criteria->addCondition('user_id = '.Yii::app()->user->id);
	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
				'attributes'=>array(
				'datetime'=>array(
					'asc' => $expr = 'timestamp',
					'desc' => $expr.' DESC',
				),
				'name',
				),
			),
			'pagination'=>array('pageSize'=>20),

		));
	}		
	public function userfilmlist()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('user');
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('favorite',$this->favorite);
		//$criteria->compare('timestamp',$this->timestamp);
		$criteria->compare('FROM_UNIXTIME(`timestamp`,"%Y-%m-%d %H:%i")', $this->datetime,true);
		$criteria->addCondition('user.login = :login');
		$criteria->params[':login'] =  Yii::app()->request->getQuery('login');


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.id DESC',
				'attributes'=>array(
				'datetime'=>array(
					'asc' => $expr = 'timestamp',
					'desc' => $expr.' DESC',
				),
				'name',
				),
			),
			'pagination'=>array('pageSize'=>20),

		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Films the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getusername(){
		$user=Users::model()->findByPk($this->user_id);
		if(isset($user->login)){
			return $user->login;
		}else{
			return 'Anon';
		}
	}
	public function getStar($show_empty=true){
		if($this->favorite==1)
		$star="<img class='star' onclick='changeStar(".$this->id.")' src='".Yii::app()->baseUrl."/images/star.png'>";
		elseif($show_empty)
		$star="<img class='star' onclick='changeStar(".$this->id.")' src='".Yii::app()->baseUrl."/images/nostar.png'>";
		else $star="";
		return $star;
	}
	public function getStarStatic(){
		if($this->favorite==1)
		$star="<img src='".Yii::app()->baseUrl."/images/star.png'>";
		else
		$star="<img src='".Yii::app()->baseUrl."/images/nostar.png'>";
	
		return $star;
	}
}
