<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TeamsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teams-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'team_identifier') ?>

    <?= $form->field($model, 'team_name') ?>

    <?= $form->field($model, 'team_logo') ?>

    <?= $form->field($model, 'team_country') ?>

    <?php // echo $form->field($model, 'team_status') ?>

    <?php // echo $form->field($model, 'team_created_at') ?>

    <?php // echo $form->field($model, 'team_updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
