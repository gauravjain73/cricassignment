<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "in_match_details_balling".
 *
 * @property integer $in_match_details_balling_id
 * @property integer $match_id
 * @property integer $team_id
 * @property integer $player_id
 * @property double $overs_balled
 * @property integer $maidens_over_balled
 * @property integer $runs
 * @property integer $wickets
 * @property integer $no_balls
 * @property integer $wides
 *
 * @property InMatches $match
 * @property InPlayers $player
 * @property InTeams $team
 */
class MatchDetailsBalling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_match_details_balling';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['in_match_details_balling_id', 'match_id', 'team_id', 'player_id', 'overs_balled', 'maidens_over_balled', 'runs', 'wickets', 'no_balls', 'wides'], 'required'],
            [['in_match_details_balling_id', 'match_id', 'team_id', 'player_id', 'maidens_over_balled', 'runs', 'wickets', 'no_balls', 'wides'], 'integer'],
            [['overs_balled'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'in_match_details_balling_id' => 'In Match Details Balling ID',
            'match_id' => 'Match ID',
            'team_id' => 'Team ID',
            'player_id' => 'Player ID',
            'overs_balled' => 'Overs Balled',
            'maidens_over_balled' => 'Maidens Over Balled',
            'runs' => 'Runs',
            'wickets' => 'Wickets',
            'no_balls' => 'No Balls',
            'wides' => 'Wides',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(Matches::className(), ['match_id' => 'match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Players::className(), ['player_id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Teams::className(), ['id' => 'team_id']);
    }
}
