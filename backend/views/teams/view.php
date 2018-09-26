<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Teams */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'team_identifier',
            'team_name',
            [
				'attribute'=>'team_logo',
				'value'=>Yii::$app->urlManagerFrontend->createUrl(['uploads']).'/' . $model->team_logo, ['width'=>'70'],
				'format' => ['image',['width'=>'100']]
			],
            'team_country',
            [
				'attribute'=>'team_status', 
				'format'=>'raw',
				'value'=>$model->team_status ? 
				'<span class="label label-success">Active</span>' : 
				'<span class="label label-danger">Inactive</span>',
        
			],
            'team_created_at',
            'team_updated_at',
        ],
    ]) ?>

</div>
