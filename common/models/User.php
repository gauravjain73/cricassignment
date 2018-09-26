<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\components\AccessRule;

/**
 * User model
 *
 * @property integer $id
 * @property string $password_hash
 * @property string $repassword
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $fname
 * @property string $lname
 * @property integer $address
 * @property integer $mobile
 * @property integer $landline
 * @property integer $profile_image
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
   // const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
  
	const UTID_AGENT = 2;
	const UTID_BUYER = 3;
	const UTID_ADMIN = 1;
	const UTID_SELLER = 4;
	const UTID_VENDOR = 5;
	const UTID_SUBADMIN = 6;
	
    /**
     * @inheritdoc
     */
     public $file;
     public $repassword;
     public $name;

    public static function tableName()
    {
        return '{{%in_users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['file'], 'file'],
            [['profile_image'], 'file', 'extensions'=>'jpg, gif, png, jpeg'],
           [['fname', 'lname', 'email', 'password_hash', 'repassword'], 'required', 'on'=>['update']],
            ['utid', 'default', 'value' => self::UTID_ADMIN],
			[['repassword'], 'compare', 'compareAttribute' => 'password_hash'],		
		    ['email', 'required'],
            ['email', 'email'],
           ['email', 'Checkuniqueemail', 'on'=>['update']],
        ];
    }
    
     /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password_hash' => 'Password',
            'repassword' => 'Retype Password',
            'fname' => 'First Name',
            'lname' => 'Last Name',
           // 'username' => 'User Name',
            'status' => 'Status', 
            'name' => 'Name',       
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);      
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
      
      
    public static function isUserAdmin($email)
	{
		
		  if (static::findOne(['email' => $email, 'utid' => 1])){
	
				 return true;
		  } else {
	
				 return false;
		  }
	}   
	
	
	 public function Checkuniqueemail()
		{
			$id = $this->id;
			$email=$this->email;
			$Users = User::find()->where(['email'=>$email])->one();
		     if(is_object($Users)) {
				if($Users->id != NULL && $Users->id != $id)
				{ 
					 $this->addError('email', 'This email address already exists.');
				}
			}
		} 
		
}
