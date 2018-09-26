<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Teams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teams-form">

    <?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]); ?>

    <?= $form->field($model, 'team_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'team_identifier')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'team_country')->textInput(['maxlength' => true]) ?>
    <?php if (!empty($model->team_logo)) {
			echo Html::img(Yii::$app->urlManagerFrontend->createUrl(['uploads']).'/' . $model->team_logo, ['width'=>'100'], ['class'=>'img-thumbnail']);
			echo $form->field($model, 'team_logo')->fileInput();
		} else {
			echo $form->field($model, 'team_logo')->fileInput();
		}
	?>
    <?= $form->field($model, 'team_status')->dropDownList(['1' => 'Active', '0' => 'Inactive']);?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['/teams'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
