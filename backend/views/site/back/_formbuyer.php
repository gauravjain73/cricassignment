<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Buyer Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup user-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

            <?php $form = ActiveForm::begin(['id' => 'form-signup','options'=>['enctype'=>'multipart/form-data']]); ?>
				 <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
    
				<?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'repassword')->passwordInput() ?>
                <?= $form->field($model, 'mobile')->textInput(['maxlength' => 10]) ?>
    
				<?= $form->field($model, 'landline')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'utid')->textInput(['value' => 3, 'type' => 'hidden'])->label(false) ?>
   
				<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
               <?php if (!empty($model->profile_image)) {
			echo Html::img(Yii::$app->urlManagerFrontend->createUrl(['uploads']).'/' . $model->profile_image, ['width'=>'100'], [
			'class'=>'img-thumbnail']);
			echo $form->field($model, 'profile_image')->fileInput();
		} else
		{
			echo $form->field($model, 'profile_image')->fileInput();
		}
	?>
                <div class="form-group">
                    <?= Html::submitButton( 'Create', ['class' =>'btn btn-success']) ?>
                    <?= Html::a('Cancel', ['/user/buyer'], ['class'=>'btn btn-danger']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    
