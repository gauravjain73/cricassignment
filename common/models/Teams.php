<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "in_teams".
 *
 * @property integer $team_id
 * @property string $team_identifier
 * @property string $team_name
 * @property string $team_logo
 * @property string $team_country
 * @property integer $team_status
 * @property string $team_created_at
 * @property string $team_updated_at
 *
 * @property InMatchDetailsBalling[] $inMatchDetailsBallings
 * @property InMatchDetailsBatting[] $inMatchDetailsBattings
 * @property InMatches[] $inMatches
 * @property InMatches[] $inMatches0
 * @property InMatches[] $inMatches1
 * @property InPlayers[] $inPlayers
 */
class Teams extends \yii\db\ActiveRecord
{
      const STATUS_ACTIVE = 1;
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_teams';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['team_status', 'default', 'value' => self::STATUS_ACTIVE],
            [['team_logo', 'file'], 'file', 'extensions'=>'jpg, gif, png, jpeg'],
            [['team_identifier', 'team_name', 'team_country'], 'required', 'on'=>['create']],
            [['id', 'team_identifier', 'team_name', 'team_country'], 'required', 'on'=>['update']],
            [['id', 'team_status'], 'integer'],
            [['team_created_at', 'team_updated_at'], 'safe'],
            [['team_identifier', 'team_name', 'team_country'], 'string', 'max' => 255],
            [['team_identifier'], 'unique', 'message' => 'This Identfier has already been taken.', 'on'=>['create']],
            [['team_identifier'], 'CheckUniqueIdentifier', 'message' => 'This Identfier has already been taken.', 'on'=>['update']],
            

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'team_id' => 'Team ID',
            'team_identifier' => 'Team Identifier',
            'team_name' => 'Team Name',
            'team_logo' => 'Team Logo',
            'team_country' => 'Team Country',
            'team_status' => 'Team Status',
            'team_created_at' => 'Team Created At',
            'team_updated_at' => 'Team Updated At',
          
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatchDetailsBallings()
    {
        return $this->hasMany(InMatchDetailsBalling::className(), ['team_id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatchDetailsBattings()
    {
        return $this->hasMany(InMatchDetailsBatting::className(), ['team_id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatches()
    {
        return $this->hasMany(InMatches::className(), ['opp_team_1' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatches0()
    {
        return $this->hasMany(InMatches::className(), ['opp_team_2' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatches1()
    {
        return $this->hasMany(InMatches::className(), ['winner_team_id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInPlayers()
    {
        return $this->hasMany(InPlayers::className(), ['player_team_id' => 'team_id']);
    }
    public function CheckUniqueIdentifier()
		{
			$id = $this->id;
			$team_identifier=$this->team_identifier;
			$Teams = Teams::find()->where(['team_identifier'=>$team_identifier])->one();
		     if(is_object($Teams)) {
				if($Teams->id != NULL && $Teams->id != $id)
				{ 
					 $this->addError('team_identifier', 'This Identfier is already exists.');
				}
			}
		}
}
