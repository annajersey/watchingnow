<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $role
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Advice[] $advices
 * @property Advice[] $advices1
 */
class Users extends CActiveRecord
{	const ROLE_ADMIN = 'admin';
    const ROLE_MODER = 'moderator';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';
	public $password2; 	public $image;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password, role, email, name', 'required', 'on'=>'create'),
			array('name, email', 'required', 'on'=>'update'),
			array('login, password, name, password2', 'length', 'max'=>255),
			array('activation_key', 'length', 'max'=>1000),
			array('role', 'length', 'max'=>20),
			array('password', 'authenticate', 'on' => 'login'),
			array('password2', 'compare', 'compareAttribute'=>'password', 'on'=>'changepass,create'),
			array('image','ImageValidator','minWidth'=>50,'maxWidth'=>100,'minHeight'=>50,'maxHeight'=>100,'allowEmpty'=>true ),
			array('image', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true ),
			 array('email','email'),
			 array('login,email', 'unique', 'on'=>'create'),
		
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password, role, name', 'safe', 'on'=>'search'),
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
			// 'advices' => array(self::HAS_MANY, 'Advice', 'from'),
			// 'advices1' => array(self::HAS_MANY, 'Advice', 'to'),
		 );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'password' => 'Password',
			'password2' => 'Password Confirm',
			'role' => 'Role',
			'name' => 'Name, Lastname',
			'email' => 'Email',
			'activation_key'=>'activation_key'
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('name',$this->name,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	
	public function authenticate($attribute, $params) { 
		if(!$this->hasErrors()) { 
			$identity = new UserIdentity($this->login, $this->password);
			$identity->authenticate();
			
			switch($identity->errorCode) {
				case UserIdentity::ERROR_NONE: {
					Yii::app()->user->login($identity, 3600*24*30);
					break;
				}
				case UserIdentity::ERROR_USERNAME_INVALID: {
					$this->addError('login','User not found!');
					break;
				}
				 case UserIdentity::ERROR_ACTIVE_INVALID: {
					 $this->addError('login','User not active!');
					 break;
				 }
				case UserIdentity::ERROR_PASSWORD_INVALID: {
					$this->addError('password','Password is wrong!');
					break;
				}
			}
		}else{ echo CHtml::errorSummary($this); }
	}
	public function IsBanned($banned_user_id,$ip){
			$find = BanUsers::model()->findByAttributes(array('user_id'=>$this->id,'ban_user_id'=>$banned_user_id));
			$find2 = BanUsers::model()->findByAttributes(array('user_id'=>$this->id,'ip'=>$ip));
			 if($find || $find2) return true;
			 return false;
	}
	public function HasBlacklist(){
		if(Yii::app()->user->isGuest) return false;
		$find = BanUsers::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		if($find) return true;
			 return false;
		
	}
}
