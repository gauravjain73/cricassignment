<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TeamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Teams', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'team_logo',
                'filter' => false,
                'enableSorting' => false,
                'format' => 'html',
                'value' => function($data) {
                    return Html::img(Yii::$app->urlManagerFrontend->createUrl(['uploads']) . '/' . $data['team_logo'], ['width' => '70']);
                },
            ],
            'id',
            'team_identifier',
            'team_name',
            'team_country',
            // 'team_status',
            // 'team_created_at',
            // 'team_updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
