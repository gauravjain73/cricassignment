<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
      <?php /*  <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

<?php /* $dataProvider = new ActiveDataProvider([
    'query' => User::find()->where(['utid' => 1]),
    'pagination' => [
        'pageSize' => 10,
    ],
]); */
 ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
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
            //'username',
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
            'header' => 'Actions',
            'class' => 'yii\grid\ActionColumn',
           
            'template' => '{update} {view}',
            'buttons' => [ 
            'update',
            'view',           
			'view' => function ($url, $model) {
				return Html::a( '<span class="glyphicon glyphicon-folder-open"> </span>', $url, [ 'title' => 'View'] );              
            },
			],
			    'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'update') {
                $url =Url::toRoute(['user/update', 'id' => $model->id]);
                return $url;
            }
            if ($action === 'view') {
                $url =Url::toRoute(['user/view', 'id' => $model->id]);
                return $url;
            }
          }
            ], 
        ],
    ]); ?>

</div>
