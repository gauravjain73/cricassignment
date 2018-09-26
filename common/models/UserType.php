<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lio_user_type".
 *
 * @property string $utid
 * @property string $utname
 * @property integer $utstatus
 *
 * @property Users[] $lioUsers
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['utstatus'], 'integer'],
            [['utname'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'utid' => 'Utid',
            'utname' => 'Utname',
            'utstatus' => 'Utstatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['utid' => 'utid']);
    }
}
