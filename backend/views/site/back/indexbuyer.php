<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use common\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buyers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Buyer', ['createbuyer'], ['class' => 'btn btn-success']) ?>
    </p>

<?php $dataProvider = new ActiveDataProvider([
    'query' => User::find()->where(['utid' => 3]),
    'pagination' => [
        'pageSize' => 10,
    ],
]);
 ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
	            'attribute'=>'profile_image',
	            'filter'=>false,
	            'format' => 'html',
				  'value' => function($data) { return Html::img(Yii::$app->urlManagerFrontend->createUrl(['uploads']).'/' . $data['profile_image'], ['width'=>'70']); },
	        ],          
              [
				'attribute' => 'fname',
				'label' => 'Name',
				'value' => function($model) { return $model->fname  . " " . $model->lname ;},
			 ],
            'username',
            //'auth_key',
           // 'password_hash',
           // 'password_reset_token',
             'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'utid',
          //   'fname',
           //  'lname',
             'mobile',
            // 'landline',
           //  'address:ntext',
             //'profile_image',

           [
	            'attribute'=>'user_status',
	            'filter'=>array("1"=>"Active","0"=>"Inactive"),
	            'content'=>function($data){
					  return $data->user_status ? 'Active' : 'Inactive';
	            }
	        ],
            [
            'header' => 'Actions',
            'class' => 'yii\grid\ActionColumn',
           
            'template' => '{update} {view} {delete} {active} {inactive}',
            'buttons' => [ 
            'update',
            'view',
            'delete',
			'active' => function ($url, $model) { 
				if($model->user_status==1)
				return Html::a( '<span class="glyphicon glyphicon-eye-open"> </span>', $url, [ 'title' => 'DeActivate', 'data-confirm' =>'Are you sure you want to deactivate this item?' ] ); 
			},
			'inactive' => function ($url, $model) { 
				if($model->user_status==0)
				return Html::a( '<span class="glyphicon glyphicon-eye-close"> </span>', $url, [ 'title' => 'Activate', 'data-pjax' => '0', 'data-confirm' =>'Are you sure you want to activate this item?'] ); 
			},
			'view' => function ($url, $model) {
				return Html::a( '<span class="glyphicon glyphicon-folder-open"> </span>', $url, [ 'title' => 'View'] );              
            },
			],
			    'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'update') {
                $url =Url::toRoute(['user/updatebuyer', 'id' => $model->id]);
                return $url;
            }
            if ($action === 'view') {
                $url =Url::toRoute(['user/viewbuyer', 'id' => $model->id]);
                return $url;
            }
            if ($action === 'delete') {
                $url =Url::toRoute(['user/deletebuyer', 'id' => $model->id]);
                return $url;
            }
            if ($action === 'active') {
                $url =Url::toRoute(['user/changestatusbuyer', 'id' => $model->id, 'status'=> 0]);
                return $url;
            }
           if ($action === 'inactive') {
                $url =Url::toRoute(['user/changestatusbuyer', 'id' => $model->id, 'status'=> 1]);
                return $url;
            }

          }
            ],
        ],
    ]); ?>

</div>
