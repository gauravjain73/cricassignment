<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "in_player_details".
 *
 * @property integer $player_detail_id
 * @property integer $player_id
 * @property integer $played_matches
 * @property integer $runs_scored
 * @property integer $no_fifties
 * @property integer $no_hundreds
 * @property integer $highest_score
 * @property integer $no_wicket_taken
 * @property double $no_over_bowled
 *
 * @property InPlayers $player
 */
class PlayerDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_player_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['player_detail_id', 'player_id', 'played_matches', 'runs_scored', 'no_fifties', 'no_hundreds', 'highest_score', 'no_wicket_taken', 'no_over_bowled'], 'required'],
            [['player_detail_id', 'player_id', 'played_matches', 'runs_scored', 'no_fifties', 'no_hundreds', 'highest_score', 'no_wicket_taken'], 'integer'],
            [['no_over_bowled'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'player_detail_id' => 'Player Detail ID',
            'player_id' => 'Player ID',
            'played_matches' => 'Played Matches',
            'runs_scored' => 'Runs Scored',
            'no_fifties' => 'No Fifties',
            'no_hundreds' => 'No Hundreds',
            'highest_score' => 'Highest Score',
            'no_wicket_taken' => 'No Wicket Taken',
            'no_over_bowled' => 'No Over Bowled',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(InPlayers::className(), ['player_id' => 'player_id']);
    }
}
