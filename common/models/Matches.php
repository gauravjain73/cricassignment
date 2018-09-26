<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "in_matches".
 *
 * @property integer $match_id
 * @property integer $opp_team_1
 * @property integer $opp_team_2
 * @property string $match_datetime
 * @property integer $toss_winning_team_id
 * @property integer $toss_winner_elected
 * @property integer $winner_team_id
 * @property integer $match_status
 * @property string $match_created_at
 * @property string $match_updated_at
 *
 * @property InMatchDetailsBalling[] $inMatchDetailsBallings
 * @property InMatchDetailsBatting[] $inMatchDetailsBattings
 * @property InTeams $oppTeam1
 * @property InTeams $oppTeam2
 * @property InTeams $winnerTeam
 */
class Matches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_matches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id', 'opp_team_1', 'opp_team_2', 'match_datetime', 'toss_winning_team_id', 'winner_team_id'], 'required'],
            [['match_id', 'opp_team_1', 'opp_team_2', 'toss_winning_team_id', 'toss_winner_elected', 'winner_team_id', 'match_status'], 'integer'],
            [['match_datetime', 'match_created_at', 'match_updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'match_id' => 'Match ID',
            'opp_team_1' => 'Opp Team 1',
            'opp_team_2' => 'Opp Team 2',
            'match_datetime' => 'Match Datetime',
            'toss_winning_team_id' => 'Toss Winning Team ID',
            'toss_winner_elected' => 'Toss Winner Elected',
            'winner_team_id' => 'Winner Team ID',
            'match_status' => 'Match Status',
            'match_created_at' => 'Match Created At',
            'match_updated_at' => 'Match Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatchDetailsBallings()
    {
        return $this->hasMany(InMatchDetailsBalling::className(), ['match_id' => 'match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInMatchDetailsBattings()
    {
        return $this->hasMany(InMatchDetailsBatting::className(), ['match_id' => 'match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOppTeam1()
    {
        return $this->hasOne(Teams::className(), ['id' => 'opp_team_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOppTeam2()
    {
        return $this->hasOne(InTeams::className(), ['team_id' => 'opp_team_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinnerTeam()
    {
        return $this->hasOne(InTeams::className(), ['team_id' => 'winner_team_id']);
    }
}
