<?php

namespace common\components;

use Yii;
use yii\web\IdentityInterface;
use yii\web\User as CoreUser;
use yii\db\Expression;
use common\models\User;

class WebUser extends CWebUser {
 
  // Store model to not repeat query.
  private $_model;
	
  /**
     * @inheritdoc
     */
    public $identityClass = 'common\models\User';

    /**
     * @inheritdoc
     */
    public $enableAutoLogin = true;

    /**
     * @inheritdoc
     */
    public $loginUrl = ["/user/login"];

    /**
     * Check if user is logged in
     *
     * @return bool
     */
  // access it by Yii::app()->user->first_name

  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  public function isAdmin(){
	 // echo 'kkk';die;
    $user = $this->loadAdmin(Yii::app()->user->id);	
   if($user!=NULL)
	{		
	   if(intval($user->user_type_id)==1)
		{
			return true;
		}
		else{
			return 0;
		}
	}
	else{
		return NULL;
	}
  }
  public function isClient(){
    $user = $this->loadUser(Yii::app()->user->id);	
	if($user!=NULL)
	{		
	   if(intval($user->usertype)==2)
		{
			return true;
		}
		else{
			return 0;
		}
	}
	else{
		return NULL;
	}
  }
  public function isCustomer(){
    $user = $this->loadUser(Yii::app()->user->id);	
	if($user!=NULL)
	{		
	   if(intval($user->usertype)==3)
		{
			return true;
		}
		else{
			return 0;
		}
	}
	else{
		return NULL;
	}
  }
   public function isTranslater(){
    $user = $this->loadUser(Yii::app()->user->id);	
	if($user!=NULL)
	{		
	   if(intval($user->usertype)==5)
		{
			return true;
		}
		else{
			return 0;
		}
	}
	else{
		return NULL;
	}
  }
 	public function isUser()
 	{
  	
     $user = $this->loadUser(Yii::app()->user->id);	
	if($user!=NULL)
	{
		
		
	   if(intval($user->usertype) == 2 || intval($user->usertype) == 3)
		{
			return $user->name;
		}
		else{
			
			return 0;
		}
	}
	else{
		return NULL;
	}
	
  }
	
	public function isBooker(){  	
     $user = $this->loadUser(Yii::app()->user->id);	
	if($user!=NULL)
	{
	   if(intval($user->usertype) == 4)
		{		
			return true;
		}
		else{
			return 0;
		}
	}
	else{
		return NULL;
	}
	
  }
	
  // Load user model.
  protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=User::model()->findByPk($id);
        }
        return $this->_model;
    }
  // Load user model.
  protected function loadAdmin($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Admin::model()->findByPk($id);
        }
        return $this->_model;
    }
	
	public function getFirst_Name()
	{
		$session=new CHttpSession;
		$session->open();
		
		if($session['utid'] == 2)
		{
			$user=DoctorData::model()->findByAttributes(array('user_id'=>$session['user_id']));
		}
		elseif($session['utid'] == 3)
		{
			$user=PharmacistsData::model()->findByAttributes(array('user_id'=>$session['user_id']));
		}
		elseif($session['utid'] == 5)
		{
			$user=FrontdeskData::model()->findByAttributes(array('user_id'=>$session['user_id']));
			return $user->full_name;
		}
		elseif($session['utid'] == 6)
		{
			$user=Owner::model()->findByAttributes(array('userid'=>$session['user_id']));
			return ucfirst($user->first_name.' '.$user->last_name);
		}
		else
		{
			return 'System Admin';
		}
		
		return $user->first_name;
	}
}
?>
