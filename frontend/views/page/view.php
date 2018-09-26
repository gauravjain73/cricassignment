<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\CmsPage */

$this->title = $model->page_title;
//$this->params['breadcrumbs'][] = ['label' => 'CMS Page', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
           // 'parent_id',
            'page_name',
            'slug',
            'page_title',
            [
				'attribute'=>'description', 
				'format'=>'raw',
				'value'=>strip_tags($model->description)
			],
			[
				'attribute'=>'image',
				'value'=>'/YSL01/uploads'.'/' . $model->image, ['width'=>'70'],
				'format' => ['image',['width'=>'100','height'=>'100']]
			],
            'meta_key:ntext',
            'meta_desc:ntext',
            'meta_title:ntext',
            'date_added',
            //'date_modified', 
             [
				'attribute'=>'date_modified', 
				'format'=>'raw',
				'value'=> $model->date_modified != '0000-00-00 00:00:00' ? $model->date_modified : 'Not Updated'
			],        
	        [
				'attribute'=>'status', 
				'format'=>'raw',
				'value'=>$model->status ? 
				'<span class="label label-success">Active</span>' : 
				'<span class="label label-danger">Inactive</span>',
        
			],
        ],
    ]) ?>
<p>
        <?= Html::a('Back', ['/site'], ['class'=>'btn btn-danger']) ?>
    </p>
</div>
