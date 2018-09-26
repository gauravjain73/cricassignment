<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "in_match_details_batting".
 *
 * @property integer $match_detail_batting_id
 * @property integer $match_id
 * @property integer $team_id
 * @property integer $player_id
 * @property integer $is_notout
 * @property string $out_remark
 * @property integer $run_scored
 * @property integer $ball_faced
 * @property integer $fours
 * @property integer $sixes
 *
 * @property InMatches $match
 * @property InPlayers $player
 * @property InTeams $team
 */
class MatchDetailsBatting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_match_details_batting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_detail_batting_id', 'match_id', 'team_id', 'player_id', 'out_remark', 'run_scored', 'ball_faced', 'fours', 'sixes'], 'required'],
            [['match_detail_batting_id', 'match_id', 'team_id', 'player_id', 'is_notout', 'run_scored', 'ball_faced', 'fours', 'sixes'], 'integer'],
            [['out_remark'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'match_detail_batting_id' => 'Match Detail Batting ID',
            'match_id' => 'Match ID',
            'team_id' => 'Team ID',
            'player_id' => 'Player ID',
            'is_notout' => 'Is Notout',
            'out_remark' => 'Out Remark',
            'run_scored' => 'Run Scored',
            'ball_faced' => 'Ball Faced',
            'fours' => 'Fours',
            'sixes' => 'Sixes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(InMatches::className(), ['match_id' => 'match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(InPlayers::className(), ['player_id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(InTeams::className(), ['id' => 'team_id']);
    }
}
