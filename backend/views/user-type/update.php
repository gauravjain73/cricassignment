<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserType */

$this->title = 'Update User Type: ' . ' ' . $model->utid;
$this->params['breadcrumbs'][] = ['label' => 'User Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->utid, 'url' => ['view', 'id' => $model->utid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
