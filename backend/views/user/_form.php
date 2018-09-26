<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]); ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?php /* $form->field($model, 'username')->textInput(['maxlength' => true]) */ ?>
    
    <?php if($model->isNewRecord) { ?>
    
    <?= $form->field($model, 'password_hash')->input('password') ?>
    
    <?= $form->field($model, 'repassword')->input('password') ?>
	
	<?php  } else { ?>
	
	<?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => 255,'value'=>'password']) ?>
			
	<?php echo $form->field($model,'repassword')->passwordInput(['maxlength' => 255,'value'=>'password']) ?>
		
	<?php }  ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'landline')->textInput(['maxlength' => true]) ?>
   
	 <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>
    
    <?php if (!empty($model->profile_image)) {
			echo Html::img(Yii::$app->urlManagerFrontend->createUrl(['uploads']).'/' . $model->profile_image, ['width'=>'100'], [
			'class'=>'img-thumbnail']);
			echo $form->field($model, 'profile_image')->fileInput();
		} else
		{
			echo $form->field($model, 'profile_image')->fileInput();
		}
	?>

     <?php /* = $form->field($model, 'status')->textInput(['value'=>'Active', 'readOnly'=>true]); */ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
         <?= Html::a('Cancel', ['/user/view?id=1'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
