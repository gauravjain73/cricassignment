<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Buyer', 'url' => ['buyer']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'username',
          //  'auth_key',
          //  'password_hash',
           //'password_reset_token',
            'email:email',
            'status',
           // 'created_at',
           // 'updated_at',
           // 'utid',
            'fname',
            'lname',
            'mobile',
            'landline',
            'address:ntext',
            [
				'attribute'=>'profile_image',
				'value'=>Yii::$app->urlManagerFrontend->createUrl(['uploads']).'/' . $model->profile_image, ['width'=>'70'],
				'format' => ['image',['width'=>'100','height'=>'100']]
			],
			[
				'attribute'=>'user_status', 
				'format'=>'raw',
				'value'=>$model->user_status ? 
				'<span class="label label-success">Active</span>' : 
				'<span class="label label-danger">Inactive</span>',
        
			],
        ],
    ]) ?>

<p>
        <?= Html::a('Back', ['/user/buyer'], ['class'=>'btn btn-danger']) ?>
    </p>
</div>
