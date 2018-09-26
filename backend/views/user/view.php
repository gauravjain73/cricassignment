<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = "$model->fname  $model->lname";
//$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?> <?= Html::a('Edit Profile', ['update?id=1'], ['class' => 'btn btn-success']) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
          //  'username',
          //  'auth_key',
          //  'password_hash',
           //'password_reset_token',
           
           // 'status',
           // 'created_at',
           // 'updated_at',
           // 'utid',
            'fname',
            'lname',
            'email:email',
            'mobile',
            'landline',
            'address:ntext',
            [
				'attribute'=>'profile_image',
				'value'=>Yii::$app->urlManagerFrontend->createUrl(['uploads']).'/' . $model->profile_image, ['width'=>'70'],
				'format' => ['image',['width'=>'100','height'=>'100']]
			],
			/*[
				'attribute'=>'status', 
				'format'=>'raw',
				'value'=>$model->status ? 
				'<span class="label label-success">Active</span>' : 
				'<span class="label label-danger">Inactive</span>',
        
			],*/
        ],
    ]) ?>


</div>
