<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "in_players".
 *
 * @property integer $player_id
 * @property integer $player_team_id
 * @property string $player_fname
 * @property string $player_lname
 * @property string $player_image
 * @property integer $player_status
 * @property string $player_created_at
 * @property string $player_updated_at
 *
 * @property InMatchDetailsBalling[] $inMatchDetailsBallings
 * @property InMatchDetailsBatting[] $inMatchDetailsBattings
 * @property InPlayerDetails[] $inPlayerDetails
 * @property InTeams $playerTeam
 */
class Players extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['player_id', 'player_team_id', 'player_fname', 'player_lname', 'player_image'], 'required'],
            [['player_id', 'player_team_id', 'player_status'], 'integer'],
            [['player_created_at', 'player_updated_at'], 'safe'],
            [['player_fname', 'player_lname', 'player_image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'player_id' => 'Player ID',
            'player_team_id' => 'Player Team ID',
            'player_fname' => 'Player Fname',
            'player_lname' => 'Player Lname',
            'player_image' => 'Player Image',
            'player_status' => 'Player Status',
            'player_created_at' => 'Player Created At',
            'player_updated_at' => 'Player Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatchDetailsBallings()
    {
        return $this->hasMany(InMatchDetailsBalling::className(), ['player_id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatchDetailsBattings()
    {
        return $this->hasMany(InMatchDetailsBatting::className(), ['player_id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInPlayerDetails()
    {
        return $this->hasMany(InPlayerDetails::className(), ['player_id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerTeam()
    {
        return $this->hasOne(InTeams::className(), ['team_id' => 'player_team_id']);
    }
}
